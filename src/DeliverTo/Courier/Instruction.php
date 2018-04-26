<?php

namespace DeliverTo\Courier;

class Instruction
{
    /**
     * @var string
     */
    private $message;

    /**
     * Courier constructor.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }
}