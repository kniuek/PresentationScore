<?php

use Persistence\Repository\PresentationRepository;
use Kni\Presentation\DomainManager\PresentationManager;


$app['kni.repository.presentation'] = function () use ($app) {
    $repo = new PresentationRepository($app['kni.manager.presentation']);

    return $repo;
};

$app['kni.manager.presentation'] = function() use ($app) {
    return new PresentationManager(
        $app['document.manager.default'],
        $app['dispatcher']
    );
};
