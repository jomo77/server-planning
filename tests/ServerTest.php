<?php

use Jomo77\ServerPlanning\Server;
use Jomo77\ServerPlanning\ServerResource;
use Jomo77\ServerPlanning\VM;
use PHPUnit\Framework\TestCase;

final class ServerTest extends TestCase
{
    /**
     * @test if the Class has no syntax error
     */
    public function testIsThereAnySyntaxError()
    {
        $serverResource = new ServerResource(1,2,3);
        $var = new Server($serverResource);
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     * @test
     */
    public function ifResourceSet()
    {
        $serverResource = new ServerResource(5,2,3);
        $var = new Server($serverResource);
        $this->assertTrue($var == 'Server -> CPU 5 | RAM 2 | HDD 3 / Available -> CPU 5 | RAM 2 | HDD 3');
        unset($var);
    }


    /**
     * @test - subtracting the same VM multiple times
     */
    public function subtractResource()
    {
        $server = new Server(new ServerResource(10,10,10));
        $this->assertTrue($server == 'Server -> CPU 10 | RAM 10 | HDD 10 / Available -> CPU 10 | RAM 10 | HDD 10');

        $vm = new VM(new ServerResource(4,3,2));

        // add VM first time
        $this->assertTrue($server->addVM($vm));
        $this->assertTrue($server == 'Server -> CPU 10 | RAM 10 | HDD 10 / Available -> CPU 6 | RAM 7 | HDD 8');

        // add VM second time
        $this->assertTrue($server->addVM($vm));
        $this->assertTrue($server == 'Server -> CPU 10 | RAM 10 | HDD 10 / Available -> CPU 2 | RAM 4 | HDD 6');

        // add VM third time - should return false
        $this->assertFalse($server->addVM($vm));
        $this->assertTrue($server == 'Server -> CPU 10 | RAM 10 | HDD 10 / Available -> CPU 2 | RAM 4 | HDD 6');

        // VM should bee untouched
        $this->assertTrue($vm == 'VM -> CPU 4 | RAM 3 | HDD 2');
        unset($vm);
        unset($server);
    }


}
