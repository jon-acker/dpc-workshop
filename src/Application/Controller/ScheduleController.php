<?php
namespace Application\Controller;


use DateTime;
use DeliverTo\Customer;
use DeliverTo\Delivery;
use DeliverTo\System;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ScheduleController
{
    /**
     * @var System
     */
    private $deliverTo;

    public function __construct(System $deliverTo)
    {
        $this->deliverTo = $deliverTo;
    }

    /**
     * @Route("/book")
     */
    public function scheduleAction(Customer $customer, string $pickupAddress, string $dropoffAddress)
    {
        $delivery = Delivery::from($pickupAddress)
            ->to($dropoffAddress)
            ->for(new DateTime("$hours:$minutes:00"));

        $this->deliverTo->book($delivery, $customer);
    }
}