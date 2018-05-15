<?php
namespace DeliverTo;

interface Schedule
{
    public function add(Courier $courier, Delivery $delivery);

    public function getLastDeliveryFor(Courier $courier): Delivery;
}