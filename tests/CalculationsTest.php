<?php
namespace Frost\Distance;

class CalculationsTest extends \PHPUnit_Framework_TestCase
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
            array(10000,'m','in',10000 *(63360/1609.34)),
            array(1.55, 'mi', 'm', 1.55 *1609.34)
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
        $value = $this->distance->setDistance($providedDistance)
            ->setUnit($unit)
            ->convertTo($convertTo);
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
        $value = $this->distance->setUnit('mi')
            ->setDistance(10)
            ->convertTo('ab');
    }

    /**
     * @test
     * Given that a non-integer and non-float value is provided
     * When we attempt to set the distance
     * Then we expect an InvalidArgumentException to be thrown
     * @expectedException \InvalidArgumentException
     */
    public function HandleNonNumericDistance()
    {
        $this->distance->setUnit('mi')
            ->setDistance('abc')
            ->convertTo('km');
    }
}
