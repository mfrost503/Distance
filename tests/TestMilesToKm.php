<?php
namespace Frost\Distance;

class TestCalculations extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->distance = new Distance();
    }

    public function tearDown()
    {
        unset($this->distance);
    }

    public function distanceProvider()
    {
        return array(
            array(10,'km','mi',10/1.60934),
            array(100,'m','mi',100/1609.34),
            array(144,'ft','mi',144/5280),
            array(12,'ft','in', 144),
            array(13,'in','ft',13 * (5280/63360)),
            array(10,'km','cm', 10 * (160934/1.60934)),
            array(100000,'cm','km',100000 * (1.60934/160934)),
            array(10000,'m','in',10000 *(63360/1609.34))
        );
    }

    /**
     * @test
     * Given that we have a distance not in miles
     * When we request the values in miles
     * Then we expect the miles equivalent to be returned
     * @dataProvider distanceProvider
     */

    public function ConvertFromOneUnitToAnother($providedDistance,$unit,$convertTo,$expected)
    {
        $this->distance->setDistance($providedDistance)->setUnit($unit);
        $value = $this->distance->convertTo($convertTo);
        $this->assertEquals($value,$expected,$value);
    }

    /**
     * @test
     * Given that we have a distance with an invalid unit
     * When we attempt to set the unit
     * Then we expect to have an UndefinedUnitException thrown
     * @expectedException \Frost\Distance\UndefinedUnitException
     */

    public function HandleInvalidUnitPassedTosetUnit()
    {
        $this->distance->setUnit('bb');
    }

    /**
     * @test
     * Given that we have a valid distance
     * When we attempt to convert to a non-existent unit type
     * Then we expect to have an UndefinedUnitException thrown
     * @expectedException \Frost\Distance\UndefinedUnitException
     */

    public function HandleInvalidUnitPassedToConvertTo()
    {
        $this->distance->setUnit('mi')
                       ->setDistance(10);
        $value = $this->distance->convertTo('ab');
    }
}