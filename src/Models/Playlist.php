<?php

namespace App\Models;

class Playlist
{
    public string $id;
    public string $collection_type = 'playlist'; // 'playlist', 'ai_playlist', 'album'
    public ?int $user_id = null;
    public ?string $slug = null;
    public string $name;
    public ?string $description = null;
    public ?string $cover = null;
    public string $icon = 'bi-stars';
    public string $color = 'primary';
    public ?string $ai_model = null;
    public ?string $expires_at = null;
    public string $data; // JSON string of tracks
    public int $views = 0;
    public int $track_count = 0;
    public int $created_at;
    public int $updated_at;
}
