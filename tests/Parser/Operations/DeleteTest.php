<?php

namespace FineDiffTests\Parser\Operations;

use PHPUnit_Framework_TestCase;
use Diff\Parser\Operations\Delete;

class DeleteTest extends PHPUnit_Framework_TestCase
{
    public function testImplementsOperationInterface()
    {
        $replace = new Delete(10);
        $this->assertTrue(is_a($replace, 'Diff\Parser\Operations\OperationInterface'));
    }

    public function testGetFromLen()
    {
        $delete = new Delete(10);
        $this->assertEquals($delete->getFromLen(), 10);
    }

    public function testGetToLen()
    {
        $delete = new Delete(342);
        $this->assertEquals($delete->getToLen(), 0);
    }

    public function testGetOpcode()
    {
        $delete = new Delete(1);
        $this->assertEquals($delete->getOpcode(), 'd');

        $delete = new Delete(24);
        $this->assertEquals($delete->getOpcode(), 'd24');
    }
}
