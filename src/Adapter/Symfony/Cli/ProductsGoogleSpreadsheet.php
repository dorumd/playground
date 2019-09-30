<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony;

class ProductsGoogleSpreadsheet
{
    public function fetchProducts(): array
    {
        return [
            [
                'title' => 'Test 1',
                'ean' => '00000000',
            ],
            [
                'title' => 'Test 2',
                'ean' => '00000000',
            ],
            [
                'title' => 'Test 3',
                'ean' => '00000000',
            ],
            [
                'title' => 'Test 4',
                'ean' => '00000000',
            ],
        ];
    }
}
