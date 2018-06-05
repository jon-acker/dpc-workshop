<?php

namespace DeliverTo;

use DateInterval;
use DateTime;

class Delivery
{
    private $fromAddress;

    private $toAddress;

    /**
     * @var DateTime
     */
    private $pickupTime;

    public static function from(string $fromAddress): Delivery
    {
        $delivery = new static();
        $delivery->fromAddress = $fromAddress;

        return $delivery;
    }

    public function to($toAddress)
    {
        $this->toAddress = $toAddress;

        return $this;
    }

    public function for(DateTime $pickupTime)
    {
        $this->pickupTime = $pickupTime;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @return DateTime
     */
    public function getPickupTime(): DateTime
    {
        return $this->pickupTime;
    }

    public function getToAddress()
    {
        return $this->toAddress;
    }

    public function calculateTransitTimeUsing(): CalculatingTransitTime
    {
        return new CalculatingTransitTime($this->fromAddress, $this->toAddress);
    }

    /**
     * @param Map $map
     * @return DateTime
     * @throws \Exception
     */
    public function calculateDropoffTimeUsing(Map $map)
    {
        $deliveryTime = (new CalculatingTransitTime($this->fromAddress, $this->toAddress))->using($map);

        return $this->pickupTime->add($deliveryTime);
    }

    public function hasPickupBefore(DateTime $eta)
    {
        return $eta < $this->pickupTime;
    }

    public function calculateTransitTimeTo(Delivery $requestedDelivery): CalculatingTransitTime
    {
        return new CalculatingTransitTime($this->toAddress, $requestedDelivery->fromAddress);
    }
}