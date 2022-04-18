<?php
require_once ('./collectionArray.php');
require_once ('./customer.php');
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of customers
 *
 * @author savsa
 */
class customers extends collectionArray {
    //put your code here
    function __construct() {
        global $connection;
        
        $sql = "SELECT * FROM customers ORDER BY firstname";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->execute();
        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
            $customers = new customers($row["customer_id"],$row["username"],$row["password"],$row["firstname"],$row["lastname"],$row["address"],$row["city"],$row["province"],$row["postal_code"],$row["picture"]);
            $this->add($row["customer_id"],$customers);
        }
    }
}
