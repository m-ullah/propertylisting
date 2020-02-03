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

use SH\Framework\Interfaces\Http\ServiceProvider\Response\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SH\Framework\Interfaces\Http\ServiceProvider\Response\ResponseFactoryInterface;

/**
 * Interface ControllerInterface
 *
 * @package SH\Framework\Interfaces\Http\Controller
 */
interface ControllerInterface
{

    /**
     * Execute an incoming HTTP request
     *
     * @param ServerRequestInterface $request The incoming resquest
     *
     * @return ResponseInterface
     */
    public function execute(ServerRequestInterface $request);

    /**
     * Sets the response factory to be used to generate the response
     *
     * @param ResponseFactoryInterface $factory
     *
     * @return $this
     */
    public function setResponseFactory(ResponseFactoryInterface $factory);

    /**
     * Gets an instance of the response factory
     *
     * @return ResponseFactory
     */
    public function getResponseFactory();
}
