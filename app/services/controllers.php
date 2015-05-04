<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Web\Controller\PresentationController;
use Web\Controller\UploadController;
use Web\Controller\StreamController;


//Request::setTrustedProxies(array('127.0.0.1'));

$app['kni.controller.presentation'] = function() use ($app) {
    $controller = new PresentationController(
        $app['twig'], $app['form.factory'], $app['kni.manager.presentation']
    );

    $controller->setPresentationFactory($app['kni.factory.presentation']);
    $controller->setCommentFactory($app['kni.factory.comment']);
    $controller->setRepository($app['kni.repository.presentation']);

    return $controller;
};

$app['kni.controller.upload'] = function() use ($app) {
    $controller = new UploadController(
        $app['kni.manager.file'],
        $app['kni.factory.file']
    );

    return $controller;
};

$app['kni.controller.stream'] = function() use ($app) {
    $controller = new StreamController(
        $app['filesystem']
    );
    return $controller;
};

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
