<?php
declare(strict_types=1);

namespace InventorySystem\Domain\Port;

use InventorySystem\Domain\Model\Product;

interface ProductRepository
{
    public function store(Product $product): void;

    public function count(): int;
}
