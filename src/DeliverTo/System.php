<?php

namespace DeliverTo;

use DeliverTo\Courier\Instruction;

class System
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;
    /**
     * @var Schedule
     */
    private $schedule;

    private $couriers;

    /**
     * System constructor.
     */
    public function __construct(Dispatcher $dispatcher, Schedule $schedule)
    {
        $this->dispatcher = $dispatcher;
        $this->schedule = $schedule;
    }

    public function registerCourier(Courier $courier)
    {
        $this->couriers[] = $courier;
    }

    public function addCustomer($james)
    {
    }

    public function hasDeliveriesScheduledFor($nick)
    {
        return false;
    }

    public function scheduleCourier(Booking $booking)
    {
        $this->schedule->add($booking);

        $delivery = $booking->getDelivery();

        $this->dispatcher->dispatch($this->couriers[0], new Instruction('Report to ' . $delivery->getPickupAddress() . ' at ' . $delivery->getPickupTime()));
    }

}