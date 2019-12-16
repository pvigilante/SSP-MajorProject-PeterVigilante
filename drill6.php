<?php
/*
REVIEW TOPICS
-------------
Setting: 
Several plane owners want to be able to keep track of all the share holders (part owners) of their planes, 
    so they can see who the owners are of each plane. 
Typically, because planes are so expensive, multiple pilots will go in together on one plane 
    so they can fly without spending unrealistic amounts of money.

Part 1: MySQL
Create a new database called ssp1300practiceexam.
Create a table for owners with columns for id and name. Add exactly 15 entries only.
Create a table for planes with columns for id, name and description. Add exactly 5 entries only.
Create a lookup table that will link each plane to multiple owners 
    and each owner to multiple planes using only id references 
    (at least 2 owners for every plane, one owner cannot own the same plane more than once, 
     every owner in the owners table should be attached to a plane, at least 3 owners must own more than one plane).
If you have trouble coming up with plane names you can type private plane types in google.

Part 2: PHP & HTML
Connect to your database and create a home page that lists all the planes by name.
Each plane from the home page must link to a plane page that will display:
The plane name
The plane description
A list of all the owners of the plane by name (at least 2 owners per plane).
On the plane page, include a back button to go to the home page.
All owner and plane information must be generated from the database. 
*/
?>