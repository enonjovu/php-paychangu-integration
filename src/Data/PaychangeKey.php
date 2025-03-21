<?php

declare(strict_types=1);

namespace PaychanguIntegration\Data;

class PaychangeKey extends BaseDataTransferObject
{
    public function __construct(public readonly string $key)
    {
    }

    public static function makeFromArray(array $data): self
    {
        return new static($data['key']);
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
        ];
    }
}
