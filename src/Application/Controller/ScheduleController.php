<?php
namespace Application\Controller;


use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ScheduleController
{

    private $deliverTo;

    public function __construct()
    {
    }

    /**
     * @Route("/book")
     */
    public function scheduleAction($customer, string $pickupAddress, string $dropoffAddress)
    {
        $this->deliverTo->book();
    }
}