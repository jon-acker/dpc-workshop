<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Defines application features from the specific context.
 */
class EndToEndFeatureContext implements Context
{
    /**
     * @var InMemoryMap
     */
    private $map;
    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(Kernel $kernel)
    {
        $this->map = new InMemoryMap();
        $this->kernel = $kernel;
    }

    /**
     * @Transform :nick
     */
    public function makeCourier(string $name): Courier
    {
        return Courier::named($name);
    }

    /**
     * @Given the distance from :address1 to :address2 is :distance kilometers
     */
    public function theDistanceFromToIsKilometers($address1, $address2, $distance)
    {
        $this->map->setDistance($address1, $address2, $distance);
    }

    public function customerBooksADelivery()
    {
        $json = "{}";
        $request = Request::create('/schedule', Request::METHOD_POST, [], [], [], [], json_encode($json));
        $response = $this->kernel->handle($request);
    }
}
