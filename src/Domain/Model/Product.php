<?php
declare(strict_types=1);

namespace InventorySystem\Domain\Model;

class Product
{
    private $productId;

    private $title;

    private $ean;

    public function __construct(ProductId $productId, string $title, string $ean)
    {
        $this->productId = $productId;
        $this->title = $title;
        $this->ean = $ean;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getEan(): string
    {
        return $this->ean;
    }
}
