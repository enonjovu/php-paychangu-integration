<?php

declare(strict_types=1);

namespace PaychanguIntegration\Data;

use ArrayAccess;
use Countable;
use Override;
use PaychanguIntegration\DataTransferObject;
use Stringable;

abstract class BaseDataTransferObject implements
    ArrayAccess,
    Countable,
    DataTransferObject,
    Stringable
{
    #[Override()]
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    #[Override]
    abstract public function toArray(): array;

    public function toString(): string
    {
        return $this->__toString();
    }

    public function makeFromString(string $rep): array
    {
        return json_decode($rep, true);
    }

    #[Override]
    public function count(): int
    {
        return count($this->toArray());
    }

    #[Override]
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    #[Override]
    public function offsetGet(mixed $offset): mixed
    {
        return $this->toArray()[$offset];
    }

    #[Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->{$offset} = $value;
    }

    #[Override]
    public function offsetUnset(mixed $offset): void
    {
        unset($this->{$offset});
    }

    public function copy(array $data = []): self
    {
        return self::makeFromArray([
            ...$this->toArray(),
            ...$data,
        ]);
    }
}
