<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Storage;

use InventorySystem\Domain\Model\Product;
use InventorySystem\Domain\Port\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    /**
     * @var array
     */
    private $products = [];

    public function store(Product $product): void
    {
        $this->products[] = $product;
    }

    public function count(): int
    {
        return count($this->products);
    }
}
