<?php

declare(strict_types=1);

namespace PaychanguIntegration\Data;

class MobileChargeRequest extends BaseDataTransferObject
{
    public function __construct(
        public readonly MobileOperatorData $operator,
        public readonly User $user,
        public readonly int|float $amount,
        public readonly string $id,
    ) {
    }

    public static function makeFromArray(array $data): self
    {
        return new static(
            MobileOperatorData::makeFromArray($data['operator']),
            User::makeFromArray($data['user']),
            $data['amount'],
            $data['id'],
        );
    }

    public function toArray(): array
    {
        return [
            'operator' => $this->operator->toArray(),
            'user' => $this->user->toArray(),
            'amount' => $this->amount,
            'id' => $this->id,
        ];
    }

    public function makeRequestBody(): array
    {
        return [
            'mobile_money_operator_ref_id' => $this->operator->refId,
            'mobile' => $this->user->phoneNumber,
            'amount' => $this->amount,
            'charge_id' => $this->id,
            'email' => $this->user->email,
            'first_name' => $this->user->firstname,
            'last_name' => $this->user->lastname,
        ];
    }
}
