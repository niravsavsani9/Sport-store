<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of product
 *
 * @author savsa
 */
class product {
    //put your code here
    #create constant
    const PRODUCT_CODE_LENGHT = 12;
    const PRODUCT_DESCRIPTION_LENGHT = 100;
    const RETAIL_PRICE_LENGHT = 10;
    const COST_PRICE_LENGHT = 10;


    private $product_id = "";
    private $product_Code = "";
    private $product_description = "";
    private $retail_price = "";
    private $cost_price = "";
    
    public function getProductCode() {
        return $this->product_Code;
    }
    public function getProductDescription() {
        return $this->product_description;
    }
    public function getRetailPrice() {
        return $this->retail_price;
    }
    public function getCostPrice() {
        return $this->cost_price;
    }

    public function setProductCode($newProductCode) {
        if (mb_strlen($newProductCode) == 0) {
            return "The product code........... empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newProductCode) > self::PRODUCT_CODE_LENGHT) {
                return "The lenght of product code............error!";
            } else {
                $this->product_Code = $newProductCode;
            }
        }
    }
    
    public function setProductDescription($newProductDescription) {
        if (mb_strlen($newProductDescription) == 0) {
            return "The product description........... empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newProductDescription) > self::PRODUCT_DESCRIPTION_LENGHT) {
                return "The lenght of product description............error!";
            } else {
                $this->product_description = $newProductDescription;
            }
        }
    }
    
    public function setReatilPrice($newRetailPrice) {
        if (mb_strlen($newRetailPrice) == 0) {
            return "The retail price...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newRetailPrice) > self::RETAIL_PRICE_LENGHT) {
                return "The lenght of retail price............error!";
            } else {
                $this->retail_price = $newRetailPrice;
            }
        }
    }
    
     public function setCostPrice($newCostPrice) {
        if (mb_strlen($newCostPrice) == 0) {
            return "The cost price...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newCostPrice) > self::COST_PRICE_LENGHT) {
                return "The lenght of cost price............error!";
            } else {
                $this->cost_price = $newCostPrice;
            }
        }
    }
    
    
    
    public function __construct($product_code = "", $product_description = "", $retail_price = "", $cost_price = "") {
        if ($product_code != "" || $product_description != "" || $retail_price != "" || $cost_price != "") {
            $this->setProductCode($product_code);
            $this->setProductDescription($product_description);
            $this->setReatilPrice($retail_price);
            $this->setCostPrice($cost_price);
        }
    }
    
    #get data from database
    public function load($product_id){
        global $connection;
        $sql = "SELECT * FROM products WHERE product_id "
                . " = :product_id";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->bindParam(':product_id', $product_id);
        $PDOobject->execute();
        if($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
        $this->product_id = $row["product_id"];
        $this->product_Code = $row["product_Code"];
        $this->product_description = $row["product_description"];
        $this->retail_price = $row["retail_price"];
        $this->cost_price = $row["cost_price"];
        return true;
        } 
    }
    
    public function save()
    {
        global $connection;
        if($this->customer_id == "")
        {
            $sql = "CALL mystoreprocedure(:product_Code, :product_description, :retail_price, :cost_price)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':product_id', $this->product_id);
            $PDOobject->bindParam(':product_Code', $this->product_Code);
            $PDOobject->bindParam(':product_description', $this->product_description);
            $PDOobject->bindParam(':retail_price', $this->retail_price);
            $PDOobject->bindParam(':cost_price', $this->cost_price);
            $PDOobject->execute();
        
            return true;
        }
        else
        {
            $sql = "CALL mystoreprocedure(product_Code = :product_Code, product_description = :product_description, retail_price = :retail_price, cost_price = :cost_price";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':product_id', $this->product_id);
            $PDOobject->bindParam(':product_Code', $this->product_Code);
            $PDOobject->bindParam(':product_description', $this->product_description);
            $PDOobject->bindParam(':retail_price', $this->retail_price);
            $PDOobject->bindParam(':cost_price', $this->cost_price);
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
