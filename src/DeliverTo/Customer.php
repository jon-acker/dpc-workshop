<?php

namespace DeliverTo;

class Customer
{
    /**
     * @var Customer
     */
    private $name;

    public static function named(string $name)
    {
        $courier = new static();
        $courier->name  = $name;
        return $courier;
    }    
}