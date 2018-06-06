<?php

namespace Application\Controller;

use Application\Entity\Booking;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * DefaultController constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index()
    {
        $booking = new Booking(new DateTime());

        $this->entityManager->persist($booking);

        $this->entityManager->flush();

        return new JsonResponse([]);
    }
}
