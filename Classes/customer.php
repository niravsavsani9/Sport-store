<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of customer
 *
 * @author savsa
 */
class customer {
    //put your code here
    #create constant
    const USERNAME_LENGHT = 15;
    const PASSWORD_LENGHT = 255;
    const FIRSTNAME_LENGHT = 20;
    const LASTNAME_LENGHT = 20;
    const ADDRESS_LENGHT = 25;
    const CITY_LENGHT = 25;
    const PROVINCE_LENGHT = 25;
    const POSTAL_CODE_LENGHT = 25;
    const PICTURE_LENGHT = 16000000;


    private $customer_id = "";
    private $username = "";
    private $password = "";
    private $firstname = "";
    private $lastname = "";
    private $address = "";
    private $city = "";
    private $province = "";
    private $postal_code = "";
    private $picture = "";
    
    public function getUserName() {
        return $this->username;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getFirstName() {
        return $this->firstname;
    }
    public function getLastName() {
        return $this->lastname;
    }
    public function getAddress() {
        return $this->address;
    }
    public function getCity() {
        return $this->city;
    }
    public function getProvince() {
        return $this->province;
    }
    public function getPostalCode() {
        return $this->postal_code;
    }
    public function getPicture() {
        return $this->picture;
    }
    
    public function setUserName($newUserName) {
        if (mb_strlen($newUserName) == 0) {
            return "The username........... empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newUserName) > self::USERNAME_LENGHT) {
                return "The lenght of username............error!";
            } else {
                $this->username = $newUserName;
            }
        }
    }
    
    public function setPassword($newPassword) {
        if (mb_strlen($newPassword) == 0) {
            return "The password........... empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newPassword) > self::PASSWORD_LENGHT) {
                return "The lenght of password............error!";
            } else {
                $this->password = $newPassword;
            }
        }
    }
    
    public function setFirstName($newFirstName) {
        if (mb_strlen($newFirstName) == 0) {
            return "The firstname...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newFirstName) > self::FIRSTNAME_LENGHT) {
                return "The lenght of firstname............error!";
            } else {
                $this->firstname = $newFirstName;
            }
        }
    }
    
    public function setLastName($newLastName) {
        if (mb_strlen($newLastName) == 0) {
            return "The lastname...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newLastName) > self::LASTNAME_LENGHT) {
                return "The lenght of lastname............error!";
            } else {
                $this->lastname = $newLastName;
            }
        }
    }
    
    public function setAddress($newAddress) {
        if (mb_strlen($newAddress) == 0) {
            return "The address...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newAddress) > self::ADDRESS_LENGHT) {
                return "The lenght of address............error!";
            } else {
                $this->address = $newAddress;
            }
        }
    }
    
    public function setCity($newCity) {
        if (mb_strlen($newCity) == 0) {
            return "The city...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newCity) > self::CITY_LENGHT) {
                return "The lenght of city............error!";
            } else {
                $this->city = $newCity;
            }
        }
    }
    
    public function setProvince($newProvince) {
        if (mb_strlen($newProvince) == 0) {
            return "The province...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newProvince) > self::PROVINCE_LENGHT) {
                return "The lenght of province............error!";
            } else {
                $this->province = $newProvince;
            }
        }
    }
    
    public function setPostalCode($newPostalCode) {
        if (mb_strlen($newPostalCode) == 0) {
            return "The PostalCode...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newPostalCode) > self::POSTAL_CODE_LENGHT) {
                return "The lenght of PostalCode............error!";
            } else {
                $this->postal_code = $newPostalCode;
            }
        }
    }
    
    public function setPicture($newPicture) {
        if (mb_strlen($newPicture) == 0) {
            return "The picture...........empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newPicture) > self::PICTURE_LENGHT) {
                return "The lenght of picture............error!";
            } else {
                $this->picture = $newPicture;
            }
        }
    }
    
    public function __construct($firstname = "", $lastname = "", $address = "", $city = "", $province = "", $postal_code = "", $picture = "") {
        if ($firstname != "" || $lastname != "" || $address != "" || $city != "" || $province != "" || $postal_code != "" || $picture != "") {
            $this->setFirstName($firstname);
            $this->setLastName($lastname);
            $this->setAddress($address);
            $this->setCity($city);
            $this->setProvince($province);
            $this->setPostalCode($postal_code);
            $this->setPicture($picture);
        }
    }
    
    #get data from database
    public function load($customer_id){
        global $connection;
        $sql = "SELECT * FROM customers WHERE customer_id "
                . " = :customer_id";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->bindParam(':employee_id', $customer_id);
        $PDOobject->execute();
        if($row = $PDOobject->fetch(PDO::FETCH_ASSOC))
        {
        $this->customer_id = $row["customer_id"];
        $this->username = $row["username"];
        $this->password = $row["password"];
        $this->firstname = $row["firstname"];
        $this->lastname = $row["lastname"];
        $this->address = $row["address"];
        $this->city = $row["city"];
        $this->province = $row["province"];
        $this->postal_code = $row["postal_code"];
        $this->picture = $row["picture"];
        
        return true;
        } 
    }
    
    public function save()
    {
        global $connection;
        if($this->customer_id == "")
        {
            $sql = "CALL mystoreprocedure(:username, :password, :firstname, :lastname, :address, :city, :province, :postal_code, picture = :picture)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':customer_id', $this->customer_id);
            $PDOobject->bindParam(':username', $this->username);
            $PDOobject->bindParam(':password', $this->password);
            $PDOobject->bindParam(':firstname', $this->firstname);
            $PDOobject->bindParam(':lastname', $this->lastname);
            $PDOobject->bindParam(':address', $this->address);
            $PDOobject->bindParam(':city', $this->city);
            $PDOobject->bindParam(':province', $this->province);
            $PDOobject->bindParam(':postal_code', $this->postal_code);
            $PDOobject->bindParam(':picture', $this->picture);
            $PDOobject->execute();
        
            return true;
        }
        else
        {
            $sql = "CALL mystoreprocedure(username = :username, password = :password, firstname = :firstname, lastname = :lastname"
                    . " address = :address, city = :city, province = :province, postal_code = :postal_code)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':customer_id', $this->customer_id);
            $PDOobject->bindParam(':username', $this->username);
            $PDOobject->bindParam(':password', $this->password);
            $PDOobject->bindParam(':firstname', $this->firstname);
            $PDOobject->bindParam(':lastname', $this->lastname);
            $PDOobject->bindParam(':address', $this->address);
            $PDOobject->bindParam(':city', $this->city);
            $PDOobject->bindParam(':province', $this->province);
            $PDOobject->bindParam(':postal_code', $this->postal_code);
            $PDOobject->execute();

            return true;
        }
    }
    
    public function delete()
    {
         global $connection;
         if($this->customer_id != "")
        {
        $sql = "CALL mystoreprocedure(customer_id = :customer_id)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':customer_id', $this->customer_id);
            $PDOobject->execute();
            return true;
        }
    }
    
    
}
