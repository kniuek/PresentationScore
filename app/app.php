<?php

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;

$app = new Application();

$app->register(new ServiceControllerServiceProvider());
$app->register(
    new Silex\Provider\TwigServiceProvider(),
    array(   
    )
);
$app->register(new RoutingServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return $app['request_stack']->getMasterRequest()->getBasepath().'/'.$asset;
    }));
    return $twig;
});


return $app;
