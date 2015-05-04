<?php

use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;
use Storage\Uploader\Uploader;
use Kni\Domain\EventListener\UploadListener;
use Kni\Presentation\DomainManager\PresentationManager;
use Kni\Domain\EventListener\SlugListener;
use Kni\Presentation\Factory\PresentationFactory;
use Kni\Domain\AbstractFactory\AbstractFactory;
use Storage\Manager\FileManager;
use Persistence\BaseMongoManager;
use Cocur\Slugify\Slugify;
use Kni\Presentation\Slugify\SlugifyPresentation;


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

$app['dispatcher']->addListener(
    'resource.file.pre_create',
    array($app['listener.upload'], 'onSendPresentation')
);

$app['dispatcher']->addListener(
    'resource.file.pre_update',
    array($app['listener.upload'], 'onSendPresentation')
);

$app['kni.factory.presentation'] = function() use ($app) {
    return new PresentationFactory('Kni\Presentation\Model\Presentation');
};

$app['kni.factory.comment'] = function() use ($app) {
    return new AbstractFactory('Kni\Presentation\Model\Comment');
};

$app['kni.factory.file'] = function() use ($app) {
    return new AbstractFactory('Storage\Model\File');
};

$app['kni.manager.file'] = function() use ($app) {
    return new FileManager('manager', $app['dispatcher']);
};