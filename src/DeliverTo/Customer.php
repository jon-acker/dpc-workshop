<?php

namespace DeliverTo;

class Customer
{

    public static function named(string $name): Customer
    {
        $customer = new static();

        $customer->name = $name;

        return $customer;
    }

    public function book(Delivery $delivery): Booking
    {
        return new Booking($this, $delivery);
    }
}