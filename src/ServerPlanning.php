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
     * Return the number of servers that is required, to host a non-empty collection of virtual machines
     */
    public function calculate(Server $server, Array $vms)
    {
        if (!empty($vms)) {
            $count = 1;
            // Don´t touch the original Server
            $testServer = clone $server;
            foreach ($vms as $vm) {

                if ($testServer->addVM($vm)) {
                    continue;
                }
                // Need one more Server for this VM
                $count++;
                // Clone the original server and try to add the VM again
                $testServer = clone $server;
                $testServer->addVM($vm);
            }
            return $count;
        } else {
            throw new EmptyVMCollection('Empty VM Collection');
        }

    }

}