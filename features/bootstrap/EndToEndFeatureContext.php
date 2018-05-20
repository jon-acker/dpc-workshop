<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

class EndToEndFeatureContext implements Context
{


    /**
     * @Given the distance from :arg1 to :arg2 is :arg3 kilometers
     */
    public function theDistanceFromToIsKilometers($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @Given Nick is registered as a courier with DeliverTo
     */
    public function nickIsRegisteredAsACourierWithDeliverto()
    {
        throw new PendingException();
    }

    /**
     * @Given James is a customer of DeliverTo
     */
    public function jamesIsACustomerOfDeliverto()
    {
        throw new PendingException();
    }

    /**
     * @Given Nick was scheduled to deliver from :arg1 to :arg2 for :arg3::arg4
     */
    public function nickWasScheduledToDeliverFromToFor($arg1, $arg2, $arg3, $arg4)
    {
        throw new PendingException();
    }

    /**
     * @When James tries to book a delivery from :arg1 to :arg2 for :arg3::arg4
     */
    public function jamesTriesToBookADeliveryFromToFor($arg1, $arg2, $arg3, $arg4)
    {
        throw new PendingException();
    }

    /**
     * @Then this delivery should have been scheduled with Nick
     */
    public function thisDeliveryShouldHaveBeenScheduledWithNick()
    {
        throw new PendingException();
    }

    /**
     * @Then James should received a confirmation of his booking
     */
    public function jamesShouldReceivedAConfirmationOfHisBooking()
    {
        throw new PendingException();
    }

    /**
     * @Then James should be told that no couriers are available
     */
    public function jamesShouldBeToldThatNoCouriersAreAvailable()
    {
        throw new PendingException();
    }

    /**
     * @Then this delivery should not have been scheduled with Nick
     */
    public function thisDeliveryShouldNotHaveBeenScheduledWithNick()
    {
        throw new PendingException();
    }
}
