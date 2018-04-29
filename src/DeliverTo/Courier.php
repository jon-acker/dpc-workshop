<?php

namespace DeliverTo;

class Courier
{
    private $name;

    public static function named(string $name): Courier
    {
        $courier = new static();

        $courier->name = $name;

        return $courier;
        
    }

    public function registerWith(System $deliverTo)
    {
        $deliverTo->registerCourier($this);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}