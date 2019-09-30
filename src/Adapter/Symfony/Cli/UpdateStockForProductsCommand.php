<?php
declare(strict_types=1);

namespace InventorySystem\Adapter\Symfony\Cli;

use InventorySystem\Adapter\Storage\InMemoryProductRepository;
use InventorySystem\Adapter\Storage\InMemoryProductStockRepository;
use InventorySystem\Domain\Exception\MissingProduct;
use InventorySystem\UseCase\Product\AddStock;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateStockForProductsCommand extends Command
{
    private $productGoogleSpreadsheet;

    private $productRepository;

    private $productStockRepository;

    private $addStockUseCase;

    public function __construct()
    {
        $this->productGoogleSpreadsheet = new ProductsGoogleSpreadsheet();
        $this->productRepository = new InMemoryProductRepository();
        $this->productStockRepository = new InMemoryProductStockRepository();
        $this->addStockUseCase = new AddStock($this->productRepository, $this->productStockRepository);
        parent::__construct();
    }

    protected static $defaultName = 'update-stock';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $stock = $this->productGoogleSpreadsheet->fetchProductStock();

        foreach ($stock as $productId => $availableStock) {
            try {
                $this->addStockUseCase->__invoke(
                    new AddStockRequestCli($productId, $availableStock)
                );
            } catch (MissingProduct $exception) {
                $output->writeln(sprintf('Product %s is not in our system. Cannot update stock.', $productId));
                continue;
            }
        }
    }
}
