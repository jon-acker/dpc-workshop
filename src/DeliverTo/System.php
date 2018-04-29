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
     * @var Map
     */
    private $map;

    /**
     * System constructor.
     */
    const COURIER_SPEED = 20;

    public function __construct(Dispatcher $dispatcher, Schedule $schedule, Map $map)
    {
        $this->dispatcher = $dispatcher;
        $this->schedule = $schedule;
        $this->map = $map;
    }

    public function registerCourier(Courier $courier)
    {
        $this->couriers[$courier->getName()] = $courier;
    }

    public function addCustomer($james)
    {
    }

    public function hasDeliveriesScheduledFor(Courier $nick)
    {
        return $this->schedule->hasBookingsFor($nick);
    }

    public function scheduleCourier(Booking $requestedBooking)
    {
        foreach ($this->couriers as $courier) {
            $booking = $this->schedule->getLastBookingFor($courier);

            $pickupAddress1 = $booking->getDelivery()->getPickupAddress();
            $dropoffAddress1 = $booking->getDelivery()->getDropoffAddress();
            $pickupAddress2 = $requestedBooking->getDelivery()->getPickupAddress();

            $distance1 = $this->map->calculateDistanceBetween(
                $pickupAddress1,
                $dropoffAddress1
            );
            $distance2 = $this->map->calculateDistanceBetween(
                $dropoffAddress1,
                $pickupAddress2
            );

            $timeToPickupAddress = (($distance1 + $distance2) / self::COURIER_SPEED) * 60;
            $eta = $booking->getDelivery()->getPickupTime()->add(\DateInterval::createFromDateString("+$timeToPickupAddress minutes"));

            if ($requestedBooking->getDelivery()->getPickupTime()->isEarlierThan($eta)) {
                throw new \RuntimeException("No courier available");
            }
        }

        $this->schedule->add($booking, $this->couriers['Nick']);

        $delivery = $booking->getDelivery();

        $this->dispatcher->dispatch($this->couriers['Nick'], new Instruction('Report to ' . $delivery->getPickupAddress() . ' at ' . $delivery->getPickupTime()));
    }

}