<?php

declare(strict_types=1);

namespace PaychanguIntegration\Http;

use GuzzleHttp\Psr7\Request;
use PaychanguIntegration\Data\HttpResponseData;
use PaychanguIntegration\Data\PaychangeKey;

class HttpRequestBuilder
{
    private HttpMethod $method = HttpMethod::GET;

    private string $url = '';
    private array $headers = [];
    private array $body = [];

    public function __construct(
        private HttpClient $httpClient
    ) {
    }

    public function setMethod(HttpMethod|string $method): self
    {
        $this->method = is_string($method) ? HttpMethod::from(strtoupper($method)) : $method;
        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function setBody(array $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function setBearerToken(string $token): self
    {
        $this->headers['Authorization'] = sprintf('Bearer %s', $token);
        return $this;
    }

    public function withKey(PaychangeKey $paychangeKey)
    {
        return $this->setBearerToken($paychangeKey->key);
    }

    public function send()
    {
        $request = new Request($this->method->value, $this->url, $this->headers, json_encode($this->body));

        $response = $this->httpClient->getClient()->sendRequest($request);

        return HttpResponseData::makeFromArray([
            'status' => $response->getStatusCode(),
            'body' => json_decode($response->getBody()->getContents(), true)
        ]);
    }
}
