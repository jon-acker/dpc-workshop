<?php
class Time
{

    /**
     * @var DateTime
     */
    private $value;

    public static function at(string $hours, string $minutes)
    {
        $time = new static();

        $time->value = new DateTime("00:$hours:$minutes");

        return $time;
    }
}