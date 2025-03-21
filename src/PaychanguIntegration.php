<?php

declare(strict_types=1);

namespace PaychanguIntegration;

use PaychanguIntegration\Data\GetMobileOperatorResponse;
use PaychanguIntegration\Data\PaychangeKey;
use PaychanguIntegration\Http\HttpClient;
use PaychanguIntegration\Mobile\MobileOperators;

class PaychanguIntegration
{
    private HttpClient $client;

    public function __construct(private PaychangeKey $key)
    {
        $this->client = new HttpClient();
    }


    public function getMobileOpertors()
    {
        $requent = MobileOperators::fetchOperators($this->client);
        $operators = GetMobileOperatorResponse::makeFromArray($requent->body);
        return $operators->data;
    }
}
