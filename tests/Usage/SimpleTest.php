<?php

namespace FineDiffTests\Usage;

use Diff\Diff;
use Diff\Render\Text;
use Diff\Render\Html;
use Diff\Granularity\Character;
use Diff\Granularity\Word;
use Diff\Granularity\Sentence;
use Diff\Granularity\Paragraph;

class SimpleTest extends Base
{
    public function testInsertCharacterGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('character/simple');

        $diff = new Diff(new Character);
        $generated_opcodes = $diff->getOpcodes($from, $to);


        // Generate opcodes
        $this->assertEquals($generated_opcodes, $opcodes);

        // Render to text from opcodes
        $render = new Text;
        $this->assertEquals( $render->process($from, $generated_opcodes), $to );

        // Render to html from opcodes
        $render = new Html;
        $this->assertEquals( $render->process($from, $generated_opcodes), $html );

        // Render
        $this->assertEquals( $diff->render($from, $to), $html );
    }

    public function testInsertWordGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('word/simple');

        $diff = new Diff(new Word);
        $generated_opcodes = $diff->getOpcodes($from, $to);


        // Generate opcodes
        $this->assertEquals($generated_opcodes, $opcodes);

        // Render to text from opcodes
        $render = new Text;
        $this->assertEquals( $render->process($from, $generated_opcodes), $to );

        // Render to html from opcodes
        $render = new Html;
        $this->assertEquals( $render->process($from, $generated_opcodes), $html );

        // Render
        $this->assertEquals( $diff->render($from, $to), $html );
    }

    public function testInsertSentenceGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('sentence/simple');

        $diff = new Diff(new Sentence);
        $generated_opcodes = $diff->getOpcodes($from, $to);


        // Generate opcodes
        $this->assertEquals($generated_opcodes, $opcodes);

        // Render to text from opcodes
        $render = new Text;
        $this->assertEquals( $render->process($from, $generated_opcodes), $to );

        // Render to html from opcodes
        $render = new Html;
        $this->assertEquals( $render->process($from, $generated_opcodes), $html );

        // Render
        $this->assertEquals( $diff->render($from, $to), $html );
    }

    public function testInsertParagraphGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('paragraph/simple');

        $diff = new Diff(new Paragraph);
        $generated_opcodes = $diff->getOpcodes($from, $to);


        // Generate opcodes
        $this->assertEquals($generated_opcodes, $opcodes);

        // Render to text from opcodes
        $render = new Text;
        $this->assertEquals( $render->process($from, $generated_opcodes), $to );

        // Render to html from opcodes
        $render = new Html;
        $this->assertEquals( $render->process($from, $generated_opcodes), $html );

        // Render
        $this->assertEquals( $diff->render($from, $to), $html );
    }
}