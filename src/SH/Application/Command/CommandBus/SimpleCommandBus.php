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

use SH\Application\Command\Exception\CommandDispatchException;

use Monolog\Logger;

class SimpleCommandBus implements CommandBusInterface
{
    /**
     * @var array $handlers
     */
    private $handlers = [];

    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(CommandMessageInterface $message)
    {
        $commandName = $message->getCommandName();

        if (isset($this->handlers[$commandName])) {
            $this->log($message); // TODO: consider moving this out and making wrapper around the bus
            return $this->handlers[$commandName]->handle($message);
        }

        throw new CommandDispatchException(
            sprintf(
                "No handler found for the %s Command",
                get_class($message->getPayload())
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe($commandName, CommandHandlerInterface $handler)
    {
        $this->handlers[$commandName] = $handler;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function unsubscribe($commandName)
    {
        if(isset($this->handlers[$commandName])) {
            unset($this->handlers[$commandName]);
            return true;
        }

        return false;
    }

    private function log($message)
    {
        $payload = $message->getPayload();
        $payloadArr = $payload->toArray();
        $shortCmdName = substr(strrchr($message->getCommandName(), '\\'), 1);

        $this->logger->debug($shortCmdName.': '.json_encode($payloadArr));
    }
}
