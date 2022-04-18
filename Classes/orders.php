<?php
require_once ('./collectionArray.php');
require_once ('./order.php');
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of orders
 *
 * @author savsa
 */
class orders {
    //put your code here
    function __construct() {
        global $connection;
        
        $sql = "SELECT * FROM orders";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->execute();
        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
            $orders = new customers($row["order_id"],$row["customer_id"],$row["product_id"],$row["quantity"],$row["lastname"],$row["address"],$row["city"],$row["province"],$row["postal_code"],$row["picture"]);
            $this->add($row["order_id"],$orders);
        }
    }
}
