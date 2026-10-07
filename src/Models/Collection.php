<?php

namespace App\Models;

class Collection
{
    public string $collection_id;
    public ?string $collection_name = null;
    public ?string $artist_id = null;
    public ?string $artist_name = null;
    public int $track_count = 0;
}
