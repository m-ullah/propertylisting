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

namespace SH\Framework\Infrastructure\Storage\Repository;

use SH\Framework\Infrastructure\Storage\StorageAdapterInterface;

/**
 * Repository
 */
abstract class Repository
{
    protected $adapter;

    /**
     * Repository constructor.
     *
     * @param StorageAdapterInterface $adapter
     */
    public function __construct(
        StorageAdapterInterface $adapter
    ) {
        $this->adapter = $adapter;
    }

}
