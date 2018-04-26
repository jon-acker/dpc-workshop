<?php
namespace DeliverTo;

interface Schedule
{
    public function add(Booking $booking);
}