<?php

declare(strict_types=1);

namespace PaychanguIntegration\Data;

use PaychanguIntegration\DataTransferObject;

class GetMobileOperatorResponse extends BaseDataTransferObject
{
    /**
     * @param MobileOperatorData[] $data
     */
    public function __construct(
        public readonly string $status,
        public readonly string $message,
        public readonly array $data,
    ) {
    }

    public static function makeFromArray(array $data): self
    {
        $_data = array_map(fn (array $_data) => MobileOperatorData::makeFromArray($_data), $data['data']);

        return new static(
            $data['status'],
            $data['message'],
            $_data,
        );
    }

    public function toArray(): array
    {
        return [];
    }
}
