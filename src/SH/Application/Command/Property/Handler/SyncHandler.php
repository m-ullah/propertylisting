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

use SH\Application\Command\CommandBus\CommandHandlerInterface;
use SH\Application\Model\Entity\PropertyRepositoryInterface;
use SH\Framework\Infrastructure\Storage\StorageAdapterInterface;

/**
 * Class SyncHandler
 *
 * @package SH\Application\Command\Property\Handler
 */
abstract class SyncHandler implements CommandHandlerInterface
{
    /**
     * @var PropertyRepositoryInterface $repository
     */
    protected $repository;

    /**
     * SyncHandler constructor.
     *
     * @param PropertyRepositoryInterface $repository
     */
    public function __construct(
        PropertyRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }
}
