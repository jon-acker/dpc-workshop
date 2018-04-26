<?php

namespace DeliverTo;

class Booking
{
    /**
     * @var Delivery
     */
    private $delivery;
    /**
     * @var Customer
     */
    private $customer;

    public function __construct(Customer $customer, Delivery $delivery)
    {
        $this->delivery = $delivery;
        $this->customer = $customer;
    }

    public function with(System $system)
    {
        $system->scheduleCourier($this);
    }

    /**
     * @return Delivery
     */
    public function getDelivery(): Delivery
    {
        return $this->delivery;
    }
}