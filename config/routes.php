<?php

/**
 * There are declared static views
 */
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$names = [
    'home' => '/',
    'privacy' => '/privacy',
    'terms' => '/terms'
];

$routes = new RouteCollection();

foreach ($names as $key => $value){
    $routes->add($key, new Route($value, [
        '_controller' => "Symfony\Bundle\FrameworkBundle\Controller\TemplateController",
        'template'    => "static/$key.html.twig"
    ]));
}

return $routes;
