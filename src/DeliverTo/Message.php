<?php

namespace DeliverTo;

class Message
{

    /**
     * @var \DeliverTo\Customer
     */
    private $customer;

    public static function to(\DeliverTo\Customer $customer): Message
    {
        $message = new static();
        $message->customer = $customer;

        return $message;
    }
}