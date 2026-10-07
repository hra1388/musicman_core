<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Config;

class SitemapController
{
    public function index(Request $request): void
    {
        $siteUrl = Config::get('url');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        $xml .= '  <sitemap>' . "\n";
        $xml .= '    <loc>' . htmlspecialchars($siteUrl . '/api/sitemap_1.xml') . '</loc>' . "\n";
        $xml .= '    <lastmod>' . date('c') . '</lastmod>' . "\n";
        $xml .= '  </sitemap>' . "\n";
        $xml .= '</sitemapindex>';

        Response::xml($xml);
    }
}
