<?php

declare(strict_types=1);

namespace PaychanguIntegration\Http;

enum HttpMethod: string
{
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
}
