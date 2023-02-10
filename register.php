<?php
#REVISION HISTORY
#   NAME                                            DATE                        COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         18/04/2022                   created register page
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         18/04/2022                   created html account form
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         18/04/2022                   defined variables and connections
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         18/04/2022                   set condition or performed operation to register user on create

require_once './connection.php';
require_once './Classes/customer.php';
define("FOLDER_PHP2", "./Function/");
define("PHP_FILE2", FOLDER_PHP2 . "./functions.php");

include_once(PHP_FILE2);

//called pagetop function to get html code and default values
pagetop("registration Page");
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
$validateCustomer = new customer();

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
}
if (isset($_POST["submitButton"])) {

    #to read special characters like (#$%@)
    $customerUsername = htmlspecialchars($_POST["username"]);
    $customerPassword = htmlspecialchars($_POST["password"]);
    $password_hash = password_hash($customerPassword, PASSWORD_DEFAULT);
    $customerFirstname = htmlspecialchars($_POST["firstname"]);
    $customerLastname = htmlspecialchars($_POST["lastname"]);
    $customerAddress = htmlspecialchars($_POST["address"]);
    $customerCity = htmlspecialchars($_POST["city"]);
    $customerProvince = htmlspecialchars($_POST["province"]);
    $customerPostalCode = htmlspecialchars($_POST["postal_code"]);
    if ($_FILES["picture"]["error"] == UPLOAD_ERR_OK && is_uploaded_file($_FILES["picture"]["tmp_name"])) {
        $binary_file_data = file_get_contents($_FILES["picture"]["tmp_name"]);
    } else {
        $errorCustomerPicture = "Please upload a file...";
        $file_error = "No file was....";
    }
    $customerPicture = $binary_file_data;

    $validateSessionCustomer = $validateCustomer->varifySession();
    $errorCustomerUsername = $validateCustomer->setUserName($customerUsername);
    $errorCustomerPassword = $validateCustomer->setPassword($password_hash);
    $errorCustomerFirstname = $validateCustomer->setFirstName($customerFirstname);
    $errorCustomerLastname = $validateCustomer->setLastName($customerLastname);
    $errorCustomerAddress = $validateCustomer->setAddress($customerAddress);
    $errorCustomerCity = $validateCustomer->setCity($customerCity);
    $errorCustomerProvince = $validateCustomer->setProvince($customerProvince);
    $errorCustomerPostalCode = $validateCustomer->setPostalCode($customerPostalCode);
    $errorCustomerPicture = $validateCustomer->setPicture($customerPicture);

    if ($errorCustomerUsername != "" || $errorCustomerPassword != "" || $errorCustomerFirstname != "" || $errorCustomerLastname != "" || $errorCustomerAddress != "" || $errorCustomerCity != "" || $errorCustomerProvince != "" || $errorCustomerPostalCode != "") {
        $errorOccured = true;
    } else {

        $validateCustomer->save();
        $customerPicture = "";
        if (isset($_SESSION["customer_id"])) {
          echo "<script>alert('Profile Updated successfully....');</script>";
        }
        else{
            $customerUsername = "";
        $customerPassword = "";
        $customerFirstname = "";
        $customerLastname = "";
        $customerAddress = "";
        $customerCity = "";
        $customerProvince = "";
        $customerPostalCode = "";
            echo "<script>alert('Profile created successfully....');</script>";
        }
    }
}
?>
<form enctype="Multipart/form-data" class="formBuying" action="register.php" method="POST">
    <br />
    <h1 id="productHead">Registration Form </h1>

    <label id="customerForm">
        &emsp;User Name :
    </label><label class="required">*</label>
    <span class="validationError">
<?php echo $errorCustomerUsername; ?>
    </span><br />
    <input id="fieldData" type="Text" name="username" value="<?php echo $customerUsername; ?>" placeholder="&nbsp;Enter Username" />
    <br />

    <label id="customerForm">
        &emsp;Password :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerPassword; ?>
    </span><br />
    <input id="fieldData" type="password" name="password" value="<?php echo $customerPassword; ?>" placeholder="&nbsp;Enter Password" />
    <br />

    <label id="customerForm">
        &emsp;First Name :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerFirstname; ?>
    </span><br />
    <input id="fieldData" type="Text" name="firstname" value="<?php echo $customerFirstname; ?>" placeholder="&nbsp;Enter First Name" />
    <br />

    <label id="customerForm">
        &emsp;Last Name :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerLastname; ?>
    </span><br />
    <input id="fieldData" type="Text" name="lastname" value="<?php echo $customerLastname; ?>" placeholder="&nbsp;Enter Last Name" />
    <br />

    <label id="customerForm">
        &emsp;Address :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerAddress; ?>
    </span><br />
    <input id="fieldData" type="Text" name="address" value="<?php echo $customerAddress; ?>" placeholder="&nbsp;Enter Address" />
    <br />

    <label id="customerForm">
        &emsp;City :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerCity; ?>
    </span><br />
    <input id="fieldData" type="Text" name="city" value="<?php echo $customerCity; ?>" placeholder="&nbsp;Enter City" />
    <br />

    <label id="customerForm">
        &emsp;Province :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerProvince; ?>
    </span><br />
    <input id="fieldData" type="Text" name="province" value="<?php echo $customerProvince ?>" placeholder="&nbsp;Enter Province" />
    <br />

    <label id="customerForm">
        &emsp;Postal Code :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerPostalCode; ?>
    </span><br />
    <input id="fieldData" type="Text" name="postal_code" value="<?php echo $customerPostalCode; ?>" placeholder="&nbsp;Enter Postal Code" />
    <br />

    <label id="customerForm">
        &emsp;Picture :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCustomerPicture; ?>
    </span><br />
    <input id="fieldData" type="file" name="picture" value="picture" placeholder="&nbsp;Enter Picture" />
    <br />

    <button type="submit" name="submitButton" class="registerbtn"">CREATE PROFILE</button>
    <br />
    <button type="reset" value="Clearallfields" class="registerbtn">RESET</button>
    <br />
    <a href="index.php" id="previous">&laquo; Home</a>
</form>
<?php
pageBottom();
?>
