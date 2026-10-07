<?php

namespace App\Models;

class User
{
    public ?int $id = null;
    public string $user_type = 'user'; // 'user' or 'artist'
    public ?string $artist_id = null;
    public string $provider = 'local';
    public ?string $provider_id = null;
    public ?string $email = null;
    public ?string $password_hash = null;
    public string $first_name = '';
    public string $last_name = '';
    public string $username = '';
    public ?string $photo_url = null;
    public ?string $bio = null;
    public ?string $primary_genre_name = null;
    public int $created_at = 0;
    public int $last_login = 0;
    public int $session_epoch = 1;
    public int $is_public = 1;

    public function toArray(): array
    {
        return [
            'id' => (string)$this->id,
            'user_type' => $this->user_type,
            'artist_id' => $this->artist_id,
            'provider' => $this->provider,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'photo_url' => $this->photo_url,
            'bio' => $this->bio,
            'primary_genre_name' => $this->primary_genre_name,
            'created_at' => $this->created_at,
            'is_public' => $this->is_public,
        ];
    }
}
