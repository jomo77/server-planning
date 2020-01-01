<?php

namespace Jomo77\ServerPlanning;

use Jomo77\ServerPlanning\Exception\EmptyVMCollection;

/**
 *  A Server Planning Class
 * *
 * @author Jomo77
 */
class ServerPlanning
{

    /*
     * calculate
     *
     * Return the number of servers that is required, to host a non-empty collection of virtual machines
     *
     * @param Server $server represents a single Server
     * @param Array $vms represents a not empty collection of virtual machines
     *
     * @return int
     */
    public function calculate(Server $server, Array $vms) : int
    {
        if (!empty($vms)) {
            $testServer = clone $server;

            foreach ($vms as $vm) {
                if ($testServer->addVM($vm)) {
                    $vm_added = array_shift($vms);
                }else{
                    return 1 + $this->calculate($server, $vms);
                }
            }
            return ($testServer->countVMs() > 0) ? 1 : 0;
        } else {
            throw new EmptyVMCollection('Empty VM Collection');
        }

    }




}