Feature: Booking a delivery

  Rules:
    The courier closest to the pickup address is dispatched first
    The average speed of a courier is 20 kilometers per hour
    If no courier is available - customer is told delivery cannot be booked
    Dispatching a courier means scheduling their booking and sending them a message with the details
    A couriers schedule contains the bookings that have been scheduled for them

  Context:
    Customer James wants to deliver a parcel from "Amsterdam Centraal" to "Rozenstraat 10" at 14:00
#
#  Background:
#    Given the distance from "Amsterdam Centraal" to "Rozenstraat 10" is 20 kilometers
#    And Nick is registered as a courier with DeliverTo
#    And James is a customer of DeliverTo
#
#
#  Scenario: Simplest case?
#    Given Nick has no deliveries scheduled
#    When James books a delivery from "Amsterdam Centraal" to "Rozenstraat 10" for 13:00
#    Then Nick should have been dispatched to "Amsterdam Centraal" for 13:00
#
#  Scenario: Courier cant make it
#    Given Nick was scheduled to deliver from "Amsterdam Centraal" to "Rozenstraat 10" for 12:00
#    And the distance from "Rozenstraat 10" to "Hustonstraat 14" is 10 kilometers
#    When James books a delivery from "Hustonstraat 14" to "Amsterdam Centraal" for 13:00
#    Then James should be told that no courier is available
#    And Nick should not have been scheduled to pickup from "Hustonstraat 14" for 13:00
    