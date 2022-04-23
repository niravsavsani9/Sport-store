<?php
#REVISION HISTORY
#       NAME                                        DATE                                COMMENTS 
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      created class customers with constructor
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      make customers class extended from collection array


require_once './collectionArray.php';
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
    #Constructor
    function __construct() {
        global $connection;
        
        $sql = "CALL customer_select_all";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->execute();
        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
            $customers = new customer($row["customer_id"],$row["username"],$row["password"],$row["firstname"],$row["lastname"],$row["address"],$row["city"],$row["province"],$row["postal_code"],$row["picture"]);
            $this->add($row["customer_id"],$customers);
        }
    }
}
