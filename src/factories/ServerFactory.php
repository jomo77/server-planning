<?php

namespace Jomo77\ServerPlanning\Factories;


use Jomo77\ServerPlanning\Server;
use Jomo77\ServerPlanning\ServerResource;
/**
 *  ServerFactory
 *
 * @author Jomo77
 */
class ServerFactory
{
    /*
     * Create
     *
     * Returns a Server Object
     *
     * @param Int $cpu Number of CPUs
     * @param Int $ram Size of RAM
     * @param Int $hdd Size of HDD
     *
     * @return Server
     */
    public static function create(Int $cpu = 0, Int $ram = 0, Int $hdd = 0) : Server
    {
        return new Server(new ServerResource($cpu, $ram, $hdd));
    }
}