<?php

use Jomo77\ServerPlanning\Exception\EmptyVMCollection;
use Jomo77\ServerPlanning\Factories\ServerFactory;
use Jomo77\ServerPlanning\Factories\VMFactory;
use Jomo77\ServerPlanning\ServerPlanning;
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

        $server = ServerFactory::create(2,32,100);

        $vms = [
            VMFactory::create(1, 16, 10),
            VMFactory::create(1, 16, 10),
            VMFactory::create(2, 32, 100)
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

        $server = ServerFactory::create(2,32,100);

        $vms = [
            VMFactory::create(1, 16, 10),
            VMFactory::create(1, 16, 10),

            VMFactory::create(1, 16, 200), # Too Big - just Skip - do nothing

            VMFactory::create(2, 32, 100)
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

        $server = ServerFactory::create(2,32,100);

        $vms = [
            VMFactory::create(1, 16, 10),
            VMFactory::create(1, 16, 10),

            VMFactory::create(1, 16, 0), # Zero

            VMFactory::create(2, 32, 100),

            VMFactory::create(2, 32, 100),

            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero
            VMFactory::create(0, 0, 0), # Zero

            VMFactory::create(0, 10, 0), # Zero
            VMFactory::create(0, 10, 0), # Zero
            VMFactory::create(0, 12, 0) # Zero
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

        $server = ServerFactory::create(2,32,100);

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

        $server = ServerFactory::create(2,32,100);

        $this->assertTrue($serverPlanning->calculate($server, [VMFactory::create(1, 16, 10)]) == 1);
        unset($server);
    }

    /**
     * @test
     */
    public function VMsameAsServer()
    {
        $serverPlanning = new ServerPlanning();

        $server = ServerFactory::create(2,32,100);

        $this->assertTrue($serverPlanning->calculate($server, [VMFactory::create(2, 32, 100)]) == 1);
        unset($server);
    }

    /**
     * @test
     */
    public function VMisTooBig()
    {
        $serverPlanning = new ServerPlanning();

        $server = ServerFactory::create(2,32,100);

        $this->assertTrue($serverPlanning->calculate($server, [VMFactory::create(20, 320, 1000)]) == 0);
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

        $server = ServerFactory::create($cpu, $ram, $hdd);

        $vms = [
            VMFactory::create(1, 16, 10),
            VMFactory::create(1, 16, 10),

            VMFactory::create($cpu/2, $ram/2, $hdd/2),

            VMFactory::create($cpu/2, $ram/2, $hdd/2)
        ];

        $this->assertTrue($serverPlanning->calculate($server, $vms) == 2);
        unset($server);
        unset($vms);
    }


}
