<?php
#REVISION HISTORY
#       NAME                                        DATE                                COMMENTS 
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      created class order
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      defined constants and variables
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      created getters and setters property
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      created functions get,set,constructor,load,save,update,delete
//require './customer.php';
//require_once '../connection.php';
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of order
 *
 * @author savsa
 */
class order {
    //put your code here
    
    #create constant
    const CUSTOMER_ID_LENGHT = 36;
    const PRODUCT_ID_LENGHT = 36;
    const QUANTITY_MAXIMUM_LENGHT = 99;
    const QUANTITY_MINIMUM_LENGHT = 1;
    const PRICE_LENGHT = 10;
    const COMMENTS_LENGHT = 200;


    private $order_id = "";
    private $customer_id = "";
    private $product_id = "";
    private $quantity = "";
    private $price = "";
    private $comments = "";
    private $sub_total = "";
    private $taxes = "";
    private $total = "";
    
    public function getOrderID()
    {
        return $this->order_id;
    }
   
    public function getCustomerId() {
        return $this->customer_id;
    }
    
    public function getProductId() {
        return $this->product_id;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getComments() {
        return $this->comments;
    }
     public function getSubTotal() {
        return $this->sub_total;
    }
     public function getTaxes() {
        return $this->taxes;
    }
     public function getTotal() {
        return $this->total;
    }
    
    public function setOrderID($newOrder_id)
    {
        if(mb_strlen($newOrder_id) != 0)
        {
            
            $this->order_id = $newOrder_id;
        }
        else
        {
            return "Order id (primary Key) missing.....";
        }
    }
        
    public function setCustomerId($newCustomerId) {
        if (mb_strlen($newCustomerId) == 0) {
            return "The customer Id........... empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newCustomerId) > self::CUSTOMER_ID_LENGHT) {
                return "The lenght of customer Id............error!";
            } else {
                $this->customer_id = $newCustomerId;
            }
        }
    }
    
    public function setProductId($newProductId) {
        if (mb_strlen($newProductId) == 0) {
            return "The product Id........... empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newProductId) > self::PRODUCT_ID_LENGHT) {
                return "The lenght of product Id............error!";
            } else {
                $this->product_id = $newProductId;
            }
        }
    }
    
    public function setQuantity($newQuantity) {
        if (mb_strlen($newQuantity) == 0) {
            return "The quantity........... empty";
        } else
        if (!(is_numeric($newQuantity))) 
        {
            return "The Quantity must be a Numeric Value";
        }
        else
        {
            if(mb_strpos($newQuantity, ".") || mb_strpos($newQuantity, ","))
            {
                return "The Quantity cannot be decimal.";
            }
            else
            {
                if ($newQuantity < self::QUANTITY_MINIMUM_LENGHT || $newQuantity > self::QUANTITY_MAXIMUM_LENGHT) 
                {
                    return "The lenght of quantity............error!";
                }
                else 
                {
                     $this->quantity = $newQuantity;

                }
            }
        }
    }
    
    public function setPrice($newPrice) {
        if (mb_strlen($newPrice) == 0) {
            return "The price...........empty";
        }else
            if (!(is_numeric($newPrice))) 
            {
                return "The Price must be a Numeric Value";
            } else {
            #access created constants using self as below
            if (mb_strlen($newPrice) > self::PRICE_LENGHT) {
                return "The lenght of price............error!";
            } else {
                $this->price = $newPrice;
            }
        }
    }
    
    public function setComments($newComments) {
        #access created constants using self as below
            if (mb_strlen($newComments) > self::COMMENTS_LENGHT) {
                return "The lenght of comments............error!";
            } else {
                $this->comments = $newComments;
            }
    }
    
    public function setSubTotal($newSubTotal) {
       
                $this->sub_total = $newSubTotal;
    }
    public function setTaxes($newTaxes) {
       
                $this->taxes = $newTaxes;
    }
    public function setTotal($newTotal) {
       
                $this->total = $newTotal;
    }
    
    
    public function __construct($order_id = "", $customer_id = "", $product_id = "", $quantity = "", $price = "", $comments = "") {
        if ($order_id != "" || $customer_id != "" || $product_id != "" || $quantity != "" || $price != "" || $comments != "" ) {
            $this->order_id($order_id);
            $this->setCustomerId($customer_id);
            $this->setProductId($product_id);
            $this->setQuantity($quantity);
            $this->setPrice($price);
            $this->setComments($comments);
        }
    }
    
    #get data from database
    public function load($order_id){
        global $connection;
        $sql = "CALL order_select_one(:order_id)";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->bindParam(':order_id', $order_id);
        $PDOobject->execute();
        if($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
        $this->order_id = $row["order_id"];
        $this->customer_id = $row["customer_id"];
        $this->product_id = $row["product_id"];
        $this->quantity = $row["quantity"];
        $this->price = $row["price"];
        $this->comments = $row["comments"];
        return true;
        } 
    }
    
    public function save()
    {
        global $connection;
        if($this->order_id == "")
        {
            $sql = "CALL order_insert(:customer_id, :product_id, :quantity, :price, :comments, :sub_total, :taxes, :total)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':customer_id', $this->customer_id);
            $PDOobject->bindParam(':product_id', $this->product_id);
            $PDOobject->bindParam(':quantity', $this->quantity);
            $PDOobject->bindParam(':price', $this->price);
            $PDOobject->bindParam(':comments', $this->comments);
            $PDOobject->bindParam(':sub_total', $this->sub_total);
            $PDOobject->bindParam(':taxes', $this->taxes);
            $PDOobject->bindParam(':total', $this->total);
            $PDOobject->execute();
            return true;
        }
        else
        {
            $sql = "CALL order_update(:customer_id, :product_id, :quantity, :price, :comments, :sub_total, :taxes, :total)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':customer_id', $this->customer_id);
            $PDOobject->bindParam(':product_id', $this->product_id);
            $PDOobject->bindParam(':quantity', $this->quantity);
            $PDOobject->bindParam(':price', $this->price);
            $PDOobject->bindParam(':comments', $this->comments);
            $PDOobject->bindParam(':sub_total', $this->sub_total);
            $PDOobject->bindParam(':taxes', $this->taxes);
            $PDOobject->bindParam(':total', $this->total);
            $PDOobject->execute();

            return true;
        }
    }
    
    public function delete()
    {
         global $connection;
         if($this->order_id != "")
        {
        $sql = "CALL order_delete(:order_id)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':order_id', $this->order_id);
            $PDOobject->execute();
            return true;
        }
    }
    
    public function searchOrdersByDate(){
        global $connection;
        $sql = "CALL order_load(:customer_id,:orderDate)";
        $PDOobject = $connection->prepare($sql);
        $PDOobject->bindParam(":customer_id", $_SESSION["customer_id"]);
        $PDOobject->bindParam(":orderDate", $orderDate);
        $PDOobject->execute();
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
