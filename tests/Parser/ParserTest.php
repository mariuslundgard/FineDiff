<?php

namespace FineDiffTests\Parser;

use PHPUnit_Framework_TestCase;
use Mockery as m;
use Diff\Granularity\Character;
use Diff\Parser\Parser;

class ParserTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $granularity  = new Character;
        $this->parser = new Parser($granularity);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testInstanceOf()
    {
        $this->assertTrue(is_a($this->parser, 'Diff\Parser\ParserInterface'));
    }

    public function testDefaultOpcodes()
    {
        $opcodes = $this->parser->getOpcodes();
        $this->assertTrue(is_a($opcodes, 'Diff\Parser\OpcodesInterface'));
    }

    public function testSetOpcodes()
    {
        $opcodes = m::mock('Diff\Parser\Opcodes');
        $opcodes->shouldReceive('foo')->andReturn('bar');
        $this->parser->setOpcodes($opcodes);

        $opcodes = $this->parser->getOpcodes();
        $this->assertEquals($opcodes->foo(), 'bar');
    }

    /**
     * @expectedException Diff\Exceptions\GranularityCountException
     */
    public function testParseBadGranularity()
    {
        $granularity = m::mock('Diff\Granularity\Character');
        $granularity->shouldReceive('count')->andReturn(0);
        $parser = new Parser($granularity);

        $parser->parse('hello world', 'hello2 worl');
    }

    public function testParseSetOpcodes()
    {
        $opcodes = m::mock('Diff\Parser\Opcodes');
        $opcodes->shouldReceive('setOpcodes')->once();
        $this->parser->setOpcodes($opcodes);

        $this->parser->parse('Hello worlds', 'Hello2 world');
    }
}
