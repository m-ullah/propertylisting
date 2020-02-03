<?php
/**
 *
 * @author     M Ullah <jitu21@gmail.com>
 * @copyright  2019 - 2020 M Ullah
 * @license    MIT
 * @version    1.0.0
 * @link       https://github.com/m-ullah/spotahome
 * @since      File available since Release 1.0.0
 * @deprecated File deprecated in Release 2.0.0
 * @copyright  Copyright (c) 2019 M Ullah
 */

require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set('UTC');
define('INTERFACE_CLI', php_sapi_name() === 'cli');

use Slim\App as SlimApp;
use SH\Framework\Infrastructure\ServiceProvider\CommandBusServiceProvider;
use SH\Framework\Interfaces\Http\ServiceProvider\ControllerServiceProvider;
use SH\Framework\Interfaces\Http\ServiceProvider\RouteServiceProvider;
use SH\Framework\Infrastructure\ServiceProvider\PDOServiceProvider;
use SH\Application\ErrorHandler as errHandler;
use Monolog\Logger;

define("BASE_PATH", dirname(__DIR__));

$config = [
    'service' => [
        'stage'               => 'local',
        'displayErrors'       =>  true
    ],
    'db' => [
        'file'                => BASE_PATH . '/data/property.db'
    ],
    'log' => [
        'file'                => BASE_PATH . '/logs/error.log'
    ],
    'xmlsource' => [
        'file'                => BASE_PATH . '/data/mitula-UK-en-2.xml'
    ]
];

$logger = new Logger('SH');
$logger->pushHandler(new \Monolog\Handler\StreamHandler($config['log']['file'], Logger::DEBUG));

$app = new SlimApp(["settings" => $config]);

$container = $app->getContainer();

$container['logger'] = $logger;

$container['errorHandler'] = function ($container) {
    return new errHandler($container['logger']);

};
$container['phpErrorHandler'] = function ($container) {
    return $container['errorHandler'];

};

$container[PDOServiceProvider::class] = function() use ($config) {
    return (new PDOServiceProvider($config))->boot();
};

(new CommandBusServiceProvider($config))->register($container);
(new ControllerServiceProvider())->register($container)->boot();
(new RouteServiceProvider())->connect($app);

if (!INTERFACE_CLI) {
    $app->run();
}
