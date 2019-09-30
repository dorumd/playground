<?php
declare(strict_types=1);

namespace InventorySystem\UseCase\Product;

use InventorySystem\Domain\Port\ProductRepository;

class CountProducts
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(): int
    {
        return $this->productRepository->count();
    }
}
