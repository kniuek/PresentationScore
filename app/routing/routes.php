<?php

$app
    ->get('/', 'kni.controller.presentation:indexAction')
    ->bind('homepage')
;

$app
    ->get('/stream', 'kni.controller.stream:streamAction')
    ->bind('stream')
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

$app
    ->post('/presentation/{slug}/rate', 'kni.controller.presentation:rateAction')
    ->bind('presentation_rate')
;

$app->get('/login', function () use ($app) {
    $services = array_keys($app['oauth.services']);

    return $app['twig']->render('login.html.twig', array(
        'login_paths' => array_map(function ($service) use ($app) {
            return $app['url_generator']->generate('_auth_service', array(
                'service' => $service,
                '_csrf_token' => $app['form.csrf_provider']->getToken('oauth')
            ));
        }, array_combine($services, $services)),
        'logout_path' => $app['url_generator']->generate('logout', array(
            '_csrf_token' => $app['form.csrf_provider']->getToken('logout')
        ))
    ));
})->bind('modal-login');

$app->match('/logout', function () {})->bind('logout');

$app
    ->get('/presentation/{slug}', 'kni.controller.presentation:showAction')
    ->bind('presentation.show')
;

$app
    ->post('/presentation/{slug}', 'kni.controller.presentation:commentAction')
    ->bind('presentation.comment')
;