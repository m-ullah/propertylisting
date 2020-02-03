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

/**
 * Interface CommandMessageInterface
 *
 * @package SH\Application\Command\CommandBus
 */
interface CommandMessageInterface
{
    /**
     * The name of the command payload of this command message
     *
     * @return string
     */
    public function getCommandName();

    /**
     * Returns the identifier of this message. Two messages with the same identifiers should be interpreted as
     * different representations of the same conceptual message. In such case, the meta-data may be different for both
     * representations
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Returns the meta data for this event. This meta data is a collection of key-value pairs, where the key is a
     * String, and the value is a serializable object.
     *
     * @return MetaDataInterface The meta data for this event
     */
    public function getMetaData();

    /**
     * Gets the command message payload, the command itself.
     *
     * @return CommandInterface
     */
    public function getPayload();

    /**
     * @return \DateTimeImmutable
     */
    public function getRecordedOn();

    /**
     * Returns a copy of this Message with the given metaData. The payload remains unchanged.
     *
     * While the implementation returned may be different than the implementation of this, implementations
     * must take special care in returning the same type of Message (e.g. EventMessage, DomainEventMessage) to prevent
     * errors further downstream.
     *
     * @param MetaDataInterface $metadata The new MetaData for the Message
     *
     * @return $this A copy of this message with the given MetaData
     */
    public function withMetaData(MetaDataInterface $metadata);

    /**
     * Returns a copy of this Message with it MetaData merged with the given metaData. The payload
     * remains unchanged.
     *
     * @param MetaDataInterface $metadata The MetaData to merge with
     *
     * @return $this A copy of this message with the given MetaData
     */
    public function andMetaData(MetaDataInterface $metadata);

    /**
     * @param  $command
     * @return mixed
     */
    public static function asCommandMessage($command);
}
