<?php

use Jomo77\ServerPlanning\Factories\VMFactory;
use PHPUnit\Framework\TestCase;

final class VMTest extends TestCase
{
    /**
     * @test if the Class has no syntax error
     */
    public function isThereAnySyntaxError()
    {
        $var = VMFactory::create(1,2,3);
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     * @test
     */
    public function ifResourceSet()
    {
        $var = VMFactory::create(5,2,3);
        $this->assertTrue($var == 'VM -> CPU 5 | RAM 2 | HDD 3');
        unset($var);
    }

}
