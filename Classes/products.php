<?php
require_once ('./collectionArray.php');
require_once ('./product.php');
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of products
 *
 * @author savsa
 */
class products {
    //put your code here
    
    function __construct() {
        global $connection;
        
        $sql = "SELECT * FROM products";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->execute();
        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
            $products = new customers($row["product_id"],$row["product_code"],$row["product_description"],$row["retail_price"],$row["cost_price"]);
            $this->add($row["product_id"],$products);
        }
    }
}
