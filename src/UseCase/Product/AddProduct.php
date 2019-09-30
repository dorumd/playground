<?php
declare(strict_types=1);

namespace InventorySystem\UseCase\Product;

use InventorySystem\Domain\Model\Product;
use InventorySystem\Domain\Model\ProductId;
use InventorySystem\Domain\Port\ProductRepository;

class AddProduct
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(AddProductRequest $input): Product
    {
        $productId = new ProductId($input->getProductId());
        $product = new Product($productId, $input->getTitle(), $input->getEan());
        $this->productRepository->store($product);

        return $product;
    }
}
