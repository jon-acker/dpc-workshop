<?php

namespace DeliverTo;

use DeliverTo\Courier\Instruction;

class FakeDispatcher implements Dispatcher
{

    /**
     * @var Booking[]
     */
    private $bookingsDispatched;

    public function getMessagesSentTo(Courier $nick)
    {
        return $this->bookingsDispatched[serialize($nick)];
    }

    public function dispatch(Courier $courier, Instruction $instruction)
    {
        $this->bookingsDispatched[serialize($courier)][] = $instruction;
    }
}