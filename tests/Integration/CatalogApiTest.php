<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\Core\Request;

class CatalogApiTest extends TestCase
{
    public function testRequestParsing(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/api/search?term=coldplay';
        $_GET['term'] = 'coldplay';

        $request = new Request();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/search', $request->getPath());
        $this->assertEquals('coldplay', $request->getParam('term'));
    }
}
