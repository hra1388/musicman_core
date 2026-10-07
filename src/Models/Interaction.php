<?php

namespace App\Models;

class Interaction
{
    public ?int $id = null;
    public int $user_id;
    public string $entity_type; // track, artist, collection, playlist, user
    public string $entity_id;
    public string $interaction_type; // like, follow, play, note
    public ?string $interaction_value = null; // optional JSON or text note
    public int $created_at;
}
