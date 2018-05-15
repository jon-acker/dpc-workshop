<?php
class InMemoryMessageGateway implements MessageGateway
{

    /**
     * @var Message[]
     */
    private $sentMessages = [];

    public function send(Message $message)
    {
        $this->sentMessages[] = $message;
    }

    public function getSentMessages()
    {
        return $this->sentMessages;
    }

    public function messageWasSent(Message $message)
    {
        foreach ($this->sentMessages as $sentMessage) {
            if (serialize($sentMessage) === serialize($message)) {
                return true;
            }
        }

        return false;
    }
}