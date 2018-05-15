<?php

namespace DeliverTo;

class Courier
{
    const SPEED = 20;
    /**
     * @var Courier
     */
    private $name;

    public static function named(string $name)
    {
        $courier = new static();
        $courier->name  = $name;
        return $courier;
    }    
}