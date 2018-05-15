<?php

namespace DeliverTo;

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

    public function calculateTransitTimeUsing(Map $map)
    {
        return ($map->calculateDistanceBetween($this->fromAddress, $this->toAddress) / 20) * 60;
    }
}