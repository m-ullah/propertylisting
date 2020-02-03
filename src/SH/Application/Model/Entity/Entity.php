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

namespace SH\Application\Model\Entity;

/**
 * Class Entity
 * Layer Supertype (Patterns of Enterprise App Architecture p475)
 *
 * @package SH\Model\Model\Entity
 */
abstract class Entity implements EntityInterface
{
    protected $id;

    /**
     * Map protected/private to mutators, otherwise to property
     *
     * @param  $property
     * @param  $value
     * @return $this
     */
    public function __set($property, $value)
    {
        $ucProperty = ucfirst(strtolower($property));
        if (empty($value)) {
            throw new \InvalidArgumentException($ucProperty . ' must not be null');
        }
        $this->checkProperty($property);
        $mutator = 'set' . $ucProperty;
        method_exists($this, $mutator) && is_callable(array($this, $mutator))
            ? $this->$mutator($value)
            : $this->$property = $value;
        return $this;
    }

    /**
     * Map protected/private to accessors, otherwise to property
     *
     * @param  $property
     * @return mixed
     */
    public function __get($property)
    {
        $this->checkProperty($property);
        $accessor = 'get' . ucfirst(strtolower($property));
        return method_exists($this, $accessor) && is_callable(array($this, $accessor))
            ? $this->$accessor()
            : $this->$property;
    }

    /**
     * Map undefined mutators/accessors
     *
     * @param  $method
     * @param  $arguments
     * @return $this|mixed
     */
    public function __call($method, $arguments)
    {
        if (strlen($method) < 3) {
            throw new \BadMethodCallException($method . ' is not valid');
        }
        $property = lcfirst(substr($method, 3));
        $ucProperty = ucfirst(strtolower($property));
        $this->checkProperty($property);
        if (strpos($method, 'set') === 0) {
            $value = array_shift($arguments);
            if (empty($value)) {
                throw new \InvalidArgumentException($ucProperty . ' must not be null');
            }
            $this->$property = $value;
            return $this;
        }
        if (strpos($method, 'get') === 0) {
            return $this->$property;
        }
    }

    public function __toString()
    {
        return (string)$this->id;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    protected function checkProperty($property)
    {
        if (!property_exists($this, $property)) {
            throw new \InvalidArgumentException($property . ' is not valid');
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function equals($other): bool
    {
        if (!$other instanceof self) {
            return false;
        }
        return (string)$this->getId() === (string)$other->getId();
    }
}
