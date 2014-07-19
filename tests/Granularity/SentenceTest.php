<?php

namespace FineDiffTests\Granularity;

use PHPUnit_Framework_TestCase;
use Diff\Delimiters;
use Diff\Granularity\Sentence;

class SentenceTest extends PHPUnit_Framework_TestCase
{
    protected $delimiters = array(
        Delimiters::PARAGRAPH,
        Delimiters::SENTENCE,
    );

    public function setUp()
    {
        $this->character = new Sentence;
    }

    public function testExtendsAndImplements()
    {
        $this->assertTrue(is_a($this->character, 'Diff\Granularity\Granularity'));
        $this->assertTrue(is_a($this->character, 'Diff\Granularity\GranularityInterface'));
        $this->assertTrue(is_a($this->character, 'ArrayAccess'));
        $this->assertTrue(is_a($this->character, 'Countable'));
    }

    public function testGetDelimiters()
    {
        $this->assertEquals($this->character->getDelimiters(), $this->delimiters);
    }
}