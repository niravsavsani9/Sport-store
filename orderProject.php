<?php

define("FOLDER_PHP3", "./Function/");
define("PHP_FILE3", FOLDER_PHP3 . "./functions.php");
include_once(PHP_FILE3);
pagetop("buy Page");
global $connection;
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

<?php

$sql = "CALL order_load(:customer_id)";
$PDOobject = $connection->prepare($sql);
$PDOobject->bindParam(":customer_id", $_SESSION["customer_id"]);
$PDOobject->execute();

while($row=$PDOobject->fetch(PDO::FETCH_ASSOC)){
    echo "<tr>" ;
        echo '<td><input type="submit" name="delete" value="Delete"></td>';
        echo "<td>". $row["create_at"]."</td>";
        echo "<td>". $row["product_code"]."</td>";
        echo "<td>". $row["firstname"]."</td>";
        echo "<td>". $row["lastname"]."</td>";
        echo "<td>". $row["city"]."</td>";
        echo "<td>". $row["comments"]."</td>";
        echo "<td>". $row["retail_price"]."</td>";
        echo "<td>". $row["quantity"]."</td>";
        echo "<td>". $row["sub_total"]."</td>";
        echo "<td>". $row["taxes"]."</td>";
        echo "<td>". $row["total"]."</td>";
        echo "</tr>";
}


//  $searchOrder = new orders();
//    foreach ($searchOrder->items as $order){
//        echo "<tr>" ;
//        echo '<td><input type="submit" name="delete" value="Delete"></td>';
//        echo "<td>". $order["created_at"]."</td>";
//        echo "<td>". $order["product_code"]."</td>";
//        echo "<td>". $order["firstname"]."</td>";
//        echo "<td>". $order["lastname"]."</td>";
//        echo "<td>". $order["city"]."</td>";
//        echo "<td>". $order["comments"]."</td>";
//        echo "<td>". $order["retail_price"]."</td>";
//        echo "<td>". $order["quantity"]."</td>";
//        echo "<td>". $order["sub_total"]."</td>";
//        echo "<td>". $order["taxes"]."</td>";
//    
    echo "<td>". $order["total"]."</td>";
//        echo "</tr>";
//    }
?>
</table>

