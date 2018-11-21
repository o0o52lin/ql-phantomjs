<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace o0o\PhantomJs\Tests\Unit\Procedure;

use o0o\PhantomJs\Procedure\Input;

/**
 * PHP PhantomJs
 *
 * 
 */
class InputTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test data storage.
     *
     * @access public
     * @return void
     */
    public function testDataStorage()
    {
        $input = $this->getInput();
        $input->set('test', 'Test value');

        $this->assertSame('Test value', $input->get('test'));
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get input.
     *
     * @access protected
     * @return \o0o\PhantomJs\Procedure\Input
     */
    protected function getInput()
    {
        $input = new Input();

        return $input;
    }
}
