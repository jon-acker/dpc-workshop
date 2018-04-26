<?php
namespace DeliverTo;

class Address
{
    private $text;

    public static function of(string $text): Address
    {
        $address = new static();

        $address->text = $text;

        return $address;
    }

    public function __toString()
    {
        return $this->text;
    }


}