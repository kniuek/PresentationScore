<?php

use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;
use Storage\Uploader\Uploader;
use Kni\Domain\EventListener\UploadListener;
use Kni\Presentation\DomainManager\PresentationManager;
use Kni\Domain\AbstractFactory\AbstractFactory;


$app['filesystem.adapter.local'] = function () {
    return new LocalAdapter(__DIR__.'/../../var/media');
};

$app['filesystem'] = function() use ($app) {
    return new Filesystem($app['filesystem.adapter.local']);
};

$app['uploader'] = function() use ($app) {
    return new Uploader($app['filesystem']);
};

$app['listener.upload'] = function() use ($app) {
    return new UploadListener($app['uploader']);
};

$app['dispatcher']->addListener(
    'resource.presentation.pre_create',
    array($app['listener.upload'], 'onSendPresentation')
);

$app['dispatcher']->addListener(
    'resource.presentation.pre_update',
    array($app['listener.upload'], 'onSendPresentation')
);

$app['kni.manager.presentation'] = function() use ($app) {
    return new PresentationManager('manager', $app['dispatcher']);
};

$app['kni.factory.presentation'] = function() use ($app) {
    return new AbstractFactory('Kni\Presentation\Model\Presentation');
};
