DeliverTo - Courier System
====

Service that picks up an item for delivery and delivers it to a given address.

Customers book a delivery with DeliverTo giving the time they want the item to be picked up, pickup address and destination.

DeliverTo takes the bookings for deliveries and dispatches its couriers according to business rules.

DeliverTo estimates delivery time basked on destination and sends a message back to the Customer with an ETP (estimated time of pickup) and a confirmation that the job has been booked.
At the same time, the system tells the selected courier what address to pick up from, the time pickup was booked for and the address to delivery it to
The system also adds the job to the couriers schedule.

ETP's can be up to an hour later than the customer requests.

The courier closest to the pick-up point is the first to be dispatched to the pickup, unless their schedule will not allow pickup at requested time.

Couriers go about 20 miles an hour

If all couriers are busy - the estimated pickup time will based on how far they are from the pickup location and how long it will take the first free courier to get to the pickup point.
If that ETP results is more than an hour later than what the customer requested, the customer is told that there are no couriers available at the moment. 
Otherwise they are given the calculated ETP.

Customer at location C1 has booked a delivery for 16:45

One complex case would be where drive A is scheduled to deliver parcel to location A1 at 16:30, which is 10 miles from C1 (which takes courier A 5 mins to cover)
Whereas courier B is scheduled to deliver parcel to location A2 16:40 which is only 8 miles from location C1
Therefore courier A would get the job as they can make it by 17:00


Additional features, if time allows:
Customer gets notified:
 - if their pickup is more than 30 minutes late.
 Couriers confirm picking up (or failure to pick up) the parcel, delivering (or failing).


Examples
===
Customer James wants to deliver a parcel from A1 to A2 at 14:00
Distance from A1 to A2 is 20 miles (an hours journey)

Given courier Nick is 10 miles away and available from 13:30
When James books the delivery from A1 to A2 for 13:00
Then James should receive confirmation of a 14:00 parcel pickup 
And the courier Nick should be dispatched to A1 for 14:00

Given customer James has booked a delivery at 14:00 from A1 to A2
And the distance from A1 to A2 is 20 miles
When customer Brad books a delivery from B1 to B2 at 14:00
And the distance of A2 to B1 is 10 miles
Then Brad should receive confirmation of a 14:00 parcel pickup

Given courier Nick was dispatched at 14:00
And courier Bob is currently free
When Nick refuses to accept the job
Then courier Bob should have been dispatched

Given courier Nick was dispatched at 13:30
And courier Bob is currently free
When Nick accepts the job at 13:40
Then courier Bob should have been dispatched at 13:40

Scenario: Next customer is notified if pickup expected late
Given Brad was given confirmation of parcel pick at 14:00 from address B1
And address A2 is 20 miles from address B1
When courier Nick drops off James' parcel at 13:30 at address A2
Then Brad should be told that his pickup will be 30 minutes late

