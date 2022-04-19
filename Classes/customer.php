<?php
//require_once './order.php';
//require_once './customers.php';
//require_once './product.php';
//require_once '../connection.php';
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
    public function getCustomerId() {
        return $this->customer_id;
    }
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
    
    public function varifySession(){
//            $validateCustomer = new customer();
        if (isset($_SESSION["cutomerSession"]))
        {
            if (!empty($_SESSION["cutomerSession"]))
            {
                $validateCustomer->setCustomerId($_SESSION["cutomerSession"]);
            }
        }
    }
    
    public function setCustomerId($newCustomer_id)
    {
        if(mb_strlen($newCustomer_id) != 0)
        {
            $this->customer_id = $newCustomer_id;
        }
        else
        {
            return "Customer Id (Primary key) missing....";
        }
        
    }
    
    public function setUserName($newUserName) {
        if (mb_strlen($newUserName) == 0) {
            return "The username can not be empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newUserName) > self::USERNAME_LENGHT) {
                return "The maximum lenght of username is " . self::USERNAME_LENGHT . " characters";
            } else {
                $this->username = $newUserName;
                
            }
        }
    }
    
    public function setPassword($newPassword) {
        if (mb_strlen($newPassword) == 0) {
            return "The password can not be empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newPassword) > self::PASSWORD_LENGHT) {
                return "The maximum lenght of password is " . self::PASSWORD_LENGHT . " characters";
            } else {
                $this->password = $newPassword;
            }
        }
    }
    
    public function setFirstName($newFirstName) {
        if (mb_strlen($newFirstName) == 0) {
            return "The first name can not be empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newFirstName) > self::FIRSTNAME_LENGHT) {
                return "The maximum lenght of first name is " . self::FIRSTNAME_LENGHT . " characters";
            } else {
                $this->firstname = $newFirstName;
            }
        }
    }
    
    public function setLastName($newLastName) {
        if (mb_strlen($newLastName) == 0) {
            return "The last name can not be empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newLastName) > self::LASTNAME_LENGHT) {
                return "The maximum lenght of last name is " . self::LASTNAME_LENGHT . " characters";
            } else {
                $this->lastname = $newLastName;
            }
        }
    }
    
    public function setAddress($newAddress) {
        if (mb_strlen($newAddress) == 0) {
            return "The address can not be empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newAddress) > self::ADDRESS_LENGHT) {
                return "The maximum lenght of address is " . self::ADDRESS_LENGHT . " characters";
            } else {
                $this->address = $newAddress;
            }
        }
    }
    
    public function setCity($newCity) {
        if (mb_strlen($newCity) == 0) {
            return "The city can not be empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newCity) > self::CITY_LENGHT) {
                return "The maximum lenght of city is " . self::CITY_LENGHT . " characters";
            } else {
                $this->city = $newCity;
            }
        }
    }
    
    public function setProvince($newProvince) {
        if (mb_strlen($newProvince) == 0) {
            return "The province can not be empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newProvince) > self::PROVINCE_LENGHT) {
                return "The maximum lenght of province is " . self::PROVINCE_LENGHT . " characters";
            } else {
                $this->province = $newProvince;
            }
        }
    }
    
    public function setPostalCode($newPostalCode) {
        if (mb_strlen($newPostalCode) == 0) {
            return "The postal code can not be empty";
        } else {
            #access created constants using self as below
            if (mb_strlen($newPostalCode) > self::POSTAL_CODE_LENGHT) {
                return "The maximum lenght of postal code is " . self::POSTAL_CODE_LENGHT . " characters";
            } else {
                $this->postal_code = $newPostalCode;
            }
        }
    }
    
    public function setPicture($newPicture) {
        if($newPicture == "")
        {
           return "Upload picture"; 
        }else{
                $this->picture = $newPicture;
        }
            
    }
    
    public function __construct($customer_id = "", $username = "", $password = "" ,$firstname = "", $lastname = "", $address = "", $city = "", $province = "", $postal_code = "", $picture = "") {
        if ($customer_id != "" || $username != "" || $password != "" || $firstname != "" || $lastname != "" || $address != "" || $city != "" || $province != "" || $postal_code != "" || $picture != "") {
            $this->customer_id($customer_id);
            $this->username($username);
            $this->password($password);
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
        $sql = "CALL customer_select_one(:customer_id)";
        
        $PDOobject = $connection->prepare($sql);
        $PDOobject->bindParam(':customer_id', $customer_id);
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
            $sql = "CALL customer_insert(:username, :password, :firstname, :lastname, :address, :city, :province, :postal_code, :picture)";
            $PDOobject = $connection->prepare($sql);
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
            $sql = "CALL customer_update(:username, :password, :firstname, :lastname"
                    . " :address, :city, :province, :postal_code, :picture)";
            
//            $sql = "UPDATE customers set username = :username,"
//                    . "password = :password, firstname = :firstname,"
//                    . "lastname = :lastname, address = :address,"
//                    . "city = :city, province = :province, postal_code = :postal_code,"
//                    . "picture = :picture WHERE customer_id = :customer_id;";
            $PDOobject = $connection->prepare($sql);
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
    }
    
    public function delete()
    {
         global $connection;
         if($this->customer_id != "")
        {
        $sql = "CALL customer_delete(:customer_id)";
            $PDOobject = $connection->prepare($sql);
            $PDOobject->bindParam(':customer_id', $this->customer_id);
            $PDOobject->execute();
            return true;
        }
    }
    
    public function customerLogin($newUsername, $newPassword){
        global $connection;
        $sql = "CALL login (:username, :password)";
        $PDOobject = $connection->prepare($sql);
        $PDOobject->bindParam(':username', $newUsername);
        $PDOobject->bindParam(':password', $newPassword);
        $PDOobject->execute();
        while($row = $PDOobject->fetch()) {
                $passwordHash = $row['password'];
                $correctPassword = password_verify($newPassword, $passwordHash);
                if($correctPassword == false) {
                    $_SESSION['customer_id'] = $row['customer_id'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['picture'] = $row['picture'];
                    return "";
                } else {
                    return "incorrect......";
                }
            }
    }
}
?>
