DeliverTo - Courier System
====

DeliverTo is a Service that picks up an item for delivery from a given address and delivers it to another address.

Customers book a delivery with DeliverTo giving the time they want the item to be picked up, pickup address and destination.

DeliverTo takes the bookings for deliveries and schedules its couriers according to business rules.

DeliverTo tries to schedule a courier and sends a message back to the Customer with a confirmation or rejection.

The system schedules the courier with details of what address to pick up from, the time pickup was booked for and the address to delivery it to
(The mechanism for making the courier of the updates to their schedule is beyond the scope of this exercise)

If more than one courier can make it to the pickup address on time - the courier closest to the pickup is be scheduled to pickup.

If not couriers can make it to the pickup address on time - the customer is told that booking cannot be taken.

Couriers go about 20 kilometers an hour

Additional features, if time allows and you want to deal with more complicated business rules:

 - ETP's can be up to an hour later than the customer requests.
 - Customer gets notified if their pickup is more than 30 minutes late.
 - Couriers confirm picking up (or failure to pick up) the parcel, delivering (or failing).


Examples
===

Some context: 
Customer James wants to deliver a parcel from A1 to A2 at 14:00
Distance from A1 to A2 is 20 miles (an hours journey)


| Courier can make it  & is scheduled     | 
|-----------------------------------------| 
| James books a delivery for 13:00,       |  
| the courier last dropoff is at 12:00 -  |
| and 20 km from James`address            |
| therefore =>                            |
| He makes it on time - and is schedule   |
| for 13:00 picking up from James         |


| Booking is rejected - courier is busy   | 
|-----------------------------------------|
| James books a delivery for 13:00,       |  
| the courier last dropoff is at 12:00 -  |
| and 20 km from James` address           |
| therefore =>                            |
| He can't make it - and is not scheduled |
| James is told booking cannot be taken   |

Given courier Nick is 10 miles away and available from 13:30
When James books the delivery from A1 to A2 for 13:00
Then James should receive confirmation of a 14:00 parcel pickup 
And the courier Nick should be dispatched to A1 for 14:00

Advanced Examples
=================
Given customer James has booked a delivery at 14:00 from A1 to A2
And the distance from A1 to A2 is 20 miles
When customer Brad books a delivery from B1 to B2 at 14:00
And the distance of A2 to B1 is 10 miles
Then Brad should receive confirmation of a 14:00 parcel pickup

Scenario: Next customer is notified if pickup expected late
Given Brad was given confirmation of parcel pick at 14:00 from address B1
And address A2 is 20 miles from address B1
When courier Nick drops off James' parcel at 13:30 at address A2
Then Brad should be told that his pickup will be 30 minutes late

