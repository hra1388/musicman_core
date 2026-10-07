<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Database;
use PDO;

class CatalogController
{
    public function search(Request $request): void
    {
        $term = trim((string)$request->getParam('term', ''));
        if (empty($term)) {
            Response::json(['resultCount' => 0, 'results' => [], 'source' => 'database']);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM tracks WHERE trackName LIKE :q OR artistName LIKE :q LIMIT 50");
        $stmt->execute([':q' => '%' . $term . '%']);
        $tracks = $stmt->fetchAll();

        foreach ($tracks as &$track) {
            $track['wrapperType'] = 'track';
            $track['_source'] = 'database';
        }

        Response::json(['resultCount' => count($tracks), 'results' => $tracks, 'source' => 'database']);
    }

    public function suggest(Request $request): void
    {
        $q = trim((string)$request->getParam('q', ''));
        if (empty($q)) {
            Response::json(['success' => true, 'query' => '', 'count' => 0, 'suggestions' => []]);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT trackId AS id, trackName AS name, artistName, 'track' AS type FROM tracks WHERE trackName LIKE :q OR artistName LIKE :q LIMIT 10");
        $stmt->execute([':q' => '%' . $q . '%']);
        $suggestions = $stmt->fetchAll();

        Response::json(['success' => true, 'query' => $q, 'count' => count($suggestions), 'suggestions' => $suggestions]);
    }

    public function fresh(Request $request): void
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM tracks ORDER BY trackId DESC LIMIT 20");
        $tracks = $stmt->fetchAll();

        Response::json(['resultCount' => count($tracks), 'results' => $tracks, 'source' => 'database']);
    }

    public function popular(Request $request): void
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM tracks ORDER BY views DESC LIMIT 20");
        $tracks = $stmt->fetchAll();

        Response::json(['resultCount' => count($tracks), 'results' => $tracks, 'source' => 'database']);
    }
}
