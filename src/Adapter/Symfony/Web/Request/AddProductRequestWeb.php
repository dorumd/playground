<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony\Web\Request;

use InventorySystem\UseCase\Product\AddProductRequest;

class AddProductRequestWeb implements AddProductRequest
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

    /**
     * @param string $productId
     * @param string $json
     * @return AddProductRequestWeb
     */
    public static function fromJsonData(string $productId, string $json): self
    {
        $data = json_decode($json, true);

        return new self(
            $productId,
            $data['title'] ?? '',
            $data['ean'] ?? ''
        );
    }
}
