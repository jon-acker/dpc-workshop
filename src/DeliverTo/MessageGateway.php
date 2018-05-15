<?php

namespace DeliverTo;

interface MessageGateway
{
    public function send(Message $message);

}