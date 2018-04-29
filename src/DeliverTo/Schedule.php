<?php
namespace DeliverTo;

interface Schedule
{
    public function add(Booking $booking, Courier $courier);

    public function hasBookingsFor(Courier $courier): bool;

    /**
     * @return Booking[]
     */
    public function getBookingsFor(Courier $courier): array;

    public function getLastBookingFor(Courier $courier): Booking;
}