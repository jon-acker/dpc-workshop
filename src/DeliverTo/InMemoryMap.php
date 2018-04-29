<?php

namespace DeliverTo;

class InMemoryMap implements Map
{

    /**
     * @var array
     */
    private $distances = [];

    public function setDistance(string $address1, string $address2, int $distance)
    {
        var_dump($address1.$address2);

        $this->distances[md5($address1.$address2)] = $distance;
    }

    public function calculateDistanceBetween(string $address1, string $address2)
    {
        var_dump($this->distances, $address1.$address2);
        return $this->distances[md5($address1.$address2)];
    }
}