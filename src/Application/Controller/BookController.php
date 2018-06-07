<?php
namespace Application\Controller;


use DateTime;
use DeliverTo\Schedule;
use DeliverTo\System;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BookController
{

    private $deliverTo;

    /**
     * BookController constructor.
     * @param System $deliverTo
     */
    public function __construct(System $deliverTo)
    {
        $this->deliverTo = $deliverTo;
    }

    /**
     * @Route("/book")
     */
    public function bookAction(Request $request)
    {
        $delivery = json_decode($request->getContent());
        $this->deliverTo->book($delivery);

        return new JsonResponse();
    }
}