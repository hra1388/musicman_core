<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\SQLiteDatabase;
use PDO;

class DownloadController
{
    public function queue(Request $request): void
    {
        $db = SQLiteDatabase::getConnection();
        $stmt = $db->query("SELECT * FROM download_queue ORDER BY id DESC LIMIT 50");
        $items = $stmt->fetchAll();

        Response::json(['success' => true, 'count' => count($items), 'items' => $items]);
    }

    public function add(Request $request): void
    {
        $trackId = (string)$request->getParam('track_id');
        if (empty($trackId)) {
            Response::error('Missing track_id', 400);
        }

        $db = SQLiteDatabase::getConnection();
        $stmt = $db->prepare("INSERT INTO download_queue (track_id, status) VALUES (:tid, 'pending')");
        $stmt->execute([':tid' => $trackId]);

        Response::json(['success' => true, 'id' => $db->lastInsertId(), 'message' => 'Added to download queue']);
    }

    public function update(Request $request): void
    {
        $id = (int)$request->getParam('id');
        $status = $request->getParam('status');
        $percent = $request->getParam('percent');

        if (!$id) {
            Response::error('Missing download id', 400);
        }

        $db = SQLiteDatabase::getConnection();
        $stmt = $db->prepare("UPDATE download_queue SET status = COALESCE(:status, status), percent = COALESCE(:percent, percent) WHERE id = :id");
        $stmt->execute([':status' => $status, ':percent' => $percent, ':id' => $id]);

        Response::json(['success' => true, 'message' => 'Download status updated']);
    }
}
