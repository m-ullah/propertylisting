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

use SH\Application\Model\Entity\Merchant;
use SH\Application\Model\Entity\Transaction;
use SH\Application\Model\Entity\PropertyRepositoryInterface;

/**
 * Class PropertyRepository
 *
 * @package SH\Framework\Infrastructure\Storage\Repository
 */
class PropertyRepository extends Repository implements PropertyRepositoryInterface
{
    /**
     * @param  $params
     * @return mixed
     */
    public function save($params)
    {
        return $this->adapter->save($params);
    }

    /**
     * @param $params
     */
    public function read($params)
    {
        // @ToDo
    }

    /**
     * @param  $params
     * @return mixed
     */
    public function readAll($params)
    {
        $data = $this->adapter->read($params);

        return $data;
    }

    /**
     * @param $params
     */
    public function remove($params)
    {
        // @ToDo
    }
}
