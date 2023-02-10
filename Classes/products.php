<?php
#REVISION HISTORY
#       NAME                                        DATE                                COMMENTS 
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                          created class products
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                          make products extended from collection array
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                          create cnstructor
#

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of products
 *
 * @author savsa
 */
class products extends collectionArray {
    //put your code here
    #constructor
    function __construct() {
        global $connection;
        
        $sql = "CALL product_select_all";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->execute();
        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
            $products = new product($row["product_id"],$row["product_code"],$row["product_description"],$row["retail_price"],$row["cost_price"]);
            $this->add($row["product_id"],$products);
        }
    }
}
