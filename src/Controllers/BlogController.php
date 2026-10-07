<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Database;

class BlogController
{
    public function list(Request $request): void
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM blogPosts WHERE status = 'published' ORDER BY publishedAt DESC LIMIT 50");
        $posts = $stmt->fetchAll();

        Response::json(['success' => true, 'count' => count($posts), 'items' => $posts]);
    }

    public function get(Request $request, array $matches = []): void
    {
        $slug = $matches[1] ?? $request->getParam('slug');
        if (!$slug) {
            Response::error('Missing blog post slug', 400);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM blogPosts WHERE slug = :slug LIMIT 1");
        $stmt->execute([':slug' => $slug]);
        $post = $stmt->fetch();

        if (!$post) {
            Response::error('Blog post not found', 404);
        }

        Response::json(['success' => true, 'post' => $post]);
    }
}
