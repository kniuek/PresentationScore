<?php

use Kni\Domain\EventListener\SlugListener;
use Cocur\Slugify\Slugify;
use Kni\Presentation\Slugify\SlugifyPresentation;


$app['slugify'] = function() {
    return new Slugify();
};

$app['presentation.slugify'] = function() use ($app) {
    return new SlugifyPresentation($app['slugify'], $app['kni.repository.presentation']);
};

$app['listener.slugify_presentation'] = function() use ($app) {
    return new SlugListener($app['presentation.slugify']);
};

$app['dispatcher']->addListener(
    'resource.presentation.pre_create',
    array($app['listener.slugify_presentation'], 'onCreatePresentation')
);