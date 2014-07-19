<?php

/**
 * FINE granularity DIFF
 *
 * Computes a set of instructions to convert the content of
 * one string into another.
 *
 * Originally created by Raymond Hill (https://github.com/gorhill/PHP-FineDiff), brought up
 * to date by Cog Powered (https://github.com/cogpowered/FineDiff).
 *
 * @copyright Copyright 2011 (c) Raymond Hill (http://raymondhill.net/blog/?p=441)
 * @copyright Copyright 2013 (c) Robert Crowe (http://cogpowered.com)
 * @link https://github.com/cogpowered/FineDiff
 * @version 0.0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace Diff;

use Diff\Granularity\GranularityInterface;
use Diff\Render\RendererInterface;
use Diff\Parser\ParserInterface;
use Diff\Granularity\Character;
use Diff\Render\Html;
use Diff\Parser\Parser;

/**
 * Diff class.
 */
class Diff
{
    /**
     * @var Diff\Granularity\GranularityInterface
     */
    protected $granularity;

    /**
     * @var Diff\Render\RendererInterface
     */
    protected $renderer;

    /**
     * @var Diff\Parser\ParserInterface
     */
    protected $parser;

    /**
     * Instantiate a new instance of Diff.
     *
     * @param Diff\Granularity\GranularityInterface $granularity Level of diff.
     * @param Diff\Render\RenderInterface           $renderer    Diff renderer.
     * @param Diff\Parser\ParserInterface           $parser      Parser used to generate opcodes.
     *
     * @throws Diff\Exceptions\GranularityCountException
     * @throws Diff\Exceptions\OperationException
     */
    public function __construct(GranularityInterface $granularity = null, RendererInterface $renderer = null, ParserInterface $parser = null)
    {
        // Set some sensible defaults

        // Set the granularity of the diff
        $this->granularity = ($granularity !== null) ? $granularity : new Character;

        // Set the renderer to use when calling Diff::render
        $this->renderer = ($renderer !== null) ? $renderer : new Html;

        // Set the diff parser
        $this->parser = ($parser !== null) ? $parser : new Parser($this->granularity);
    }

    /**
     * Returns the granularity object used by the parser.
     *
     * @return @Diff\Granularity\GranularityInterface
     */
    public function getGranularity()
    {
        return $this->parser->getGranularity();
    }

    /**
     * Set the granularity level of the parser.
     *
     * @param Diff\Granularity\GranularityInterface $granularity
     * @return void
     */
    public function setGranularity(GranularityInterface $granularity)
    {
        $this->parser->setGranularity($granularity);
    }

    /**
     * Get the render.
     *
     * @return Diff\Render\RendererInterface
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Set the renderer.
     *
     * @param Diff\Render\RendererInterface $renderer
     * @return void
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Get the parser responsible for generating the diff/opcodes.
     *
     * @return Diff\Parser\ParserInterface
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * Set the parser.
     *
     * @param Diff\Parser\ParserInterface $parser
     * @return void
     */
    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Gets the diff / opcodes between two strings.
     *
     * Returns the opcode diff which can be used for example, to
     * to generate a HTML report of the differences.
     *
     * @return Diff\Parser\Opcodes
     */
    public function getOpcodes($from_text, $to_text)
    {
        return $this->parser->parse($from_text, $to_text);
    }

    /**
     * Render the difference between two strings.
     *
     * By default will return the difference as HTML.
     *
     * @param string $from_text
     * @param string $to_text
     * @return string
     */
    public function render($from_text, $to_text)
    {
        // First we need the opcodes
        $opcodes = $this->getOpcodes($from_text, $to_text);

        return $this->renderer->process($from_text, $opcodes);
    }
}
