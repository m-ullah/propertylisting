<?php

//Provides $app, which is an instance of Slim\App
require_once 'bootstrap.php';

use Symfony\Component\Console\Application;
use SH\Application\Command\CommandBus\SimpleCommandBus;

$application = new Application();

/** @var CommandBusInterface $commandBus */
$commandBus = $container[SimpleCommandBus::class];

$application->add(new \SH\Framework\Interfaces\Console\FetchPropertyFeedCommand($app, $commandBus));
$application->run();
