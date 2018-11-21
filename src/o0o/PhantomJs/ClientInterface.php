<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace o0o\PhantomJs;

use o0o\PhantomJs\Http\RequestInterface;
use o0o\PhantomJs\Http\ResponseInterface;

/**
 * PHP PhantomJs
 *
 * 
 */
interface ClientInterface
{
    /**
     * Get singleton instance
     *
     * @access public
     * @return \o0o\PhantomJs\ClientInterface
     */
    public static function getInstance();

    /**
     * Get engine instance.
     *
     * @access public
     * @return \o0o\PhantomJs\Engine
     */
    public function getEngine();

    /**
     * Get message factory instance
     *
     * @access public
     * @return \o0o\PhantomJs\Http\MessageFactoryInterface
     */
    public function getMessageFactory();

    /**
     * Get procedure loader instance
     *
     * @access public
     * @return \o0o\PhantomJs\Procedure\ProcedureLoaderInterface
     */
    public function getProcedureLoader();

    /**
     * Send request
     *
     * @access public
     * @param \o0o\PhantomJs\Http\RequestInterface  $request
     * @param \o0o\PhantomJs\Http\ResponseInterface $response
     */
    public function send(RequestInterface $request, ResponseInterface $response);

    /**
     * Get log.
     *
     * @access public
     * @return string
     */
    public function getLog();

    /**
     * Set procedure template.
     *
     * @access public
     * @param  string $procedure
     * @return void
     */
    public function setProcedure($procedure);

    /**
     * Get procedure template.
     *
     * @access public
     * @return string
     */
    public function getProcedure();

    /**
     * Set lazy request flag.
     *
     * @access public
     * @return void
     */
    public function isLazy();
}
