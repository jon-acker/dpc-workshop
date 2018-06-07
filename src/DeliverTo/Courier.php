<?php
namespace DeliverTo;

class Courier
{
    public static function named(string $name)
    {
        $courier = new static();
        $courier->name = $name;

        return $courier;
    }
}