<?php

namespace Jomo77\ServerPlanning;

/**
 *  ServerResource Class
 *
 *  Defines the Server Resources
 *
 * @author Jomo77
 */
class ServerResource
{

    /**  @var integer $cpu define number of CPU */
    private Int $cpu = 0;

    /**  @var integer $ram define number of RAM */
    private Int $ram = 0;

    /**  @var integer $hdd define number of HDD Storage */
    private Int $hdd = 0;

    /*
     * Constructor
     *
     * Init Resource Values
     *
     * @param Int $cpu Number of CPUs
     * @param Int $ram Size of RAM
     * @param Int $hdd Size of HDD
     *
     */
    public function __construct(Int $cpu = 0, Int $ram = 0, Int $hdd = 0)
    {
        $this->cpu = (is_numeric($cpu) && $cpu > 0) ? $cpu : 0;
        $this->ram = (is_numeric($ram) && $ram > 0) ? $ram : 0;
        $this->hdd = (is_numeric($hdd) && $hdd > 0) ? $hdd : 0;
    }


    /*
     * subtractResource
     *
     * Just subtract Resource - no Error Handling
     *
     * @param ServerResource $resource - size of the resources to subtract
     *
     * @return boolean
     */
    public function subtractResource(ServerResource $resource)
    {
        $this->cpu -= $resource->cpu;
        $this->ram -= $resource->ram;
        $this->hdd -= $resource->hdd;
        return true;
    }


    /*
     * fits
     *
     * Is this Resource bigger or equal than the given one?
     *
     * @param ServerResource $resource - size of the resources to compare
     *
     * @return boolean
     */
    public function fits(ServerResource $resource)
    {
        return ($this->cpu >= $resource->cpu && $this->ram >= $resource->ram && $this->hdd >= $resource->hdd);
    }


    public function __toString()
    {
        return "CPU " . $this->cpu . " | RAM " . $this->ram . " | HDD " . $this->hdd;
    }
}