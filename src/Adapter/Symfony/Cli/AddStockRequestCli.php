<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony\Cli;

use InventorySystem\UseCase\Product\AddStockRequest;

class AddStockRequestCli implements AddStockRequest
{
    private $productId;

    private $availableStock;

    public function __construct(string $productId, int $availableStock)
    {
        $this->productId = $productId;
        $this->availableStock = $availableStock;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getAvailableStock(): int
    {
        return $this->availableStock;
    }
}
