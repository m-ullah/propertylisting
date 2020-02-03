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

namespace SH\Framework\Interfaces\Http\ServiceProvider;

use SH\Framework\Infrastructure\Service\PropertyFeedService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use SH\Framework\Infrastructure\Storage\PDO\TransactionAdapter as DataAdapter;
use SH\Application\Command\CommandBus\SimpleCommandBus;
use SH\Framework\Extension\Slim\BootableServiceProviderInterface;
use SH\Framework\Infrastructure\ServiceProvider\PDOServiceProvider;
use SH\Framework\Infrastructure\Storage\Repository\MerchantRepository;
use SH\Framework\Infrastructure\Storage\Repository\PropertyRepository;
use SH\Framework\Interfaces\Http\Controller\Currency\GetReportController;
use SH\Framework\Interfaces\Http\Controller\Currency\AddTransactionController;
use SH\Framework\Interfaces\Http\Controller\Property\GetPropertiesController;
use SH\Framework\Interfaces\Http\ServiceProvider\Response\ResponseFactory;

/**
 * Class ControllerServiceProvider
 *
 * @package SH\Framework\Interfaces\Http\ServiceProvider
 */
class ControllerServiceProvider implements ServiceProviderInterface, BootableServiceProviderInterface
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @return $this
     */
    public function boot()
    {
        $container = $this->container;

        $responseFactory = new ResponseFactory();
        $container[ResponseFactory::class] = $responseFactory;


        // Queries

        $dbAdapter = new DataAdapter(
            $container['logger'],
            $container[PDOServiceProvider::class]
        );

        $container[GetPropertiesController::class] = function () use ($responseFactory, $container, $dbAdapter) {
            return (new GetPropertiesController(new PropertyFeedService()))
                ->setResponseFactory($responseFactory)
                ->setPropertyRepository(new PropertyRepository($dbAdapter));
        };

        return $this;
    }
}
