<?php

use DeliverTo\Map;

class InMemoryMap implements Map
{
    private $distances;

    /**
     * @param string $address1
     * @param string $address2
     * @param float $distance
     */

    public function setDistance(string $address1, string $address2, float $distance)
    {
        $this->distances[md5($address1.'.'.$address2)] = $distance;
    }

    public function calculateDistanceBetween(string $address1, string $address2): float
    {
        return (float)$this->distances[md5($address1.'.'.$address2)];
    }
}