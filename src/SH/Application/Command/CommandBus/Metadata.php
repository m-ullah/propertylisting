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

namespace SH\Application\Command\CommandBus;

class Metadata implements MetaDataInterface
{
    const METADATA_IMMUTABLE = 'The Metadata is immutable';

    /**
     * @Exclude
     *
     * @var MetaData $emptyInstance
     */
    private static $emptyInstance;

    /**
     * Metadata storage
     *
     * @Type ("array")
     *
     * @var array $metadata
     */
    private $metadata = [];

    /**
     * Constructor.
     *
     * @param array $metadata
     */
    public function __construct(array $metadata = [])
    {
        $this->metadata = $metadata;
    }

    /**
     * Returns the metadata.
     *
     * @return array An array of metadata
     *
     * @api
     */
    public function all()
    {
        return $this->metadata;
    }

    /**
     * Returns the metadata keys.
     *
     * @return array An array of metadata keys
     *
     * @api
     */
    public function keys()
    {
        return array_keys($this->metadata);
    }

    /**
     * Returns a metadata.
     *
     * @param string $key The metadadta key
     *
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->metadata[$key]) ? $this->metadata[$key] : null;
    }

    /**
     * Adds metadata.
     *
     * @param array $metadata An array of metadata
     *
     * @return $this
     */
    public function mergeWith(array $metadata = [])
    {
        if (empty($metadata)) {
            return $this;
        }

        return new Metadata(array_replace($this->metadata, $metadata));
    }

    /**
     *
     * @param array $keys
     *
     * @return $this
     */
    public function withoutKeys(array $keys = [])
    {
        if (empty($keys)) {
            return $this;
        }

        $newMetadata = $this->metadata;

        foreach ($keys as $key) {
            if (isset($newMetadata[$key])) {
                unset($newMetadata[$key]);
            }
        }

        return new Metadata($newMetadata);
    }

    /**
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return count($this->metadata) == 0;
    }

    /**
     * Returns true if the key is defined.
     *
     * @param string $key The key
     *
     * @return Boolean true if the parameter exists, false otherwise
     *
     * @api
     */
    public function has($key)
    {
        return isset($this->metadata[$key]);
    }

    /**
     * Returns the number of metadata entries.
     *
     * @return integer Element count
     */
    public function count()
    {
        return count($this->metadata);
    }

    /**
     * Returns an iterator,
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->metadata);
    }

    /**
     *
     * @return Metadata
     */
    public static function emptyInstance()
    {
        if (!isset(self::$emptyInstance)) {
            self::$emptyInstance = new Metadata();
        }

        return self::$emptyInstance;
    }

    /**
     * @param mixed $other
     *
     * @return bool
     */
    public function isEqualTo($other)
    {
        if (is_array($other)) {
            return $this->metadata == $other;
        }

        if (is_object($other)) {
            return $this == $other;
        }
        return false;
    }
}
