<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Storage;

use InventorySystem\Domain\Model\ProductStock;
use InventorySystem\Domain\Port\ProductStockRepository;

class InMemoryProductStockRepository implements ProductStockRepository
{
    private $productStock = [];

    public function store(ProductStock $productStock)
    {
        $this->productStock[] = $productStock;
    }
}
