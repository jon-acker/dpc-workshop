<?php

namespace DeliverTo;

use DateInterval;
use InMemorySchedule;

class System
{
    /**
     * @var Courier[]
     */
    private $couriers;

    /**
     * @var Customer[]
     */
    private $customers;

    /**
     * @var InMemorySchedule
     */
    private $schedule;
    /**
     * @var Map
     */
    private $map;
    /**
     * @var MessageGateway
     */
    private $messageGateway;

    /**
     * System constructor.
     */
    public function __construct(InMemorySchedule $schedule, Map $map, MessageGateway $messageGateway)
    {
        $this->schedule = $schedule;
        $this->map = $map;
        $this->messageGateway = $messageGateway;
    }

    public function registerCourier(Courier $courier )
    {
        $this->couriers[] = $courier;
    }

    public function registerCustomer(Customer $customer)
    {
        $this->customers[] = $customer;

    }

    public function schedule(Courier $nick, Delivery $delivery)
    {
        $this->schedule->add($nick, $delivery);
    }

    public function book(Delivery $deliveryRequest, Customer $customer)
    {
        foreach ($this->couriers as $courier) {
            $delivery =$this->schedule->getLastDeliveryFor($courier);

            $deliveryTime = $delivery->calculateTransitTimeUsing($this->map);

            $eta = $delivery->getPickupTime()->add(new DateInterval('PT'.$deliveryTime.'M'));

            $timeToPickup = ($this->map->calculateDistanceBetween(
                $delivery->getToAddress(),
                $deliveryRequest->getFromAddress()) / Courier::SPEED) * 60;

            $eta = $eta->add(new DateInterval('PT'.$timeToPickup.'M'));

            if ($eta <= $deliveryRequest->getPickupTime()) {
                $this->schedule->add($courier, $deliveryRequest);
                $this->messageGateway->send(Message::to($customer));
                return;
            }
        }

        throw new \RuntimeException();
    }
}