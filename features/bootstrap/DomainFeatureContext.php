<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use DeliverTo\Courier;
use DeliverTo\Customer;
use DeliverTo\Delivery;
use DeliverTo\Message;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class DomainFeatureContext implements Context
{
    /**
     * @var InMemoryMap
     */
    private $map;

    /**
     * @var \DeliverTo\System
     */
    private $system;

    /**
     * @var InMemorySchedule
     */
    private $schedule;

    /**
     * @var RuntimeException
     */
    private $caughtException;

    /**
     * @var Delivery
     */
    private $delivery;

    /**
     * @var InMemoryMessageGateway
     */
    private $messageGateway;

    /**
     * Initializes context.
     */
    public function __construct()
    {
        $this->map = new InMemoryMap();
        $this->schedule = new InMemorySchedule();
        $this->messageGateway = new InMemoryMessageGateway();

        $this->system = new DeliverTo\System($this->schedule, $this->map, $this->messageGateway);
    }

    /**
     * @Transform :nick
     * @Transform :mark
     */
    public function makeCourier(string $name): Courier
    {
        return Courier::named($name);
    }

    /**
     * @Transform :customer
     * @Transform :james
     */
    public function makeCustomer(string $name): Customer
    {
        return Customer::named($name);
    }

    /**
     * @Given the distance from :address1 to :address2 is :distance kilometers
     */
    public function theDistanceFromToIsKilometers(string $address1, string $address2, $distance)
    {
        $this->map->setDistance($address1, $address2, $distance);
    }

    /**
     * @Given :name is registered as a courier with DeliverTo
     */
    public function nickIsRegisteredAsACourierWithDeliverto(string $name)
    {
        $this->system->registerCourier(Courier::named($name));
    }

    /**
     * @Given :name is a customer of DeliverTo
     */
    public function jamesIsACustomerOfDeliverto(string $name)
    {
        $this->system->registerCustomer(Customer::named($name));
    }

    /**
     * @Given :nick was scheduled to deliver from :pickupAddress to :dropoffAddress for :hours::minutes
     */
    public function nickWasScheduledToDeliverFromToFor(Courier $nick, string $pickupAddress, string $dropoffAddress, int $hours, int $mins)
    {
        $time = new DateTime("$hours:$mins:00");

        $this->schedule->add($nick,
            Delivery::from($pickupAddress)
                ->to($dropoffAddress)
                ->for($time)
        );
    }

    /**
     * @When :customer tries to book a delivery from :pickupAddress to :dropoffAddress for :hours::minutes
     */
    public function jamesTriesToBookADeliveryFromToFor(Customer $customer, string $pickupAddress, string $dropoffAddress, $hours, $minutes)
    {
        $this->delivery = Delivery::from($pickupAddress)
            ->to($dropoffAddress)
            ->for(new DateTime("$hours:$minutes:00"));

        try {
            $this->system->book($this->delivery, $customer);
        } catch (RuntimeException $e) {
            $this->caughtException = $e;
        }
    }

    /**
     * @Then this delivery should not have been scheduled with :nick
     */
    public function nickShouldNotHaveBeenScheduledToPickupFrom(Courier $nick)
    {
        Assert::assertNotContains($this->delivery, $this->schedule->getDeliveriesFor($nick));
    }

    /**
     * @Then this delivery should have been scheduled with :nick
     */
    public function nickShouldHaveBeenScheduledToPickupFrom(Courier $nick)
    {
        Assert::assertContains($this->delivery, $this->schedule->getDeliveriesFor($nick));
    }

    /**
     * @Then James should be told that no couriers are available
     */
    public function jamesShouldBeToldThatNoCouriersAreAvailable()
    {
        Assert::assertInstanceOf(RuntimeException::class, $this->caughtException);
    }

    /**
     * @When James books a delivery from :arg1 to :arg2 for :arg3::arg4
     */
    public function jamesBooksADeliveryFromToFor($arg1, $arg2, $arg3, $arg4)
    {
        throw new PendingException();
    }

    /**
     * @When Nick should have been scheduled to pickup from :arg1 at :arg2::arg3
     */
    public function nickShouldHaveBeenScheduledToPickupFromAt($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @Then :james should received a confirmation of his booking
     */
    public function jamesShouldReceivedAConfirmationOfHisBooking(Customer $james)
    {
        Assert::assertTrue($this->messageGateway->messageWasSent(Message::to($james)), 'Expected Customer to receive confirmation!');
    }
}
