<?php
namespace Application\Controller;


use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BookController
{

    private $deliverTo;

    public function __construct()
    {
    }

    /**
     * @Route("/book")
     */
    public function bookAction(Request $request)
    {
        var_dump(json_decode($request->getContent()));
//        $this->deliverTo->book();

        return new JsonResponse();
    }
}