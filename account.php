<?php
#REVISION HISTORY
#   NAME                                            DATE                        COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         18/04/2022                   created account page
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         18/04/2022                   created html account form
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         18/04/2022                   defined variables and connections
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         18/04/2022                   set condition or performed operation to register user on create
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         19/04/2022                   implimented update user details on same page                   

#declared required(mendatory) connections
require_once './connection.php';
require_once './Classes/customer.php';
#declared  or defined the constants to fetch data from common php function file
#give path for folder
define("FOLDER_PHP2", "./Function/");
#give path to access file inside the folder
define("PHP_FILE2", FOLDER_PHP2 . "./functions.php");
include_once(PHP_FILE2);

#called pagetop function to get html code and default values inside function file
pagetop("User Profile Page");
#varibale declaration
$customerUsername = "";
$customerPassword = "";
$customerFirstname = "";
$customerLastname = "";
$customerAddress = "";
$customerCity = "";
$customerProvince = "";
$customerPostalCode = "";
$customerPicture = "";
$errorCustomerUsername = "";
$errorCustomerPassword = "";
$errorCustomerFirstname = "";
$errorCustomerLastname = "";
$errorCustomerAddress = "";
$errorCustomerCity = "";
$errorCustomerProvince = "";
$errorCustomerPostalCode = "";
$errorCustomerPicture = "";
$errorCustomerOccured = false;
$binary_file_data = null;
$file_error = "";

#set condition to update user details by his/her id(customer id)
if (isset($_SESSION["customer_id"])) {
    $validateCustomer->load($_SESSION["customer_id"]);
    $customerUsername = $validateCustomer->getUserName();
    $customerPassword = $validateCustomer->getPassword();
    $customerFirstname = $validateCustomer->getFirstName();
    $customerLastname = $validateCustomer->getLastName();
    $customerAddress = $validateCustomer->getAddress();
    $customerCity = $validateCustomer->getCity();
    $customerProvince = $validateCustomer->getProvince();
    $customerPostalCode = $validateCustomer->getPostalCode();
    $customerPicture = $validateCustomer->getPicture();
    ?>
<!--showing message to user about his profile--> 
    <script>
        alert("Profile updated successfully....");
    </script>
    <?php
}
#put condition to create new profile for user
if (isset($_POST["submitButton"])) {
    #htmlspecialchars to read special characters like (#$%@)
    #assigned user entered data into variables
    $customerUsername = htmlspecialchars($_POST["username"]);
    $customerPassword = htmlspecialchars($_POST["password"]);
    $password_hash = password_hash($customerPassword, PASSWORD_DEFAULT);
    $customerFirstname = htmlspecialchars($_POST["firstname"]);
    $customerLastname = htmlspecialchars($_POST["lastname"]);
    $customerAddress = htmlspecialchars($_POST["address"]);
    $customerCity = htmlspecialchars($_POST["city"]);
    $customerProvince = htmlspecialchars($_POST["province"]);
    $customerPostalCode = htmlspecialchars($_POST["postal_code"]);
    #put condition to get picture which uploaded by the user and also set messages for user whether
    #picture uploaded or not
    if ($_FILES["picture"]["error"] == UPLOAD_ERR_OK && is_uploaded_file($_FILES["picture"]["tmp_name"])) {
        $binary_file_data = file_get_contents($_FILES["picture"]["tmp_name"]);
    } else {
        $errorCustomerPicture = "Please upload a file...";
        $file_error = "No file was....";
    }
    #assigned that image into variable
    $customerPicture = $binary_file_data;
    #created object of customer class
    $validateCustomer = new customer();
    #called load function to get user details using $_SESSION variable
    if ($validateCustomer->load($_SESSION["customer_id"])) {
        #set all the data entered by the user into setter method of class customer and 
        #after that assigned that date to variable
        $errorCustomerUsername = $validateCustomer->setUserName($customerUsername);
        $errorCustomerPassword = $validateCustomer->setPassword($password_hash);
        $errorCustomerFirstname = $validateCustomer->setFirstName($customerFirstname);
        $errorCustomerLastname = $validateCustomer->setLastName($customerLastname);
        $errorCustomerAddress = $validateCustomer->setAddress($customerAddress);
        $errorCustomerCity = $validateCustomer->setCity($customerCity);
        $errorCustomerProvince = $validateCustomer->setProvince($customerProvince);
        $errorCustomerPostalCode = $validateCustomer->setPostalCode($customerPostalCode);
        $errorCustomerPicture = $validateCustomer->setPicture($customerPicture);

        if ($errorCustomerUsername != "" || $errorCustomerPassword != "" || $errorCustomerFirstname != "" || $errorCustomerLastname != "" || $errorCustomerAddress != "" || $errorCustomerCity != "" || $errorCustomerProvince != "" || $errorCustomerPostalCode != "" || $errorCustomerPicture != "") {
            $errorOccured = true;
        } else {
            ?>
            <script>
                alert("Profile update successfully....");
            </script>

            <?php
            $validateCustomer->save();
            $customerUsername = "";
            $customerPassword = "";
            $customerFirstname = "";
            $customerLastname = "";
            $customerAddress = "";
            $customerCity = "";
            $customerProvince = "";
            $customerPostalCode = "";
            $customerPicture = "";
        }
    } else {
        echo "unable.........";
    }
}
//    $connection = null;
?>

<form enctype="Multipart/form-data" class="formBuying" action="./account.php" method="POST">
    <br />
<?php // $validateCustomer = new customer();
//$new = $validateCustomer->load($_SESSION["customer_id"]);
?>
    <h1 id="productHead">Account Form </h1>
    <label id="customerForm">
        &emsp;User Name :
    </label><label class="required">*</label>
    <br />
    <input id="fieldData" type="Text" name="username" value="<?php
    if ($new) {
        echo $validateCustomer->getUserName();
    } else {
        echo "unable.........";
    }
    ?>" />
    <br />

    <label id="customerForm">
        &emsp;Password :
    </label><label class="required">*</label>
    <span class="validationError">
           <?php echo $errorCustomerPassword; ?>
    </span><br />
    <input id="fieldData" type="password" name="password" value="<?php
           if ($new) {
               echo $validateCustomer->getPassword();
           } else {
               echo "unable.........";
           }
           ?>" />
    <br />

    <label id="customerForm">
        &emsp;First Name :
    </label><label class="required">*</label>
    <span class="validationError">
<?php echo $errorCustomerFirstname; ?>
    </span><br />
    <input id="fieldData" type="Text" name="firstname" value="<?php
if ($new) {
    echo $validateCustomer->getFirstName();
} else {
    echo "unable.........";
}
?>" />
    <br />

    <label id="customerForm">
        &emsp;Last Name :
    </label><label class="required">*</label>
    <span class="validationError">
<?php echo $errorCustomerLastname; ?>
    </span><br />
    <input id="fieldData" type="Text" name="lastname" value="<?php
if ($new) {
    echo $validateCustomer->getLastName();
} else {
    echo "unable.........";
}
?>" />
    <br />

    <label id="customerForm">
        &emsp;Address :
    </label><label class="required">*</label>
    <span class="validationError">
<?php echo $errorCustomerAddress; ?>
    </span><br />
    <input id="fieldData" type="Text" name="address" value="<?php
if ($new) {
    echo $validateCustomer->getAddress();
} else {
    echo "unable.........";
}
?>" />
    <br />

    <label id="customerForm">
        &emsp;City :
    </label><label class="required">*</label>
    <span class="validationError">
<?php echo $errorCustomerCity; ?>
    </span><br />
    <input id="fieldData" type="Text" name="city" value="<?php
        if ($new) {
            echo $validateCustomer->getCity();
        } else {
            echo "unable.........";
        }
        ?>"/>
    <br />

    <label id="customerForm">
        &emsp;Province :
    </label><label class="required">*</label>
    <span class="validationError">
<?php echo $errorCustomerProvince; ?>
    </span><br />
    <input id="fieldData" type="Text" name="province" value="<?php
if ($new) {
    echo $validateCustomer->getProvince();
} else {
    echo "unable.........";
}
?>" />
    <br />

    <label id="customerForm">
        &emsp;Postal Code :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerPostalCode; ?>
    </span><br />
    <input id="fieldData" type="Text" name="postal_code" value="<?php
        if ($new) {
            echo $validateCustomer->getPostalCode();
        } else {
            echo "unable.........";
        }
        ?>" />
    <br />

    <label id="customerForm">
        &emsp;Picture :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerPicture; ?>
    </span><br />
    <input id="fieldData" type="file" name="picture" value="<?php
    if ($new) {
        echo $validateCustomer->getPicture();
    } else {
        echo "unable.........";
    }
    ?>"/>
    <br />

    <button type="submit" name="submitButton" class="registerbtn"">SAVE</button>
    <br />

    <a href="index.php" id="previous">&laquo; Home</a>
    <a href="order.php" id="next">Order Page &raquo;</a>
</form>
<?php
pageBottom();
?>