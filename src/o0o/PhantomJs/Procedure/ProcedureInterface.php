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
interface ProcedureInterface
{
    /**
     * Run procedure.
     *
     * @access public
     * @param \o0o\PhantomJs\Procedure\InputInterface  $input
     * @param \o0o\PhantomJs\Procedure\OutputInterface $output
     */
    public function run(InputInterface $input, OutputInterface $output);

    /**
     * Set procedure template.
     *
     * @access public
     * @param string $template
     */
    public function setTemplate($template);

    /**
     * Get procedure template.
     *
     * @access public
     * @return string
     */
    public function getTemplate();

    /**
     * Compile procedure.
     *
     * @access public
     * @param  \o0o\PhantomJs\Procedure\InputInterface $input
     * @return string
     */
    public function compile(InputInterface $input);
}
