<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * @Entity(repositoryClass="Application\Repository\BookingRepository")
 */
class Booking
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Column(type="datetime", name="time")
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * Booking constructor.
     * @param $date
     */
    public function __construct(\DateTimeInterface $date)
    {
        $this->date = $date;
    }

}
