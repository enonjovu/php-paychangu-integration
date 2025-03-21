<?php

declare(strict_types=1);

namespace PaychanguIntegration\Mobile;

use PaychanguIntegration\Data\MobileChargeRequest;
use PaychanguIntegration\Data\MobileOperatorData;
use PaychanguIntegration\Data\MobileServiceProvider;
use PaychanguIntegration\Data\PaychangeKey;
use PaychanguIntegration\Data\User;
use PaychanguIntegration\Http\HttpClient;
use PaychanguIntegration\Http\HttpMethod;
use PaychanguIntegration\Http\HttpRequestBuilder;
use Ramsey\Uuid\Uuid;

class MobileTransaction
{
    public function __construct(
        private readonly PaychangeKey $paychangeKey,
        private readonly HttpClient $httpClient,
        private readonly User $user
    ) {
    }

    public function charge(MobileOperatorData $mobileOperatorData, int|float $amount)
    {
        $id = Uuid::uuid4()->toString();

        $requestData = new MobileChargeRequest($mobileOperatorData, $this->user, $amount, $id);

        new HttpRequestBuilder($this->httpClient)
            ->withKey($this->paychangeKey)
            ->setMethod(HttpMethod::POST)
            ->setBody($requestData->toArray());
    }
}
