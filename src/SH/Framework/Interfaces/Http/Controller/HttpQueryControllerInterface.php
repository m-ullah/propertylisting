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

use SH\Application\Model\Entity\MerchantRepositoryInterface;
use SH\Application\Model\Entity\PropertyRepositoryInterface;


/**
 * Interface HttpQueryControllerInterface
 *
 * @package SH\Framework\Interfaces\Http\Controller
 */
interface HttpQueryControllerInterface
{
    /**
     * Sets the repository
     *
     * @param  PropertyRepositoryInterface $repository
     * @return $this
     */
    public function setPropertyRepository(PropertyRepositoryInterface $repository);
}
