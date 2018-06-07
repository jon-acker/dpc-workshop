Feature: Booking a delivery

  Rules:
    The cour  ier closest to the pickup address is dispatched first
    The average speed of a courier is 20 kilometers per hour
    If no courier is available - customer is told delivery cannot be booked
    A couriers schedule contains the bookings that have been scheduled for them
    Customer gets confirmation of booking or rejection

  Context:
    Customer James wants to deliver a parcel from "Amsterdam Centraal" to "Rozenstraat 10" at 14:00

  Background:
    Given the distance from "Amsterdam Centraal" to "Rozenstraat 10" is 20 kilometers

  Scenario: Simplest case? Courier gets scheduled because they can make it on time
    When James books a delivery