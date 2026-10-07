<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Database;

class WikidataController
{
    public function getArtistFacts(Request $request): void
    {
        $artistId = (string)$request->getParam('id');
        if (empty($artistId)) {
            Response::error('Missing artist id', 400);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM artistWikidata WHERE artistId = :id LIMIT 1");
        $stmt->execute([':id' => $artistId]);
        $row = $stmt->fetch();

        if (!$row) {
            Response::json(['success' => false, 'error' => 'No wikidata facts found for artist', 'artistId' => $artistId]);
            return;
        }

        Response::json(['success' => true, 'artistId' => $artistId, 'facts' => $row]);
    }
}
