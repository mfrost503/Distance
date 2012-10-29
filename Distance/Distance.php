<?php
namespace Frost\Distance;

/**
 * @package Frost\Distance
 * @author Matt Frost
 * Class to convert a provided distance into another unit of measurement
 */
class Distance
{

    /**
     * @var string
     * Unit of measurement
     */
    private $unit='mi';
    /**
     * @var float
     * Distance
     */
    private $distance=0.00;
    /**
     * @var array
     * Array containing conversions, based off mile measurement
     */
    private $conversions;

    /**
     * Sets the conversion array based off the mile as the base measurement
     */
    public function __construct()
    {
        $this->conversions = array(
               'km' => 1.60934,
               'm' => 1609.34,
               'cm' => 160934,
               'mm' => 1609340,
               'yd' => 1760,
               'ft' => 5280,
               'in' => 63360,
               'mi' => 1
        );
    }

    /**
     * @param $unit
     * @return Distance
     * set the unit type
     * @throws UndefinedUnitException
     */

    public function setUnit($unit)
    {
        $unit = strtolower($unit);

        if(!isset($this->conversions[$unit])){
            throw new UndefinedUnitException("The unit you've provided ($unit) is not valid");
        }else{
            $this->unit = $unit;
        }

        return $this;
    }

    /**
     * @param $distance
     * @return Distance
     * set the value of the distance
     */

    public function setDistance($distance)
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @param $unit
     * @return float
     * Returns the value of the requested distance unit
     * @throws UndefinedUnitException
     */

    public function convertTo($unit)
    {
        if(!isset($this->conversions[strtolower($unit)])) {
            throw new UndefinedUnitException("The unit you're trying to convert to ($unit) is not valid");
        }
        return $this->distance * ($this->conversions[strtolower($unit)]/$this->conversions[$this->unit]);
    }
}

