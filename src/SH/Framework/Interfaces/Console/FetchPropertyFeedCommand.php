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

use SH\Application\Command\CommandBus\CommandBusInterface;
use SH\Application\Command\CommandBus\DefaultCommandMessageProvider;
use SH\Application\Command\CommandBus\SimpleCommandBus;
use SH\Application\Command\Property\SyncPropertyListCommand;
use SH\Framework\Infrastructure\Service\PropertyFeedService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SH\Application\Command\DefaultCommandMessage;

/**
 * Class FetchPropertyFeedCommand
 *
 * @package SH\Framework\Interfaces\Console
 */
class FetchPropertyFeedCommand extends ContainerAwareCommand
{
    /**
     * @var CommandBusInterface
     */
    private $handler;

    /**
     * QueueMessageConsumerSymfonyCommand constructor.
     *
     * @param \Slim\App        $container
     * @param SimpleCommandBus $handler
     * @param string|null      $name
     */
    public function __construct($container, SimpleCommandBus $handler, $name = null)
    {
        parent::__construct($container, $name);

        $this->handler = $handler;
    }

    protected function configure()
    {
        $this->setName('worker:sync-property')
            ->setDescription('syncs property from XMF feed');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $service = new PropertyFeedService();
        $settings = $this->getContainer()->get("settings");

        $output->writeln('Fetching data from: ' . $settings['xmlsource']['file']);

        $data = $service->fetchXMLFeed($settings['xmlsource']['file']);

        $output->writeln(count($data) . ' Items found');
        $output->writeln('Syncing ...');

        foreach ($data as $item) {
            $command = new SyncPropertyListCommand($item->id, json_encode($item));
            $commandMessageProvider = new DefaultCommandMessageProvider();
            $commandMessage = $commandMessageProvider->command($command);
            $this->handler->dispatch($commandMessage);
        }


        $output->writeln('Syncing finished!');
    }
}
