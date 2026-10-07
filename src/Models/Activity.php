<?php

namespace App\Models;

class Activity
{
    public ?int $id = null;
    public int $user_id;
    public string $action; // created_playlist, liked_track, followed_artist, etc.
    public string $entity_type;
    public string $entity_id;
    public ?string $payload = null; // JSON data
    public int $created_at;
}
