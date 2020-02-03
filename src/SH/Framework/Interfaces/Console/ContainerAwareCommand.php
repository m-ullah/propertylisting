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

namespace SH\Framework\Interfaces\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Slim\App;

/**
 * Class ContainerAwareCommand
 *
 * @package SH\Framework\Interfaces\Console
 */
abstract class ContainerAwareCommand extends Command
{
    protected $container;

    public function __construct($container, $name = null)
    {
        parent::__construct($name);
        $this->container = $container;
    }

    protected function getContainer()
    {
        return $this->container->getContainer();
    }
}
