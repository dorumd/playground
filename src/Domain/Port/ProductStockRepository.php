<?php
declare(strict_types=1);

namespace InventorySystem\Domain\Port;

use InventorySystem\Domain\Model\ProductStock;

interface ProductStockRepository
{
    public function store(ProductStock $productStock);
}
