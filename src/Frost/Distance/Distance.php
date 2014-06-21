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
     * @var $unit string
     */
    private $unit='mi';

    /**
     * @var $distance float
     */
    private $distance=0.00;

    /**
     * @var $conversions array
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
     * @param $unit string
     * @return Distance float
     * @throws UndefinedUnitException
     *
     * Configures the unit type that the user will be converting from
     */
    public function setUnit($unit)
    {
        $unit = strtolower($unit);

        if(!isset($this->conversions[$unit])){
            throw new UndefinedUnitException("The unit you've provided ($unit) is not valid");
        }

        $this->unit = $unit;
        return $this;
    }

    /**
     * @param $distance float
     * @return Distance float
     *
     * Sets the distance needed for the conversion
     */
    public function setDistance($distance)
    {
        if (!is_float($distance) && !is_int($distance)) {
            throw new \InvalidArgumentException("Distance must be a number");
        }
        $this->distance = $distance;
        return $this;
    }

    /**
     * @param $unit string
     * @return float
     * @throws UndefinedUnitException
     *
     * Returns the value of the requested distance unit
     */
    public function convertTo($unit)
    {
        if(!isset($this->conversions[strtolower($unit)])) {
            throw new UndefinedUnitException("The unit you're trying to convert to ($unit) is not valid");
        }
        return $this->distance * ($this->conversions[strtolower($unit)]/$this->conversions[$this->unit]);
    }
}

