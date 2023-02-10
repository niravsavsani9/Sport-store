<?php
#revision history
#           NAME                                    DATE                        COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         20/04/2022                      created order page
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         20/04/2022                      defined variables and connections
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         21/04/2022                      created html table
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         21/04/2022                      created html form for search by date
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         21/04/2022                      implemented conditions for delete order and search by date orders
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         23/04/2022                      completed entrypted password bug
require_once './connection.php';
require_once './Classes/collectionArray.php';
require_once './Classes/order.php';
require_once './Classes/orders.php';
define("FOLDER_PHP3", "./Function/");
define("PHP_FILE3", FOLDER_PHP3 . "./functions.php");
include_once(PHP_FILE3);
pagetop("order Page");
global $connection;
?>
<form method="post">
    <br />
    <label for="order">Select Order Date :</label>
    <input type="date" name="orderDate"><!-- comment -->
    <button type="submit" name="search" value="Search">Search</button>
    <?php
    #condition to delete order using order id
    if (isset($_POST["delete"])) {
      
        $order = new order();
        $order->setOrderID($_POST["delete"]);
        $order->delete();
        echo "<script>alert('Order sucessfully deleted');</script>";
    }
    #search order by date using user selected date
    if (isset($_POST["search"])) {
        $orderDate = "";
        if (empty($_SESSION["customer_id"])){
            echo "<script>alert('Please login first');</script>";
        }else{
        if(isset($_POST["orderDate"])){
            $orderDate = $_POST["orderDate"];
        }
        $sql = "CALL order_load(:customer_id,:orderDate)";
        $PDOobject = $connection->prepare($sql);
        $PDOobject->bindParam(":customer_id", $_SESSION["customer_id"]);
        $PDOobject->bindParam(":orderDate", $orderDate);
        $PDOobject->execute();
        
        ?>
    <!--created table-->
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
            #loop to load data into table
            while ($row = $PDOobject->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo '<td><button type="submit" name="delete" value="' . $row["order_id"] . '">Delete</button></td>';

            echo "<td>" . $row["create_at"] . "</td>";
            echo "<td>" . $row["product_code"] . "</td>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>" . $row["comments"] . "</td>";
            echo "<td>" . $row["retail_price"] . "</td>";
            echo "<td>" . $row["quantity"] . "</td>";
            echo "<td>" . $row["sub_total"] . "</td>";
            echo "<td>" . $row["taxes"] . "</td>";
            echo "<td>" . $row["total"] . "</td>";
            echo "</tr>";
        }
        }
    }
        ?>
    </table>
</form>


