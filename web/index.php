<?php

ini_set('display_errors', 0);

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../app/app.php';
require __DIR__.'/../app/config/prod.php';
require __DIR__.'/../app/services/controllers.php';
require __DIR__.'/../app/services/repository.php';
require __DIR__.'/../app/services/services.php';
require __DIR__.'/../app/services/listeners.php';
require __DIR__.'/../app/routing/routes.php';
$app->boot();
$app->run();
