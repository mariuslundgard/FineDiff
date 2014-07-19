<?php

namespace FineDiffTests\Diff;

use PHPUnit_Framework_TestCase;
use Diff\Diff;

class DefaultsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->diff = new Diff;
    }

    public function testGetGranularity()
    {
        $this->assertTrue(is_a($this->diff->getGranularity(), 'Diff\Granularity\Character'));
        $this->assertTrue(is_a($this->diff->getGranularity(), 'Diff\Granularity\Granularity'));
        $this->assertTrue(is_a($this->diff->getGranularity(), 'Diff\Granularity\GranularityInterface'));
    }

    public function testGetRenderer()
    {
        $this->assertTrue(is_a($this->diff->getRenderer(), 'Diff\Render\Html'));
        $this->assertTrue(is_a($this->diff->getRenderer(), 'Diff\Render\Renderer'));
        $this->assertTrue(is_a($this->diff->getRenderer(), 'Diff\Render\RendererInterface'));
    }

    public function testGetParser()
    {
        $this->assertTrue(is_a($this->diff->getParser(), 'Diff\Parser\Parser'));
        $this->assertTrue(is_a($this->diff->getParser(), 'Diff\Parser\ParserInterface'));
    }
}