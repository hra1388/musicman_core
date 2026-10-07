<?php

namespace App\Models;

class BlogPost
{
    public ?int $id = null;
    public string $slug;
    public string $title;
    public ?string $excerpt = null;
    public string $content;
    public ?string $cover_image = null;
    public string $language = 'en';
    public string $status = 'draft'; // draft, published, archived
    public ?string $meta_description = null;
    public ?string $meta_keywords = null;
    public int $ai_generated = 0;
    public ?string $ai_model = null;
    public int $views = 0;
    public string $created_at;
    public string $updated_at;
    public ?string $published_at = null;
}
