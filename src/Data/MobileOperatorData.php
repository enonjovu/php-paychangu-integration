<?php

declare(strict_types=1);

namespace PaychanguIntegration\Data;

use PaychanguIntegration\DataTransferObject;

class MobileOperatorData extends BaseDataTransferObject
{
    public readonly MobileServiceProvider $provider;

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $refId,
        public readonly string $shortCode,
        public readonly bool $supportsWithdrawals = false
    ) {
        $this->provider = MobileServiceProvider::from($shortCode);
    }

    public static function makeFromArray(array $data): self
    {
        return new static(
            $data['id'],
            $data['name'],
            $data['ref_id'],
            $data['short_code'],
            $data['supports_withdrawals'],
        );
    }

    public function toArray(): array
    {
        return [];
    }
}
