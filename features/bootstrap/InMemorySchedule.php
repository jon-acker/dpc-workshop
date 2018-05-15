<?php

use DeliverTo\Courier;
use DeliverTo\Delivery;
use DeliverTo\Schedule;

class InMemorySchedule implements Schedule
{
    /**
     * @var Delivery[]
     */
    private $deliveries;

    public function add(Courier $courier, Delivery $delivery)
    {
        $this->deliveries[md5(serialize($courier))][] = $delivery;
    }

    public function getLastDeliveryFor(Courier $courier): Delivery
    {
        return end($this->deliveries[md5(serialize($courier))]);
    }

    public function getDeliveriesFor($courier)
    {
        return $this->deliveries[md5(serialize($courier))];
    }
}