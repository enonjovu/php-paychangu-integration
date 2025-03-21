<?php

declare(strict_types=1);

namespace PaychanguIntegration\Data;

class HttpResponseData extends BaseDataTransferObject
{
    public function __construct(public int $status, public array $body)
    {
    }

    public static function makeFromArray(array $data): self
    {
        return new static($data['status'], $data['body']);
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'data' => $this->body,
        ];
    }
}
