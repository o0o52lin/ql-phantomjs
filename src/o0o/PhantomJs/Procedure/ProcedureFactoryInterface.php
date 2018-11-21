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
interface ProcedureFactoryInterface
{
    /**
     * Create new procedure instance.
     *
     * @access public
     * @return \o0o\PhantomJs\Procedure\ProcedureInterface
     */
    public function createProcedure();
}
