<?php

use Jomo77\ServerPlanning\ServerResource;
use PHPUnit\Framework\TestCase;

final class ServerResourceest extends TestCase
{

    /**
     * @test if the Class has no syntax error
     */
    public function testIsThereAnySyntaxError()
    {
        $var = new ServerResource(1, 2, 3);
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     * @test the given example
     */
    public function ValuesAreSaved()
    {
        $var = new ServerResource(1, 2, 3);
        $this->assertTrue($var == 'CPU 1 | RAM 2 | HDD 3');
        unset($var);
    }

    /**
     * @test - Negativce Resource Values are not allowed - set to Zero
     */
    public function ifNegativeValueIsSetToZero()
    {
        $var = new ServerResource(-1, -5, -3);
        $this->assertTrue($var == 'CPU 0 | RAM 0 | HDD 0');
        unset($var);
    }

    /**
     * @test
     */
    public function MixedValue()
    {
        $var = new ServerResource(5, 3, -3);
        $this->assertTrue($var == 'CPU 5 | RAM 3 | HDD 0');
        unset($var);
    }

    /**
     * @test
     */
    public function onlyZeroValue()
    {
        $var = new ServerResource(0, 0, 0);
        $this->assertTrue($var == 'CPU 0 | RAM 0 | HDD 0');
        unset($var);
    }

    /**
     * @test
     */
    public function emptyConstructorValue()
    {
        $var = new ServerResource();
        $this->assertTrue($var == 'CPU 0 | RAM 0 | HDD 0');
        unset($var);
    }
}
