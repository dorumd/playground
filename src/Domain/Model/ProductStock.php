<?php
declare(strict_types=1);

namespace InventorySystem\Domain\Model;

class ProductStock
{
    private $productId;

    private $availableStock;

    public function __construct(ProductId $productId, int $availableStock)
    {
        $this->productId = $productId;
        $this->availableStock = $availableStock;
    }

    public function getAvailableStock(): int
    {
        return $this->availableStock;
    }
}
