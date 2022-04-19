<?php
require_once './order.php';
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of orders
 *
 * @author savsa
 */
class orders extends collectionArray {
    //put your code here
    function __construct() {
        global $connection;
        
        $sql = "CALL order_load(:customer_id)";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->execute();
        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
//            $orders = new order($row["order_id"],$row["customer_id"],$row["product_id"],$row["quantity"],$row["price"],$row["comments"],$row["sub_total"],$row["taxes"],$row["total"]);
            $orders = new order($row["order_id"],$row["create_at"],$row["product_code"],$row["firstname"],$row["lastname"],$row["city"],$row["comments"],$row["price"],$row["quantity"], $row["taxes"], $row["total"]);
            $this->add($row["order_id"],$orders);
        }
    }
}
