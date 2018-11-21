<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace o0o\PhantomJs\Procedure;

use o0o\PhantomJs\Validator\EngineInterface;
use o0o\PhantomJs\Exception\SyntaxException;
use o0o\PhantomJs\Exception\RequirementException;

/**
 * PHP PhantomJs
 *
 * 
 */
class ProcedureValidator implements ProcedureValidatorInterface
{
    /**
     * Procedure loader.
     *
     * @var \o0o\PhantomJs\Procedure\ProcedureLoaderInterface
     * @access protected
     */
    protected $procedureLoader;

    /**
     * Validator engine
     *
     * @var \o0o\PhantomJs\Validator\EngineInterface
     * @access protected
     */
    protected $engine;

    /**
     * Internal constructor.
     *
     * @access public
     * @param \o0o\PhantomJs\Procedure\ProcedureLoaderInterface $procedureLoader
     * @param \o0o\PhantomJs\Validator\EngineInterface          $engine
     */
    public function __construct(ProcedureLoaderInterface $procedureLoader, EngineInterface $engine)
    {
        $this->procedureLoader = $procedureLoader;
        $this->engine          = $engine;
    }

    /**
     * Validate procedure.
     *
     * @access public
     * @param  string                                                   $procedure
     * @return boolean
     * @throws \o0o\PhantomJs\Exception\ProcedureValidationException
     */
    public function validate($procedure)
    {
        $this->validateSyntax($procedure);
        $this->validateRequirements($procedure);

        return true;
    }

    /**
     * Validate syntax.
     *
     * @access protected
     * @param  string                                      $procedure
     * @return void
     * @throws \o0o\PhantomJs\Exception\SyntaxException
     */
    protected function validateSyntax($procedure)
    {
        $input  = new Input();
        $output = new Output();

        $input->set('procedure', $procedure);
        $input->set('engine', $this->engine->toString());

        $validator = $this->procedureLoader->load('validator');
        $validator->run($input, $output);

        $errors = $output->get('errors');

        if (!empty($errors)) {
            throw new SyntaxException('Your procedure failed to compile due to a javascript syntax error', (array) $errors);
        }
    }

    /**
     * validateRequirements function.
     *
     * @access protected
     * @param  string                                           $procedure
     * @return void
     * @throws \o0o\PhantomJs\Exception\RequirementException
     */
    protected function validateRequirements($procedure)
    {
        if (preg_match('/phantom\.exit\(/', $procedure, $matches) !== 1) {
            throw new RequirementException('Your procedure must contain a \'phantom.exit(1);\' command to avoid the PhantomJS process hanging');
        }
    }
}
