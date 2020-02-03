<?php

use PHPUnit\Framework\TestCase;
use SH\Application\Model\Entity\Property;

final class PropertyTest extends TestCase
{
    private $property;

    public function setUp()
    {
        $this->property = new Property(
            1,
            'Property of Venice'
        );
    }

    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Property::class,
            $this->property
        );
    }

    public function testCanGetNameFromObjectArray(): void
    {
        $this->assertArrayHasKey('name', $this->property->toArray());
    }
}