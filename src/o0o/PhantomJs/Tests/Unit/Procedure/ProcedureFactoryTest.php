<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace o0o\PhantomJs\Tests\Unit\Procedure;

use Twig_Environment;
use Twig_Loader_String;
use o0o\PhantomJs\Engine;
use o0o\PhantomJs\Cache\FileCache;
use o0o\PhantomJs\Cache\CacheInterface;
use o0o\PhantomJs\Parser\JsonParser;
use o0o\PhantomJs\Parser\ParserInterface;
use o0o\PhantomJs\Template\TemplateRenderer;
use o0o\PhantomJs\Template\TemplateRendererInterface;
use o0o\PhantomJs\Procedure\ProcedureFactory;

/**
 * PHP PhantomJs
 *
 * 
 */
class ProcedureFactoryTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test factory can create instance of
     * procedure.
     *
     * @access public
     * @return void
     */
    public function testFactoryCanCreateInstanceOfProcedure()
    {
        $engine    = $this->getEngine();
        $parser    = $this->getParser();
        $cache     = $this->getCache();
        $renderer  = $this->getRenderer();

        $procedureFactory = $this->getProcedureFactory($engine, $parser, $cache, $renderer);

        $this->assertInstanceOf('\o0o\PhantomJs\Procedure\Procedure', $procedureFactory->createProcedure());
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get procedure factory instance.
     *
     * @access protected
     * @param  \o0o\PhantomJs\Engine                             $engine
     * @param  \o0o\PhantomJs\Parser\ParserInterface             $parser
     * @param  \o0o\PhantomJs\Cache\CacheInterface               $cacheHandler
     * @param  \o0o\PhantomJs\Template\TemplateRendererInterface $renderer
     * @return \o0o\PhantomJs\Procedure\ProcedureFactory
     */
    protected function getProcedureFactory(Engine $engine, ParserInterface $parser, CacheInterface $cacheHandler, TemplateRendererInterface $renderer)
    {
        $procedureFactory = new ProcedureFactory($engine, $parser, $cacheHandler, $renderer);

        return $procedureFactory;
    }

    /**
     * Get engine.
     *
     * @access protected
     * @return \o0o\PhantomJs\Engine
     */
    protected function getEngine()
    {
        $engine = new Engine();

        return $engine;
    }

    /**
     * Get parser.
     *
     * @access protected
     * @return \o0o\PhantomJs\Parser\JsonParser
     */
    protected function getParser()
    {
        $parser = new JsonParser();

        return $parser;
    }

    /**
     * Get cache.
     *
     * @access protected
     * @param  string                            $cacheDir  (default: '')
     * @param  string                            $extension (default: 'proc')
     * @return \o0o\PhantomJs\Cache\FileCache
     */
    protected function getCache($cacheDir = '', $extension = 'proc')
    {
        $cache = new FileCache(($cacheDir ? $cacheDir : sys_get_temp_dir()), 'proc');

        return $cache;
    }

    /**
     * Get template renderer.
     *
     * @access protected
     * @return \o0o\PhantomJs\Template\TemplateRenderer
     */
    protected function getRenderer()
    {
        $twig = new Twig_Environment(
            new Twig_Loader_String()
        );

        $renderer = new TemplateRenderer($twig);

        return $renderer;
    }
}
