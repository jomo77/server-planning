<?php

namespace Jomo77\ServerPlanning\Factories;

use Jomo77\ServerPlanning\ServerResource;
use Jomo77\ServerPlanning\VM;
/**
 *  VMFactory
 *
 * @author Jomo77
 */
class VMFactory
{
    /*
     * Create
     *
     * Returns a VM Object
     *
     * @param Int $cpu Number of CPUs
     * @param Int $ram Size of RAM
     * @param Int $hdd Size of HDD
     *
     * @return VM
     */
    public static function create(Int $cpu = 0, Int $ram = 0, Int $hdd = 0) : VM
    {
        return new VM(new ServerResource($cpu, $ram, $hdd));
    }
}