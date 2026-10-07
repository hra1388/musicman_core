<?php

namespace App\Models;

class Artist
{
    public string $artist_id;
    public ?string $artist_name = null;
    public ?string $primary_genre_name = null;
}
