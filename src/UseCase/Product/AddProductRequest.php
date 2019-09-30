<?php
declare(strict_types=1);

namespace InventorySystem\UseCase\Product;

interface AddProductRequest
{
    public function getTitle(): string;

    public function getEan(): string;

    public function getProductId(): string;
}
