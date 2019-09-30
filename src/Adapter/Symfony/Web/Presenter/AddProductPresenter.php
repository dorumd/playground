<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony\Web\Presenter;

use InventorySystem\Adapter\Storage\InMemoryProductRepository;
use InventorySystem\Adapter\Symfony\Web\ViewModel\AddedProduct;
use InventorySystem\UseCase\Product\AddProduct;
use InventorySystem\UseCase\Product\CountProducts;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddProductPresenter
{
    private $productsRepository;

    private $addProductUseCase;

    private $countProductsUseCase;

    public function __construct()
    {
        $this->productsRepository = new InMemoryProductRepository();
        $this->addProductUseCase = new AddProduct($this->productsRepository);
        $this->countProductsUseCase = new CountProducts($this->productsRepository);
    }

    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $title = $data['title'] ?? '';
        $ean = $data['ean'] ?? '';

        $addedProduct = new AddedProduct(
            $this->addProductUseCase->__invoke(
                new AddProductRequestWeb(Uuid::uuid4()->toString(), $title, $ean)
            )
        );

        return new Response(
            'Added product. <br /> ' . $addedProduct->title .
            '.<br /> On sale: '
            . ($addedProduct->onSale ? '<span style="color: green">YES</span>' : '<span style="color: red">NO</span>')
        );
    }
}
