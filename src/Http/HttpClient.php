<?php

declare(strict_types=1);

namespace PaychanguIntegration\Http;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{

    private GuzzleHttpClient $client;

    public function __construct()
    {

        $handler = $this->createHandlerStack();

        $this->client = new GuzzleHttpClient([
            'handler' => $handler
        ]);
    }

    private function createHandlerStack(): HandlerStack
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());

        $stack->push(Middleware::mapResponse(fn (ResponseInterface $response) =>
            $response
                ->withHeader('Accept', 'application/json')
                ->withHeader('Content-Type', 'application/json')
        ));

        return $stack;
    }

    public function getClient(): GuzzleHttpClient
    {
        return $this->client;
    }
}
