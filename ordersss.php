<?php

define("FOLDER_PHP3", "./Function/");
define("PHP_FILE3", FOLDER_PHP3 . "./functions.php");
include_once(PHP_FILE3);
pagetop("order Page");
?>

<form action="orderProject.php">
  <label for="order">Select Order Date :</label>
  <input type="date" name="order">
</form>

<table  class="tableOrderPage" border="2px">
    <thead>
        <tr>
            <th><b>Delete</b></th>
             <th><b>Date</b></th>
              <th><b>Product Code</b></th>
            <th><b>First Name</b></th>
            <th><b>Last Name</b></th>
            <th><b>City</b></th>
            <th><b>Comment</b></th>
            <th><b>Price</b></th>
            <th><b>Quantity</b></th>
            <th><b>sub total</b></th>
            <th><b>taxes</b></th>
            <th><b>Total</b></th>
        </tr>
    </thead>
</table>
