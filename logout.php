<?php
#REVISON HISTORY
#       NAME                                        DATE                        COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         23/04/2022                      created logout page
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         23/03/2022                      implimented logout html form
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         23/03/2022                      did session_destroy when user press logout button

#declared required(mendatory) connections
require_once './connection.php';
require_once './Classes/customer.php';
#declared  or defined the constants to fetch data from common php function file
#gave path for folder
define("FOLDER_PHP1", "./Function/");
define("PHP_FILE1", FOLDER_PHP1 . "./functions.php");
#included the file to fetch all the code which is inside the file.
include_once(PHP_FILE1);
#called pagetop function to get html code and default values
pagetop("Logout Page");

?>

<form method="post">
    <?php 
    #created object of customer
    $username1 = new customer();
    if (isset($_POST["logout"])) {
            echo "<script>alert('Logged out Successfully');</script>";
            echo "<script>alert('Once again logout for complete logout');</script>";
            session_destroy();
        }
    if(!empty($_SESSION["customer_id"]))
    { 
    ?>
    <h4 id="productHead" >Do You Really want to logout ?</h4>
    <input type="submit" class="registerbtn" value="Logout" name="logout" />
    
    <?php
    }
    ?>
</form>