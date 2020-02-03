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

use SH\Framework\Interfaces\Http\ServiceProvider\Response\ResponseFactoryInterface;

/**
 * Class Controller
 *
 * @package SH\Framework\Interfaces\Http\Controller
 */
abstract class Controller implements ControllerInterface
{
    /**
     * @var ResponseFactoryInterface $responseFactory
     */
    protected $responseFactory;

    /**
     * {@inheritdoc}
     */
    public function setResponseFactory(ResponseFactoryInterface $factory)
    {
        $this->responseFactory = $factory;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseFactory()
    {
        return $this->responseFactory;
    }
}
