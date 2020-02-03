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

namespace SH\Application\Command\Property\Handler;

use SH\Application\Command\CommandBus\CommandMessageInterface;
use SH\Application\Model\Entity\PropertyRepositoryInterface;
use SH\Framework\Infrastructure\Service\PropertyFeedService;

/**
 * Class SyncPropertyListHandler
 *
 * @package SH\Application\Command\Property\Handler
 */
class SyncPropertyListHandler extends SyncHandler
{
    /**
     * SyncPropertyListHandler constructor.
     *
     * @param PropertyRepositoryInterface $repository
     */
    public function __construct(
        PropertyRepositoryInterface $repository
    ) {
        parent::__construct($repository);
    }

    /**
     * @param  CommandMessageInterface $command
     * @throws \Exception
     */
    public function handle(CommandMessageInterface $command)
    {
        $payload = $command->getPayload($command->getPayload());
        try {
            $this->repository->save($payload);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
