<?php
namespace DeliverTo;

class Delivery
{
    private $pickupAddress;

    /**
     * @var PickupTime
     */
    private $pickupTime;

    private $dropoffAddress;

    public static function from(Address $pickupAddress): Delivery
    {
        $delivery = new static();

        $delivery->pickupAddress = $pickupAddress;

        return $delivery;
    }

    public function to(Address $dropoffAddress): Delivery
    {
        $this->dropoffAddress = $dropoffAddress;

        return $this;
    }

    public function for(PickupTime $pickupTime)
    {
        $this->pickupTime = $pickupTime;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPickupAddress()
    {
        return $this->pickupAddress;
    }

    /**
     * @return mixed
     */
    public function getPickupTime(): PickupTime
    {
        return $this->pickupTime;
    }
}