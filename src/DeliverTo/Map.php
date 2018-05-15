<?php
namespace DeliverTo;

interface Map
{
    public function calculateDistanceBetween(string $address1, string $address2): float;
}