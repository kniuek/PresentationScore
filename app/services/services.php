<?php

use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;
use Storage\Uploader\Uploader;
use Kni\Domain\EventListener\UploadListener;

$app['filesystem.adapter.local'] = function () {
    return new LocalAdapter('/var/media');
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
    'presentation.pre_create',
    array($app['listener.upload'], 'onSendPresentation')
);

$app['dispatcher']->addListener(
    'presentation.pre_update',
    array($app['listener.upload'], 'onSendPresentation')
);

