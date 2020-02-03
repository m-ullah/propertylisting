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
 * Class HttpRequestController
 *
 * @package SH\Framework\Interfaces\Http\Controller
 */
abstract class HttpQueryController extends Controller implements HttpQueryControllerInterface
{
    /**
     * @var PropertyRepositoryInterface
     */
    protected $propertyRepository;

    /**
     * {@inheritdoc}
     */
    public function setPropertyRepository(PropertyRepositoryInterface $repository)
    {
        $this->propertyRepository = $repository;

        return $this;
    }
}
