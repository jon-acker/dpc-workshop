<?php
namespace DeliverTo;

use Doctrine\Common\Collections\ArrayCollection;

class InMemorySchedule implements Schedule
{

    private $schedules = [];

    public function add(Booking $booking, Courier $courier)
    {
        $this->schedules[md5(serialize($courier))][] = $booking;
    }

    public function hasBookingsFor(Courier $courier): bool
    {
        return count($this->schedules[md5(serialize($courier))]) > 0;
    }

    public function getBookingsFor(Courier $courier): array
    {
        return $this->schedules[md5(serialize($courier))];
    }

    public function getLastBookingFor(Courier $courier): Booking
    {
        return end($this->schedules[md5(serialize($courier))]);
    }
}