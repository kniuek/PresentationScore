<?php

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\FormServiceProvider;
use \Mongo;

$app = new Application();

$app->register(new ServiceControllerServiceProvider());
$app->register(
    new Silex\Provider\TwigServiceProvider(),
    array(   
    )
);
$app->register(new RoutingServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new FormServiceProvider());
// Provides URL generation
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'presentation',
        'user'      => 'root',
        'password'  => null,
        'charset'   => 'utf8',
    ),
));


$app['config.database'] = 'kni';
$app['config.server'] = 'localhost';
$app['mongo'] = function () use ($app) {
    $connection =  new MongoClient($app['config.server']);
    return $connection;
};


$app->register(new Web\OAuthServiceProvider(), array(
    'oauth.services' => array(
        'facebook' => array(
            'key' => '1596856190526137',
            'secret' => '51f66709f87f2fe7b81af6efa52bb112',
            'scope' => array('email'),
            'user_endpoint' => 'https://graph.facebook.com/me'
        ),
    )
));
////
// Provides session storage
$app->register(new Silex\Provider\SessionServiceProvider());
//
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'default' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'oauth' => array(
                'login_path' => '/auth/{service}',
                'callback_path' => '/auth/{service}/callback',
                'check_path' => '/auth/{service}/check',
                'failure_path' => '/login',
                'with_csrf' => false
            ),
            'logout' => array(
                'logout_path' => '/logout',
                'with_csrf' => false
            ),
            'users' => new Gigablah\Silex\OAuth\Security\User\Provider\OAuthInMemoryUserProvider()
        )
    ),
    'security.access_rules' => array(
        array('^/auth', 'ROLE_USER')
    )
));


$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return $app['request_stack']->getMasterRequest()->getBasepath().'/'.$asset;
    }));
    return $twig;
});

return $app;
