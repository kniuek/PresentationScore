<?php

use Persistence\Repository\PresentationRepository;
use Kni\Presentation\DomainManager\PresentationManager;


$app['kni.manager.presentation'] = function() use ($app) {
    return new PresentationManager(
        $app['document.manager.default'],
        $app['dispatcher']
    );
};

$app['kni.repository.presentation'] = function () use ($app) {
    $repo = new PresentationRepository($app['kni.manager.presentation'], $app['kni.factory.presentation']);

    return $repo;
};


