<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 14/05/2018
 * Time: 13:30
 */

namespace Application\Controller;


use DateTime;
use DeliverTo\Customer;
use DeliverTo\Delivery;
use DeliverTo\System;

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

    public function scheduleAction(Customer $customer, string $pickupAddress, string $dropoffAddress)
    {
        $delivery = Delivery::from($pickupAddress)
            ->to($dropoffAddress)
            ->for(new DateTime("$hours:$minutes:00"));

        $this->deliverTo->book($delivery, $customer);
    }
}