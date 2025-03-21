<?php

declare(strict_types=1);
use PaychanguIntegration\Data\GetMobileOperatorResponse;
use PaychanguIntegration\Http\HttpClient;
use PaychanguIntegration\Mobile\MobileOperators;

require __DIR__.'/vendor/autoload.php';

$clients = MobileOperators::fetchOperators(new HttpClient());
dd(GetMobileOperatorResponse::makeFromArray($clients->body));
