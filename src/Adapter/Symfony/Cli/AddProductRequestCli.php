<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony\Cli;

use InventorySystem\UseCase\Product\AddProductRequest;

class AddProductRequestCli implements AddProductRequest
{
    private $productId;

    private $title;

    private $ean;

    public function __construct(string $productId, string $title, string $ean)
    {
        $this->productId = $productId;
        $this->title = $title;
        $this->ean = $ean;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }
}
