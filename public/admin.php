<?php

require __DIR__ . '/../vendor/autoload.php';

use InventorySystem\Adapter\Symfony\Web\Presenter\AddProductPresenter;
use InventorySystem\Adapter\Symfony\Web\Presenter\ViewProductsPresenter;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

try {
    $routes = registerRoutes();
    $request = Request::createFromGlobals();

    $matcher = new UrlMatcher($routes, new RequestContext('/'));

    $dispatcher = new EventDispatcher();
    $dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

    $controllerResolver = new ControllerResolver();
    $argumentResolver = new ArgumentResolver();

    $kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

    $response = $kernel->handle($request);
    $response->send();

    $kernel->terminate($request, $response);
} catch (\Exception $e) {
    echo '<h1>Something unexpected happened!</h1>' . '<br />';
    echo $e;
}


function registerRoutes(): RouteCollection
{
    $routes = new RouteCollection();

    $viewProducts = new Route('/products', ['_controller' => ViewProductsPresenter::class]);
    $routes->add('admin_products_index', $viewProducts);

    $addProduct = new Route('/products/add', ['_controller' => AddProductPresenter::class]);
    $addProduct->setMethods(['POST', 'GET']);
    $routes->add('admin_products_add', $addProduct);


    return $routes;
}
