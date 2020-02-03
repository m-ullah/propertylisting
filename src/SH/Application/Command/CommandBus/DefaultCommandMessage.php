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

use SH\Framework\Infrastructure\ServiceProvider\UuidServiceProvider;

class DefaultCommandMessage implements CommandMessageInterface
{
    /**
     * @var string $identifier
     */
    private $identifier;

    /**
     * @var MetaDataInterface $metadata
     */
    private $metadata;

    /**
     * @var CommandInterface $payload
     */
    private $payload;

    /**
     * @var \DateTimeImmutable $recordedOn
     */
    private $recordedOn;

    public function __construct(
        CommandInterface $payload,
        MetaDataInterface $metadata,
        \DateTimeImmutable $dateTime,
        UuidServiceProvider $UuidServiceProvider = null
    ) {
        $this->payload = $payload;
        $this->metadata = $metadata;
        $this->recordedOn = $dateTime;
        if ($UuidServiceProvider) {
            $this->identifier = $UuidServiceProvider->getUUIDGenerator()->uuid4();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function asCommandMessage($command)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetaData()
    {
        return $this->metadata;
    }

    /**
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * {@inheritdoc}
     */
    public function getCommandName()
    {
        return $this->payload->getCommandName(); //getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getRecordedOn()
    {
        return $this->recordedOn;
    }

    /**
     * {@inheritdoc}
     */
    public function withMetaData(MetaDataInterface $metadata)
    {
        // TODO: Implement withMetaData() method.
    }

    /**
     * {@inheritdoc}
     */
    public function andMetaData(MetaDataInterface $metadata)
    {
        // TODO: Implement andMetaData() method.
    }
}
