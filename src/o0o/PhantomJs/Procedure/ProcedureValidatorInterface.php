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
interface ProcedureValidatorInterface
{
    /**
     * Validate procedure.
     *
     * @access public
     * @param  string                                                   $procedure
     * @return boolean
     * @throws \o0o\PhantomJs\Exception\ProcedureValidationException
     */
    public function validate($procedure);
}
