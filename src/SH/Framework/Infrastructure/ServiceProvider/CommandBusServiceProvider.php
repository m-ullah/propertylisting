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

namespace SH\Framework\Infrastructure\ServiceProvider;

use SH\Application\Command\Property\Handler\SyncPropertyListHandler;
use SH\Application\Command\Property\SyncPropertyListCommand;
use SH\Framework\Infrastructure\Storage\PDO\TransactionAdapter as DataAdapter;
use SH\Application\Command\CommandBus\SimpleCommandBus;
use SH\Framework\Infrastructure\Storage\Repository\PropertyRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class CommandBusServiceProvider
 *
 * @package SH\Framework\Infrastructure\ServiceProvider
 */
class CommandBusServiceProvider implements ServiceProviderInterface
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Registers services on the given container. Pimple Dependency Injection Container
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $dbAdapter = new DataAdapter(
            $pimple['logger'],
            $pimple[PDOServiceProvider::class]
        );

        $pimple[SimpleCommandBus::class] = function () use ($pimple, $dbAdapter) {
            return (new SimpleCommandBus($pimple['logger']))
                ->subscribe(
                    SyncPropertyListCommand::class,
                    new SyncPropertyListHandler(
                        new PropertyRepository($dbAdapter)
                    )
                );
        };
    }
}
