Feature: Booking a delivery

  Rules:
    The courier closest to the pickup address is dispatched first
    The average speed of a courier is 20 kilometers per hour
    If no courier is available - customer is told delivery cannot be booked
    Dispatching a courier means scheduling their booking and sending them a message with the details
    A couriers schedule contains the bookings that have been scheduled for them

  Context:
    Customer James wants to deliver a parcel from "Amsterdam Centraal" to "Rozenstraat 10" at 14:00

  Background:
    Given the distance from "Amsterdam" to "Utrech" is 10 kilometers
    And Nick is registered as a courier with DeliverTo
    And James is a customer of DeliverTo

  Scenario: Scheduling courier when they have enough time to make it to requested booking
    Given Nick was scheduled to deliver from Amsterdam to "Utrech" for 13:00
    When James tries to book a delivery from "Utrech" to "Den Haag" for 14:00
    Then this delivery should have been scheduled with Nick
    And James should received a confirmation of his booking

  Scenario: Not scheduling courier when they are busy
    Given Nick was scheduled to deliver from Amsterdam to "Utrech" for 14:00
    When James tries to book a delivery from "Utrech" to "Den Haag" for 14:15
    Then James should be told that no couriers are available
    And this delivery should not have been scheduled with Nick

  Scenario: Not scheduling courier when they can't make it to pickup address
    Given Nick was scheduled to deliver from Amsterdam to "Utrech" for 14:00
    And the distance from "Utrech" to "Den Haag" is 20 kilometers
    When James tries to book a delivery from "Den Haag" to "Eindhoven" for 15:00
    Then James should be told that no couriers are available
    And this delivery should not have been scheduled with Nick