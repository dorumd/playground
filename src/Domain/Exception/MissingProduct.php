<?php
declare(strict_types=1);

namespace InventorySystem\Domain\Exception;

class MissingProduct extends \DomainException
{
    public function __construct(string $productId)
    {
        parent::__construct("Product %s ");
    }
}