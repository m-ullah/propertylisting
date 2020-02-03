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

namespace SH\Application\Command\Property;

use SH\Application\Command\CommandBus\CommandInterface;

/***
 * Class SyncPropertyListCommand
 *
 * @package SH\Application\Command\Property
 */
class SyncPropertyListCommand implements CommandInterface
{
    protected $propertyId;

    protected $value;

    public function __construct(
        string $propertyId,
        string $value
    ) {
        $this->setPropertyId($propertyId);
        $this->setValue($value);
    }

    /**
     * @return mixed
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCommandName()
    {
        return get_class($this);
    }

    /**
     * @param mixed $propertyId
     */
    public function setPropertyId($propertyId)
    {
        $this->propertyId = $propertyId;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return null
     */
    public function toArray()
    {
        // child objects vars need string cast
        $vars = get_object_vars($this);
        $arr = null;
        foreach ($vars as $f => $v) {
            $arr[$f] = is_object($v) ? (string)$v : $v;
        }
        return $arr;
    }
}
