<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony\Web\Presenter;

use InventorySystem\Adapter\Storage\InMemoryProductRepository;
use InventorySystem\UseCase\Product\AddProduct;
use InventorySystem\UseCase\Product\CountProducts;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ViewProductsPresenter
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
        $this->addProductUseCase->__invoke(
            new AddProductRequestWeb(Uuid::uuid4()->toString(), 'test', '00000')
        );

        return new Response('Hello world' . $this->countProductsUseCase->__invoke());
    }
}
