## Distance Conversion Library

This distance conversion library provides the functionality to convert a provided distance from one distance
unit to another. Common US and metric distance measurements are supported (mi, ft, in, km, m, cm, and mm). Convert from
US to metric, metric to US, US to US or metric to metric.

## Usage:

        <?php
        use Frost\Distance;

        $distance = new Distance();
        $distance->setUnit('km')
                 ->setDistance(10);

        $value = $distance->convertTo('mi');
        ?>

