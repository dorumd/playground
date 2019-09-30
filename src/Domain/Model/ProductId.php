<?php
declare(strict_types=1);

namespace InventorySystem\Domain\Model;

class ProductId
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public static function fromString(string $productId): self
    {
        return new self($productId);
    }
}
