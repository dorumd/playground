<?php

require __DIR__.'/../vendor/autoload.php';

use InventorySystem\adapter\symfony\cli\ImportProductsCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new ImportProductsCommand());


$application->run();