<?php

use Demo\Controller\DemoController;
use Silex\Provider\MonologServiceProvider;


$app['controller.demo'] = function () use ($app) {
    return new DemoController(
        $app['twig']
    );
};

