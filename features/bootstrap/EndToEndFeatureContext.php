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
     * @var InFileMap
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
     * @param Kernel $kernel
     * @param InFileMap $map
     */
    public function __construct(Kernel $kernel, InFileMap $map)
    {
        $this->kernel = $kernel;
        $this->map = $map;
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

    /**
     * @When James books a delivery
     */
    public function customerBooksADelivery()
    {
        $payload = '{ "customer": "James" }';
        $request = Request::create('/book', Request::METHOD_POST, [], [], [], [], $payload);
        $response = $this->kernel->handle($request);
    }
}
