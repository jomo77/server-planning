<?php

use Jomo77\ServerPlanning\ServerResource;
use Jomo77\ServerPlanning\VM;
use PHPUnit\Framework\TestCase;

final class VMTest extends TestCase
{
    /**
     * @test if the Class has no syntax error
     */
    public function isThereAnySyntaxError()
    {
        $serverResource = new ServerResource(1,2,3);
        $var = new VM($serverResource);
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     * @test
     */
    public function ifResourceSet()
    {
        $serverResource = new ServerResource(5,2,3);
        $var = new VM($serverResource);
        $this->assertTrue($var == 'VM -> CPU 5 | RAM 2 | HDD 3');
        unset($var);
    }

}
