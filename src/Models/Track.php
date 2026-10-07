<?php

namespace App\Models;

class Track
{
    public string $track_id;
    public ?string $track_name = null;
    public ?string $artist_id = null;
    public ?string $artist_name = null;
    public ?string $collection_id = null;
    public ?string $collection_name = null;
    public int $is_streamable = 0;
    public int $views = 0;
}
