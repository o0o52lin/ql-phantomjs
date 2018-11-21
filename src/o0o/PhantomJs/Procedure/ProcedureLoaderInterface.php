<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace o0o\PhantomJs\Procedure;

/**
 * PHP PhantomJs
 *
 * 
 */
interface ProcedureLoaderInterface
{
    /**
     * Load procedure instance by id.
     *
     * @access public
     * @param  string                                         $id
     * @return \o0o\PhantomJs\Procedure\ProcedureInterface
     */
    public function load($id);

    /**
     * Load procedure template by id.
     *
     * @access public
     * @param  string $id
     * @param  string $extension (default: 'proc')
     * @return string
     */
    public function loadTemplate($id, $extension = 'proc');
}
