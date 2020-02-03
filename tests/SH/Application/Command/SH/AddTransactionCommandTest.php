<?php

use SH\Application\Command\Property\SyncPropertyListCommand;
use PHPUnit\Framework\TestCase;

final class AddTransactionCommandTest extends TestCase
{
    private $cmd;

    public function setUp()
    {
        $this->cmd = new SyncPropertyListCommand(
            1,
            'data'
        );
    }

    public function testCanBeAdded(): void
    {
        $this->assertInstanceOf(
            SyncPropertyListCommand::class,
            $this->cmd
        );
    }

}
