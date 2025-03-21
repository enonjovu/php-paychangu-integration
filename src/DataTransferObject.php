<?php

declare(strict_types=1);

namespace PaychanguIntegration;

interface DataTransferObject
{
    public static function makeFromArray(array $data): self;

    public function toArray(): array;
}
