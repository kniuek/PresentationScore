<?php

$app
    ->get('/', 'kni.controller.presentation:indexAction')
    ->bind('homepage')
;

$app
    ->get('/upload', 'kni.controller.presentation:uploadAction')
    ->bind('presentation.upload')
;

$app
    ->get('/record', 'kni.controller.presentation:recordAction')
    ->bind('presentation.record')
;

$app
    ->post('/file/upload', 'kni.controller.upload:uploadAction')
    ->bind('file.upload')
;

$app
    ->post('/upload', 'kni.controller.presentation:uploadAction')
    ->bind('presentation.upload.post')
;

$app->get('/login', function () use ($app) {
    $services = array_keys($app['oauth.services']);

    return $app['twig']->render('login.html.twig', array(
        'login_paths' => array_map(function ($service) use ($app) {
            return $app['url_generator']->generate('_auth_service', array(
                'service' => $service,
                '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('oauth')
            ));
        }, array_combine($services, $services)),
        'logout_path' => $app['url_generator']->generate('logout', array(
            '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('logout')
        ))
    ));
})->bind('modal-login');

$app->match('/logout', function () {})->bind('logout');

$app
    ->get('/presentation/{presentation}', 'kni.controller.presentation:showAction')
    ->bind('presentation.show')
;