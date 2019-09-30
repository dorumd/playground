<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony\Cli;

use InventorySystem\Adapter\Storage\InMemoryProductRepository;
use InventorySystem\UseCase\Product\AddProduct;
use InventorySystem\usecase\Product\CountProducts;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportProductsCommand extends Command
{
    private $productGoogleSpreadsheet;

    private $productRepository;

    private $addProduct;

    private $countProducts;

    public function __construct()
    {
        $this->productGoogleSpreadsheet = new ProductsGoogleSpreadsheet();
        $this->productRepository = new InMemoryProductRepository();
        $this->addProduct = new AddProduct($this->productRepository);
        $this->countProducts = new CountProducts($this->productRepository);
        parent::__construct();
    }

    protected static $defaultName = 'import-products';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            sprintf(
                '<info>There are %d products before import. Running import....</info>',
                $this->countProducts()
            )
        );

        $productsToImport = $this->productGoogleSpreadsheet->fetchProducts();
        $output->writeln(sprintf('<comment>Found %d product(s) to import.</comment>', count($productsToImport)));

        foreach ($productsToImport as $product) {
            $this->addProduct->__invoke(
                new AddProductRequestCli(Uuid::uuid4()->toString(), $product['title'], $product['ean'])
            );
        }

        $output->writeln(
            sprintf(
                '<info>Imported complete. There are %d products now.</info>',
                $this->countProducts()
            )
        );
    }

    private function countProducts(): int
    {
        return $this->countProducts->__invoke();
    }
}
