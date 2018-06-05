<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 04/06/2018
 * Time: 22:03
 */

namespace DeliverTo;


use DateInterval;

class CalculatingTransitTime
{
    /**
     * @var string
     */
    private $address1;
    /**
     * @var string
     */
    private $address2;

    /**
     * @param string $address1
     * @param string $address2
     */
    public function __construct(string $address1, string $address2)
    {
        $this->address1 = $address1;
        $this->address2 = $address2;
    }

    /**
     * @param Map $map
     * @return DateInterval
     * @throws \Exception
     */
    public function using(Map $map): DateInterval
    {
        $minutes = $map->calculateDistanceBetween($this->address1, $this->address2) / Courier::SPEED * 60;

        return new DateInterval('PT'.$minutes.'M');
    }
}