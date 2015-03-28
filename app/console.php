<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application as Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Kni\Fixtures\Command\LoadFixturesCommand;

$app = require __DIR__.'/app.php';
require __DIR__.'/config/dev.php';
require __DIR__.'/services/controllers.php';
require __DIR__.'/services/services.php';
require __DIR__.'/services/repository.php';

$console = new Console('My Silex Application', 'n/a');
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);

$command = new LoadFixturesCommand();
$command->setApp($app);
$console->add($command);
$console->run();
