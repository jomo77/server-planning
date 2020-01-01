<?php

namespace Jomo77\ServerPlanning;

/**
 *  A Single VM
 *
 * @author Jomo77
 */
class VM
{

    /**  @var ServerResource $resource defines the needed Resource for this VM */
    private ServerResource $resource;

    /*
     * Constructor
     *
     * Init the VM´s resource
     *
     * @param ServerResource $resource - size of the resource of this VM
     *
     */
    public function __construct(ServerResource $resource)
    {
        $this->resource = $resource;
    }

    /*
     * getResource
     *
     * Returns the VM´s needed resource
     *
     */
    public function getResource() : ServerResource
    {
        return $this->resource;
    }


    public function __toString()
    {
        return "VM -> " . $this->resource;
    }
}