<?php
#REVISION HISTORY
#       NAME                                        DATE                                COMMENTS 
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                       created class orders
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                       make it extended from collection array
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                       created constructor

//require_once './collectionArray.php';
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
    #constructor
    function __construct() {
        global $connection;
        
        $sql = "CALL order_load(:order_id)";
        $PDOobject = $connection->prepare($sql);
        $PDOobject->execute();
        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
            $orders = new order($row["order_id"],$row["create_at"],$row["product_code"],$row["firstname"],$row["lastname"],$row["city"],$row["comments"],$row["price"],$row["quantity"], $row["taxes"], $row["total"]);
            $this->add($row["order_id"],$orders);
        }
    }
}
