<?php

namespace DeliverTo;

use DeliverTo\Courier\Instruction;

interface Dispatcher
{
    public function dispatch(Courier $courier, Instruction $instruction);
}