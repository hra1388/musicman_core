<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Config;
use App\Repositories\UserRepository;
use App\Models\User;

class AuthController
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function telegram(Request $request): void
    {
        $p = $request->getParams();
        $botToken = Config::get('telegram_bot_token');

        if (empty($p['hash']) || !$botToken) {
            Response::error('Invalid telegram auth request or bot token unconfigured', 400);
        }

        $hash = (string)$p['hash'];
        $check = $p;
        unset($check['hash']);
        ksort($check);

        $pairs = [];
        foreach ($check as $k => $v) {
            if ($v === null || $v === '') continue;
            $pairs[] = $k . '=' . $v;
        }

        $checkString = implode("\n", $pairs);
        $secretKey = hash('sha256', $botToken, true);
        $calcHash = hash_hmac('sha256', $checkString, $secretKey);

        if (!hash_equals($calcHash, $hash)) {
            Response::error('Signature mismatch', 403);
        }

        $providerId = (string)($p['id'] ?? '');
        $user = $this->userRepo->findByProvider('telegram', $providerId);

        if (!$user) {
            $user = new User();
            $user->provider = 'telegram';
            $user->provider_id = $providerId;
            $user->first_name = (string)($p['first_name'] ?? '');
            $user->last_name = (string)($p['last_name'] ?? '');
            $user->username = (string)($p['username'] ?? '');
            $user->photo_url = (string)($p['photo_url'] ?? '');
            $user->id = $this->userRepo->create($user);
        }

        $token = $this->generateToken($user);
        Response::json(['ok' => true, 'token' => $token, 'user' => $user->toArray()]);
    }

    public function register(Request $request): void
    {
        $email = strtolower(trim((string)$request->getParam('email', '')));
        $password = (string)$request->getParam('password', '');
        $firstName = trim((string)$request->getParam('first_name', ''));
        $lastName = trim((string)$request->getParam('last_name', ''));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Response::error('Invalid email address', 400);
        }

        if (strlen($password) < 6) {
            Response::error('Password must be at least 6 characters', 400);
        }

        if ($this->userRepo->findByEmail($email)) {
            Response::error('Email already registered', 409);
        }

        $user = new User();
        $user->provider = 'email';
        $user->provider_id = $email;
        $user->email = $email;
        $user->password_hash = password_hash($password, PASSWORD_DEFAULT);
        $user->first_name = $firstName ?: (explode('@', $email)[0] ?? '');
        $user->last_name = $lastName;
        $user->id = $this->userRepo->create($user);

        $token = $this->generateToken($user);
        Response::json(['ok' => true, 'token' => $token, 'user' => $user->toArray()]);
    }

    public function login(Request $request): void
    {
        $email = strtolower(trim((string)$request->getParam('email', '')));
        $password = (string)$request->getParam('password', '');

        $user = $this->userRepo->findByEmail($email);
        if (!$user || !password_verify($password, (string)$user->password_hash)) {
            Response::error('Wrong email or password', 401);
        }

        $token = $this->generateToken($user);
        Response::json(['ok' => true, 'token' => $token, 'user' => $user->toArray()]);
    }

    public function me(Request $request): void
    {
        $token = $request->getAuthToken();
        $userId = $this->verifyToken($token);

        if (!$userId) {
            Response::json(['ok' => true, 'user' => null]);
            return;
        }

        $user = $this->userRepo->findById($userId);
        Response::json(['ok' => true, 'user' => $user ? $user->toArray() : null]);
    }

    private function generateToken(User $user): string
    {
        $secret = 'mm_auth_v3|' . Config::get('auth_secret');
        $payload = json_encode([
            'uid' => $user->id,
            'ep' => $user->session_epoch,
            'iat' => time(),
            'exp' => time() + Config::get('session_days', 60) * 86400,
        ]);
        $body = rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
        $sig = rtrim(strtr(base64_encode(hash_hmac('sha256', $body, $secret, true)), '+/', '-_'), '=');
        return $body . '.' . $sig;
    }

    private function verifyToken(?string $token): ?int
    {
        if (!$token || !str_contains($token, '.')) return null;
        [$body, $sig] = explode('.', $token, 2);
        $secret = 'mm_auth_v3|' . Config::get('auth_secret');
        $expected = rtrim(strtr(base64_encode(hash_hmac('sha256', $body, $secret, true)), '+/', '-_'), '=');
        if (!hash_equals($expected, $sig)) return null;

        $data = json_decode(base64_decode(strtr($body, '-_', '+/')), true);
        if (!$data || empty($data['uid'])) return null;
        if (!empty($data['exp']) && $data['exp'] < time()) return null;

        return (int)$data['uid'];
    }
}
