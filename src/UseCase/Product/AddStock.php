<?php
declare(strict_types=1);

namespace InventorySystem\UseCase\Product;

use InventorySystem\Domain\Exception\MissingProduct;
use InventorySystem\Domain\Model\ProductId;
use InventorySystem\Domain\Model\ProductStock;
use InventorySystem\Domain\Port\ProductRepository;
use InventorySystem\Domain\Port\ProductStockRepository;

class AddStock
{
    private $productRepository;

    private $stockRepository;

    public function __construct(ProductRepository $productRepository, ProductStockRepository $stockRepository)
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
    }

    public function __invoke(AddStockRequest $request)
    {
        $product = $this->productRepository->findById($request->getProductId());
        if (!$product) {
            throw new MissingProduct($request->getProductId());
        }

        $productStock = new ProductStock(
            ProductId::fromString($request->getProductId()),
            $request->getAvailableStock()
        );
        $this->stockRepository->store($productStock);
    }
}
