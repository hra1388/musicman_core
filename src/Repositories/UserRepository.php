<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\User;
use PDO;

class UserRepository
{
    public function findById(int $id): ?User
    {
        $stmt = Database::prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        return $this->hydrate($row);
    }

    public function findByProvider(string $provider, string $providerId): ?User
    {
        $stmt = Database::prepare("SELECT * FROM users WHERE provider = :provider AND provider_id = :pid LIMIT 1");
        $stmt->execute([':provider' => $provider, ':pid' => $providerId]);
        $row = $stmt->fetch();
        if (!$row) return null;
        return $this->hydrate($row);
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = Database::prepare("SELECT * FROM users WHERE email = :email AND provider = 'email' LIMIT 1");
        $stmt->execute([':email' => strtolower($email)]);
        $row = $stmt->fetch();
        if (!$row) return null;
        return $this->hydrate($row);
    }

    public function create(User $user): int
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO users (provider, provider_id, email, password_hash, first_name, last_name, username, photo_url, bio, created_at, last_login, session_epoch, is_public) VALUES (:provider, :provider_id, :email, :password_hash, :first_name, :last_name, :username, :photo_url, :bio, :created_at, :last_login, :session_epoch, :is_public)");
        $stmt->execute([
            ':provider' => $user->provider,
            ':provider_id' => $user->provider_id,
            ':email' => $user->email,
            ':password_hash' => $user->password_hash,
            ':first_name' => $user->first_name,
            ':last_name' => $user->last_name,
            ':username' => $user->username,
            ':photo_url' => $user->photo_url,
            ':bio' => $user->bio,
            ':created_at' => $user->created_at ?: time(),
            ':last_login' => $user->last_login ?: time(),
            ':session_epoch' => $user->session_epoch,
            ':is_public' => $user->is_public,
        ]);
        return (int)$db->lastInsertId();
    }

    private function hydrate(array $row): User
    {
        $u = new User();
        $u->id = (int)$row['id'];
        $u->provider = $row['provider'];
        $u->provider_id = $row['provider_id'];
        $u->email = $row['email'];
        $u->password_hash = $row['password_hash'];
        $u->first_name = $row['first_name'] ?? '';
        $u->last_name = $row['last_name'] ?? '';
        $u->username = $row['username'] ?? '';
        $u->photo_url = $row['photo_url'];
        $u->bio = $row['bio'];
        $u->created_at = (int)$row['created_at'];
        $u->last_login = (int)$row['last_login'];
        $u->session_epoch = (int)($row['session_epoch'] ?? 1);
        $u->is_public = (int)($row['is_public'] ?? 1);
        return $u;
    }
}
