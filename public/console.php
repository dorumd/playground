<?php

require __DIR__.'/../vendor/autoload.php';

use InventorySystem\adapter\symfony\cli\ImportProductsCommand;
use InventorySystem\Adapter\Symfony\Cli\UpdateStockForProductsCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new ImportProductsCommand());
$application->add(new UpdateStockForProductsCommand());


$application->run();
