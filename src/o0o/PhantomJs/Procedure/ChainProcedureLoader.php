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
class ChainProcedureLoader implements ProcedureLoaderInterface
{
    /**
     * Procedure loader storage.
     *
     * @var array
     * @access protected
     */
    protected $procedureLoaders;

    /**
     * Internal constructor.
     *
     * @access public
     * @param array $procedureLoaders
     */
    public function __construct(array $procedureLoaders)
    {
        $this->procedureLoaders = $procedureLoaders;
    }

    /**
     * Add procedure loader.
     *
     * @access public
     * @param  \o0o\PhantomJs\Procedure\ProcedureLoaderInterface $procedureLoader
     * @return void
     */
    public function addLoader(ProcedureLoaderInterface $procedureLoader)
    {
        array_unshift($this->procedureLoaders, $procedureLoader);
    }

    /**
     * Load procedure instance by id.
     *
     * @access public
     * @param  string                                         $id
     * @throws \InvalidArgumentException
     * @return \o0o\PhantomJs\Procedure\ProcedureInterface
     */
    public function load($id)
    {
        /** @var \o0o\PhantomJs\Procedure\ProcedureLoaderInterface $loader **/
        foreach ($this->procedureLoaders as $loader) {

            try {

                $procedure = $loader->load($id);

                return $procedure;

            } catch (\Exception $e) {}

        }

        throw new \InvalidArgumentException(sprintf('No valid procedure loader could be found to load the \'%s\' procedure.', $id));
    }

    /**
     * Load procedure template by id.
     *
     * @access public
     * @param  string                    $id
     * @param  string                    $extension (default: 'proc')
     * @throws \InvalidArgumentException
     * @return string
     */
    public function loadTemplate($id, $extension = 'proc')
    {
        /** @var \o0o\PhantomJs\Procedure\ProcedureLoaderInterface $loader **/
        foreach ($this->procedureLoaders as $loader) {

            try {

                $template = $loader->loadTemplate($id, $extension);

                return $template;

            } catch (\Exception $e) {}

        }

        throw new \InvalidArgumentException(sprintf('No valid procedure loader could be found to load the \'%s\' procedure template.', $id));
    }
}
