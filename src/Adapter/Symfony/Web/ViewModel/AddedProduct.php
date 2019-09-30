<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony\Web\ViewModel;

use InventorySystem\Domain\Model\Product;

class AddedProduct
{
    public $title;

    public $onSale;

    public $ean;

    public function __construct(Product $product)
    {
        $this->title = 'Product title: ' . $product->getTitle();
        $this->ean =  'Product EAN' . $product->getEan();
        $this->onSale = $product->getEan() === '0000';
    }
}
