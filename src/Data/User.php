<?php

declare(strict_types=1);

namespace PaychanguIntegration\Data;

class User extends BaseDataTransferObject
{
    public function __construct(
        public readonly string $phoneNumber,
        public readonly ?string $firstname = null,
        public readonly ?string $lastname = null,
        public readonly ?string $email = null,
    ) {
    }
    public static function makeFromArray(array $data): self
    {
        return new static(
            $data['phone_number'],
            $data['first_name'] ?? null,
            $data['last_name'] ?? null,
            $data['email'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'phone_number' => $this->phoneNumber,
            'first_name' => $this->firstname,
            'last_name' => $this->lastname,
            'email' => $this->email,
        ];
    }
}
