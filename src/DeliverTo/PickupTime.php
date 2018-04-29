<?php
namespace DeliverTo;

class PickupTime
{
    /**
     * @var \DateTime
     */
    private $dateTime;

    public function __toString()
    {
        return $this->dateTime->format('H:i');
    }

    public static function of(string $hours, string $minutes): PickupTime
    {
        $time = new static();

        $time->dateTime = new \DateTime("$hours:$minutes:00");

        return $time;
    }

    public function add(\DateInterval $time): \DateTime
    {
        return $this->dateTime->add($time);
    }

    public function isEarlierThan(\DateTime $dateTime) {
        return $this->dateTime < $dateTime;
    }
}