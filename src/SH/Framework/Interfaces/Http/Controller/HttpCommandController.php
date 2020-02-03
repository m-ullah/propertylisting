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

namespace SH\Framework\Interfaces\Http\Controller;

use SH\Application\Command\CommandBus\CommandBusInterface;
use Monolog\Logger;

/**
 * Class HttpRequestController
 *
 * @package SH\Framework\Interfaces\Http\Controller
 */
abstract class HttpCommandController extends Controller implements HttpCommandControllerInterface
{
    /**
     * @var CommandBusInterface
     */
    protected $commandBus;


    protected $logger;

    /**
     * {@inheritdoc}
     */
    public function setCommandBus(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCommandBus()
    {
        return $this->commandBus;
    }

    /**
     * {@inheritdoc}
     */
    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
