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

namespace SH\Application\Command\CommandBus;

/**
 * Interface CommandBusInterface
 * Expects there will only be one handler for each command
 *
 * @package SH\Application\Command\CommandBus
 */
interface CommandBusInterface
{
    public function dispatch(CommandMessageInterface $message);

    public function subscribe($commandName, CommandHandlerInterface $handler);

    public function unsubscribe($commandName);
}
