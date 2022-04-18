<?php
require_once ('../Classes/customer.php');
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
    const QUANTITY_LENGHT = 3;
    const PRICE_LENGHT = 10;
    const COMMENTS_LENGHT = 200;


    private $order_id = "";
    private $customer_id = "";
    private $product_id = "";
    private $quantity = "";
    private $price = "";
    private $comments = "";
    
   
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
        } else {
            #access created constants using self as below
            if (mb_strlen($newQuantity) > self::QUANTITY_LENGHT) {
                return "The lenght of quantity............error!";
            } else {
                $this->quantity = $newQuantity;
            }
        }
    }
    
    public function setPrice($newPrice) {
        if (mb_strlen($newPrice) == 0) {
            return "The price...........empty";
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
        if (mb_strlen($newComments) == 0) {
            return "The comments...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newComments) > self::COMMENTS_LENGHT) {
                return "The lenght of comments............error!";
            } else {
                $this->comments = $newComments;
            }
        }
    }
    
    
    
    public function __construct($customer_id = "", $product_id = "", $quantity = "", $price = "", $comments = "") {
        if ($customer_id != "" || $product_id != "" || $quantity != "" || $price != "" || $comments != "" ) {
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
        $sql = "SELECT * FROM orders WHERE order_id "
                . " = :order_id";
        
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
        if($this->customer_id == "")
        {
            $sql = "CALL mystoreprocedure(:customer_id, :product_id, :quantity, :price, :comments)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':customer_id', $this->customer_id);
            $PDOobject->bindParam(':product_id', $this->product_id);
            $PDOobject->bindParam(':quantity', $this->quantity);
            $PDOobject->bindParam(':price', $this->price);
            $PDOobject->bindParam(':comments', $this->comments);
            $PDOobject->execute();
        
            return true;
        }
        else
        {
            $sql = "CALL mystoreprocedure(customer_id = :customer_id, product_id = :product_id, quantity = :quantity, price = :price"
                    . " comments = :comments)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':customer_id', $this->customer_id);
            $PDOobject->bindParam(':product_id', $this->product_id);
            $PDOobject->bindParam(':quantity', $this->quantity);
            $PDOobject->bindParam(':price', $this->price);
            $PDOobject->bindParam(':comments', $this->comments);
            $PDOobject->execute();

            return true;
        }
    }
    
    public function delete()
    {
         global $connection;
         if($this->customer_id != "")
        {
        $sql = "CALL mystoreprocedure(order_id = :order_id)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':order_id', $this->order_id);
            $PDOobject->execute();
            return true;
        }
    }
}
