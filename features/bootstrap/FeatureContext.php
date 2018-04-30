<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var \DeliverTo\InMemoryMap
     */
    private $map;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->map = new \DeliverTo\InMemoryMap();
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
}
