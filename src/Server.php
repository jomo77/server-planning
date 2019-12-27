<?php

namespace Jomo77\ServerPlanning;

/**
 *  A Single Server for hosting multiple VMs
 *
 * @author Jomo77
 */
class Server
{
    /**  @var ServerResource $resource defines the Server Resources */
    private ServerResource $resource;

    /**  @var ServerResource $resource defines the available Server Resources */
    private ServerResource $availableResource;

    /** @var array $vms a simple VM Collection - just nice - useless now */
    private array $vms = [];

    /*
     * Constructor
     *
     * Init server resources an available resources
     *
     * @param ServerResource $givenResource - size of the resources
     *
     */
    public function __construct(ServerResource $givenResource)
    {
        $this->resource = $givenResource;
        $this->availableResource = clone $givenResource;
    }


    function __clone()
    {
        $this->resource = clone $this->resource;
        $this->availableResource = clone $this->availableResource;
        $this->vms = [];
    }


    /*
     * addVM
     *
     * Adds a single VM to the server
     *
     * @param VM $vm represents a single Virtual Machine
     *
     * @return boolean
     */
    public function addVM(VM $vm)
    {
        #If a virtual machine is too 'big' for a server, it should be skipped.
        if (!$this->resource->fits($vm->getResource())) {
            return true;
        }

        # If enough Resource Add VM
        if ($this->availableResource->fits($vm->getResource())) {
            $this->availableResource->subtractResource($vm->getResource());
            $this->vms[] = $vm;
            return true;
        }

        # not enough resources
        return false;
    }


    public function __toString()
    {
        return "Server -> " . $this->resource . " / Available -> " . $this->availableResource;
    }
}