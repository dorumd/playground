<?php
declare(strict_types=1);

namespace InventorySystem\UseCase\Product;

interface AddStockRequest
{
    public function getProductId(): string;

    public function getAvailableStock(): int;
}
