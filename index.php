<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    require_once __DIR__ . '/autoload.php';
}

use App\Core\Application;
use App\Controllers\AuthController;
use App\Controllers\CatalogController;
use App\Controllers\InteractionController;
use App\Controllers\PlaylistController;
use App\Controllers\DownloadController;
use App\Controllers\BlogController;
use App\Controllers\WikidataController;
use App\Controllers\SitemapController;

$app = new Application();
$router = $app->getRouter();

// Auth Routes
$router->add('POST', '/auth/telegram', [AuthController::class, 'telegram'], false);
$router->add('POST', '/auth/register', [AuthController::class, 'register'], false);
$router->add('POST', '/auth/login', [AuthController::class, 'login'], false);
$router->add('GET', '/auth/me', [AuthController::class, 'me'], false);

// Catalog Routes
$router->add('GET', '/search', [CatalogController::class, 'search'], false);
$router->add('GET', '/suggest', [CatalogController::class, 'suggest'], false);
$router->add('GET', '/fresh', [CatalogController::class, 'fresh'], false);
$router->add('GET', '/popular', [CatalogController::class, 'popular'], false);

// User Interaction Routes (Consolidated)
$router->add('POST', '/interaction/record', [InteractionController::class, 'record']);
$router->add('POST', '/interaction/remove', [InteractionController::class, 'remove']);
$router->add('GET', '/interaction/list', [InteractionController::class, 'list']);

// Playlist & Album Routes
$router->add('GET', '/pl/list', [PlaylistController::class, 'list'], false);
$router->add('POST', '/pl/publish', [PlaylistController::class, 'publish']);
$router->addPattern('GET', '#^/pl/get/([A-Za-z0-9_\-]+)$#', [PlaylistController::class, 'get'], false);

// Downloads Routes
$router->add('GET', '/download/queue', [DownloadController::class, 'queue']);
$router->add('POST', '/download/add', [DownloadController::class, 'add']);
$router->add('POST', '/download/update', [DownloadController::class, 'update']);

// Blog Routes
$router->add('GET', '/blog/list', [BlogController::class, 'list'], false);
$router->addPattern('GET', '#^/blog/([A-Za-z0-9_\-]+)$#', [BlogController::class, 'get'], false);

// Wikidata Routes
$router->add('GET', '/artist/wikidata', [WikidataController::class, 'getArtistFacts'], false);

// Sitemap Routes
$router->add('GET', '/sitemap.xml', [SitemapController::class, 'index'], false);

$app->run();
