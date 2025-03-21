<?php

declare(strict_types=1);

namespace PaychanguIntegration\Mobile;

use GuzzleHttp\Client;
use PaychanguIntegration\Http\HttpClient;
use PaychanguIntegration\Http\HttpRequestBuilder;

class MobileOperators
{
    public static function fetchOperators(HttpClient $httpClient)
    {
        return new HttpRequestBuilder($httpClient)
            ->setUrl('https://api.paychangu.com/mobile-money')->send();
    }
}
