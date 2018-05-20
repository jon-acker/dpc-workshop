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

    public function calculateTransitTimeUsing(Map $map): int
    {
        return ($map->calculateDistanceBetween($this->fromAddress, $this->toAddress) / 20) * 60;
    }

    /**
     * @param Map $map
     * @return DateTime
     * @throws \Exception
     */
    public function calculateDropoffTimeUsing(Map $map)
    {
        $deliveryTime = $this->calculateTransitTimeUsing($map);

        return $this->pickupTime->add(new DateInterval('PT'.$deliveryTime.'M'));
    }

    public function hasPickupBefore(DateTime $eta)
    {
        return $eta < $this->pickupTime;
    }
}