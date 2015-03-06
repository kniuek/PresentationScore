<?php

use Web\Controller\PresentationController;
use Silex\Provider\MonologServiceProvider;


$app['controller.presentation'] = function () use ($app) {
    return new PresentationController(
        $app['twig']
    );
};

