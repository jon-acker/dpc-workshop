<?php

namespace DeliverTo;

use DateInterval;
use InMemorySchedule;
use RuntimeException;

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

    public function registerCourier(Courier $courier)
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

    /**
     * @param Delivery $requestedDelivery
     * @param Customer $customer
     * @throws \Exception
     */
    public function book(Delivery $requestedDelivery, Customer $customer)
    {
        $lastDelivery = $this->schedule->getLastDeliveryFor($this->couriers[0]);

        $estimatedPickupTime = $lastDelivery
            ->calculateDropoffTimeUsing($this->map)
            ->add($lastDelivery
                ->calculateTransitTimeTo($requestedDelivery)
                ->using($this->map)
            );

        if ($requestedDelivery->hasPickupBefore($estimatedPickupTime)) {
            $this->schedule->add($this->couriers[0], $requestedDelivery);
            $this->messageGateway->send(Message::to($customer));
            return;
        }

        throw new RuntimeException();
    }
}