<?php

use Jomo77\ServerPlanning\Exception\EmptyVMCollection;
use Jomo77\ServerPlanning\Server;
use Jomo77\ServerPlanning\ServerPlanning;
use Jomo77\ServerPlanning\ServerResource;
use Jomo77\ServerPlanning\VM;
use PHPUnit\Framework\TestCase;

/**
 *  Corresponding Class to test ServerPlanning class
 *
 * @author Jomo77
 */
final class ServerPlanningTest extends TestCase
{


    /**
     * @test if the Class has no syntax error
     */
    public function isThereAnySyntaxError()
    {
        $var = new ServerPlanning();
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     * @test the given example
     */
    public function calculateGivenValues()
    {
        $serverPlanning = new ServerPlanning();

        $server = new Server(new ServerResource(2, 32, 100));

        $vms = [
            new VM(new ServerResource(1, 16, 10)),
            new VM(new ServerResource(1, 16, 10)),
            new VM(new ServerResource(2, 32, 100))
        ];

        $this->assertTrue($serverPlanning->calculate($server, $vms) == 2);
        unset($server);
        unset($vms);
    }

    /**
     * @test if a VM which is too big for the server is skipped
     */
    public function skipTooBigVMs()
    {
        $serverPlanning = new ServerPlanning();

        $server = new Server(new ServerResource(2, 32, 100));

        $vms = [
            new VM(new ServerResource(1, 16, 10)),
            new VM(new ServerResource(1, 16, 10)),

            new VM(new ServerResource(1, 16, 200)), # Too Big - just Skip - do nothing

            new VM(new ServerResource(2, 32, 100))
        ];

        $this->assertTrue($serverPlanning->calculate($server, $vms) == 2);
        unset($server);
        unset($vms);
    }

    /**
     * @test if VMs with zero resource skipped
     */
    public function skipZeroHDD()
    {
        $serverPlanning = new ServerPlanning();

        $server = new Server(new ServerResource(2, 32, 100));

        $vms = [
            new VM(new ServerResource(1, 16, 10)),
            new VM(new ServerResource(1, 16, 10)),

            new VM(new ServerResource(1, 16, 0)), # Zero

            new VM(new ServerResource(2, 32, 100)),

            new VM(new ServerResource(2, 32, 100)),

            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero
            new VM(new ServerResource(0, 0, 0)), # Zero

            new VM(new ServerResource(0, 10, 0)), # Zero
            new VM(new ServerResource(0, 10, 0)), # Zero
            new VM(new ServerResource(0, 12, 0)) # Zero
        ];

        $this->assertTrue($serverPlanning->calculate($server, $vms) == 5);
        unset($server);
        unset($vms);
    }

    /**
     * @test if VM Collection is Empty
     */
    public function EmptyVMCollection()
    {
        $serverPlanning = new ServerPlanning();

        $server = new Server(new ServerResource(2, 32, 100));

        $vms = [];
        $this->expectException(EmptyVMCollection::class);
        $serverPlanning->calculate($server, $vms);

    }



    /**
     * @test
     */
    public function onlyOneVM()
    {
        $serverPlanning = new ServerPlanning();

        $server = new Server(new ServerResource(2, 32, 100));


        $this->assertTrue($serverPlanning->calculate($server, [new VM(new ServerResource(1, 16, 10))]) == 1);
        unset($server);
    }




    /**
     * @test
     */
    public function highResources()
    {
        $serverPlanning = new ServerPlanning();

        $cpu = 5000000;
        $ram = 12312154548;
        $hdd = 545454544543322;



        $server = new Server(new ServerResource($cpu, $ram, $hdd));

        $vms = [
            new VM(new ServerResource(1, 16, 10)),
            new VM(new ServerResource(1, 16, 10)),

            new VM(new ServerResource($cpu/2, $ram/2, $hdd/2)),

            new VM(new ServerResource($cpu/2, $ram/2, $hdd/2))
        ];

        $this->assertTrue($serverPlanning->calculate($server, $vms) == 2);
        unset($server);
        unset($vms);
    }
}
