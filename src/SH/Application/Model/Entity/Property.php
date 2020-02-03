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
 * Class Property
 *
 * @package SH\Application\Model\Entity
 */
class Property extends Entity
{
    protected $name;

    /**
     * Merchant constructor.
     *
     * @param int    $id
     * @param string $name
     */
    public function __construct(
        int $id,
        string $name
    ) {
        $this->id = $id;
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return ucfirst(
            strtolower(
                (new \ReflectionClass($this))->getShortName()
            )
        );
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

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->name;
    }
}
