<?php

namespace App\Core;

class Application
{
    private Router $router;

    public function __construct()
    {
        Config::load();
        $this->router = new Router();
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function run(): void
    {
        if (Config::get('enable_gzip', true) && !headers_sent() && extension_loaded('zlib')) {
            if (str_contains($_SERVER['HTTP_ACCEPT_ENCODING'] ?? '', 'gzip')) {
                ini_set('zlib.output_compression', 'On');
                ini_set('zlib.output_compression_level', '6');
            }
        }

        $request = new Request();
        $this->router->dispatch($request);
    }
}
