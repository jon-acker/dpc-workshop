<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use DeliverTo\Address;
use DeliverTo\Courier;
use DeliverTo\Courier\Instruction;
use DeliverTo\Customer;
use DeliverTo\Delivery;
use DeliverTo\PickupTime;
use DeliverTo\System;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var System
     */
    private $deliverTo;

    /**
     * @var \DeliverTo\FakeDispatcher
     */
    private $dispatcher;

    /**
     * @var \DeliverTo\InMemorySchedule
     */
    private $schedule;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->schedule = new \DeliverTo\InMemorySchedule();
        $this->dispatcher = new \DeliverTo\FakeDispatcher();
    }

    /**
     * @Transform :nick
     */
    public function makeCourier(string $name): Courier
    {
        return Courier::named($name);
    }

    /**
     * @Transform :james
     */
    public function nameCustomer(string $name): Customer
    {
        return Customer::named($name);
    }

    /**
     * @Transform :pickupAddress
     * @Transform :dropoffAddress
     */
    public function makeAddress(string $address): Address
    {
        return Address::of($address);
    }

    /**
     * @Given :nick is registered as a courier with DeliverTo
     */
    public function nickIsRegisteredAsACourierWithDeliverto(Courier $nick)
    {
        $this->deliverTo = new System($this->dispatcher, $this->schedule);

        $nick->registerWith($this->deliverTo);
    }

    /**
     * @Given :james is a customer of DeliverTo
     */
    public function jamesIsACustomerOfDeliverto(Customer $james)
    {
        $this->deliverTo->addCustomer($james);
    }

    /**
     * @Given :nick has no deliveries scheduled
     */
    public function nickHasNotBeenScheduledForAnyDelivery(Courier $nick)
    {
        Webmozart\Assert\Assert::false($this->deliverTo->hasDeliveriesScheduledFor($nick));
    }

    /**
     * @When :james books a delivery from :pickupAddress to :dropoffAddress for :minutes::seconds
     */
    public function jamesBooksADeliveryToFor(Customer $james, Address $pickupAddress, Address $dropoffAddress, string $minutes, string $seconds)
    {
        $james
            ->book(
                Delivery::from($pickupAddress)
                ->to($dropoffAddress)
                ->for(PickupTime::of($minutes, $seconds)))
            ->with($this->deliverTo);
    }

    /**
     * @Then :nick should have been dispatched to :pickupAddress for :hours::minutes
     */
    public function courierNickShouldBeDispatchedToFor(Courier $nick, Address $pickupAddress, string $hours, string $minutes)
    {
        $messages = $this->dispatcher->getMessagesSentTo($nick);

        Assert::assertEquals($messages[0], new Instruction('Report to ' . $pickupAddress. ' at ' . $hours. ':'. $minutes));
    }

    /**
     * @Then James should receive confirmation of a :arg1::arg2 pickup
     */
    public function jamesShouldReceiveConfirmationOfAPickup($arg1, $arg2)
    {
        throw new PendingException();
    }
 }
