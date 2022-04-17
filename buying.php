<?php
#Revision History
#
#DEVELOPER                                         DATE                            COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         28/02/2022           created buying.php file
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           defined constants/variables
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           created form for details
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           wrote php function/conditions to check user details are in correct formate or not.
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           applied css on form fields
//declaration of constant
define("FOLDER_PHP1", "./Function/");
define("PHP_FILE1", FOLDER_PHP1 . "./functions.php");
include_once(PHP_FILE1);
//called pagetop function to get html code and default values
pagetop("Buying Page");
#varibale declaration
$productCode = "";
$firstName = "";
$lastName = "";
$city = "";
$price = "";
$quantity = "";
$orders = "";
$taxes = "";
$grandTotal = "";
$subTotal = "";
$comment = "";
$errorProductCode = "";
$errorFirstName = "";
$errorLastName = "";
$errorCity = "";
$errorPrice = "";
$errorQuantity = "";
$errorOccured = false;
$errorComment = "";

#conditions to validate user inputs for form
if (isset($_POST["submitButton"])) {

    #to read special characters like (#$%@)
    $productCode = htmlspecialchars($_POST["productcode"]);
    $firstName = htmlspecialchars($_POST["firstname"]);
    $lastName = htmlspecialchars($_POST["lastname"]);
    $city = htmlspecialchars($_POST["city"]);
    $comment = htmlspecialchars($_POST["comment"]);
    $price = htmlspecialchars($_POST["price"]);
    $quantity = htmlspecialchars($_POST["quantity"]);

    #PRODUCT CODE validations as below
    if (mb_strlen($productCode) == 0) {
        $errorOccured = true;
        $errorProductCode = "INVALID!...PRODUCT CODE CAN'T BE EMPTY...";
    } else {
        if (mb_strlen($productCode) > PRODUCTCODE_MAXIMUM_LENGTH) {
            $errorOccured = true;
            $errorProductCode = "OPS!...THE PRODUCT CODE CAN'T CONTAIN MORE THAN  " . PRODUCTCODE_MAXIMUM_LENGTH . " CHARACTERS IT SHOULD BE BETWEEN 1-12 CHARACTERS...";
        } else {

            if (!($productCode[0] == 'p' || $productCode[0] == 'P')) {
                $errorOccured = true;
                $errorProductCode = "OPS!...IT NOT A VALID INPUT TO START A PRODUCT CODE. IT MUST START FROM (P) OR (p)...";
            }
        }
    }

    #FIRST NAME validations as below
    if (mb_strlen($firstName) == 0) {
        $errorOccured = true;
        $errorFirstName = "INVALID!...FIRST NAME CAN'T BE EMPTY...";
    } else {
        if (mb_strlen($firstName) > FIRSTNAME_MAXIMUM_LENGTH) {
            $errorOccured = true;
            $errorFirstName = "OPS!...THE FIRST NAME CAN'T CONTAIN MORE THAN 20 CHARACTERS IT SHOULD BE BETWEEN 1-20 CHARACTERS...";
        }
    }

    #LAST NAME validations as below
    if (mb_strlen($lastName) == 0) {
        $errorOccured = true;
        $errorLastName = "INVALID!...LAST NAME CAN'T BE EMPTY...";
    } else {
        if (mb_strlen($lastName) > LASTNAME_MAXIMUM_LENGTH) {
            $errorOccured = true;
            $errorLastName = "OPS!...THE LAST NAME CAN'T CONTAIN MORE THAN 20 CHARACTERS IT SHOULD BE BETWEEN 1-20 CHARACTERS...";
        }
    }

    #CITY validations as below
    if (mb_strlen($city) == 0) {
        $errorOccured = true;
        $errorCity = "INVALID!...CITY CAN'T BE EMPTY...";
    } else {
        if (mb_strlen($city) > CITY_MAXIMUM_LENGTH) {
            $errorOccured = true;
            $errorCity = "OPS!...THE CITY CAN'T CONTAIN MORE THAN 8 CHARACTERS IT SHOULD BE BETWEEN 1-8 CHARACTERS...";
        }
    }

    #COMMENT BOX validations as below
    if (mb_strlen($comment) > COMMENTBOX_MAXIMUM_LENGTH) {
        $errorOccured = true;
        $errorComment = "OPS!...THE COMMENT BOX CAN CONTAIN UPTO " . COMMENTBOX_MAXIMUM_LENGTH . " CHARACTERS ONLY...";
    }

    #PRICE validations as below
    if (!(is_numeric($price))) {
        $errorOccured = true;
        $errorPrice = "OPS!...THE PRICE MUST BE A NUMERIC VALUE IT CAN NOT CONTAIN ANY CHARACTER OR SPECIAL CHARACTERS...";
    } else {
        if ($price < 0) {
            $errorOccured = true;
            $errorPrice = "INVALID!...YOU CAN NOT ENTER NEGATIVE VALUE FOR PRICE...";
        } else {
            if ($price > PRICE_MAXIMUM) {
                $errorOccured = true;
                $errorPrice = "OPS!... YOU ARE NOT ALLOWED TO ENTER PRICE MORE THAN " . PRICE_MAXIMUM . "$";
            }
        }
    }


// QUANTITY validation as below
    if (!(is_numeric($quantity))) {
        $errorOccured = true;
        $errorQuantity = "OPS!...THE QUANTITY MUST BE A NUMERIC VALUE IT CAN NOT CONTAIN ANY CHARACTER OR SPECIAL CHARACTERS...";
    } else {
        if (mb_strpos($quantity, ".") || mb_strpos($quantity, ",")) {
            $errorOccured = true;
            $errorQuantity = "OPS!...QUANTITY CAN'T BE IN DECIMAL, IT SHOULD ALWAYS AS AN INTEGER...";
        } else {
            if ($quantity < QUANTITY_MINIMUM || $quantity > QUANTITY_MAXIMUM) {
                $errorOccured = true;
                $errorQuantity = "ERROR....QUANTTY SHOULD BE BETWEEN " . QUANTITY_MINIMUM . " AND " . QUANTITY_MAXIMUM;
            }
        }
    }

#make sure no error occured
#condition / operation if no error occurs
    if ($errorOccured == false) {

        $subTotal = (float) $price * (float) $quantity;
        $taxes = $subTotal * LOCAL_TAX / 100;
        $grandTotal = round($subTotal + $taxes, 2);
        $orders = array($productCode, $firstName, $lastName, $city, $comment, $price, $quantity, $subTotal, $taxes, $grandTotal);
        #using JASONString convert array into string
        $JSONstring = json_encode($orders);
        $allOrderData = json_decode($JSONstring);
        //$allOrderData[0];
        // open and append into the file
        $fileHandle = fopen(File_TEXT1, "a");
        // write in file
        fwrite($fileHandle, $JSONstring . "\n");
        fclose($fileHandle);

        $productCode = "";
        $firstName = "";
        $lastName = "";
        $city = "";
        $price = "";
        $quantity = "";

        echo "Your order has been placed!.........";
//        header("Location: order.php");
    }
}
?>



<form class="formBuying" action="./buying.php" method="POST">
    <br />
    <h1 id="productHead">Product Form </h1>
    
    <label id="customerForm">
        &emsp;Product Code :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorProductCode; ?>
    </span><br />
    <input id="fieldData" type="Text" name="productcode" value="<?php echo $productCode; ?>" placeholder="&nbsp;Enter Product Code" />

<br />
    <label id="customerForm">
        &emsp;Customer First Name :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorFirstName; ?>
    </span><br />
    <input id="fieldData" type="Text" name="firstname" value="<?php echo $firstName; ?>" placeholder="&nbsp;Enter First Name" />
<br />
    <label id="customerForm">
        &emsp;Customer Last Name :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorLastName; ?>
    </span><br />
    <input id="fieldData" type="Text" name="lastname" value="<?php echo $lastName; ?>" placeholder="&nbsp;Enter Last Name" />

<br />
    <label id="customerForm">
        &emsp;Customer City :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorCity; ?>
    </span><br />
    <input id="fieldData" type="Text" name="city" value="<?php echo $city; ?>" placeholder="&nbsp;Enter City" />

<br />
    <label id="customerForm">
        &emsp;Comment :
    </label>
    <span class="validationError">
        <?php echo $errorComment; ?>
    </span><br />
    <input id="fieldData" type="Text" name="comment" value="<?php echo $comment ?>" placeholder="&nbsp;Enter Comments" />
<br />
    <label id="customerForm">
        &emsp;Price :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorPrice; ?>
    </span><br />
    <input id="fieldData" type="Text" name="price" value="<?php echo $price; ?>" placeholder="&nbsp;Enter Price" />

<br />
    <label id="customerForm">
        &emsp;Quantity :
    </label><label class="required">*</label>
    <span class="validationError">
        <?php echo $errorQuantity; ?>
    </span><br />
    <input id="fieldData" type="Text" name="quantity" value="<?php echo $quantity; ?>" placeholder="&nbsp;Enter Quantity" />
<br />
    <button type="submit" name="submitButton" class="registerbtn" onclick="myFunction()">SAVE</button>
    <br />
    <button type="submit" value="Clear all fields" class="registerbtn">RESET</button>
    <br />
    <a href="index.php" id="previous">&laquo; Home</a>
<a href="order.php" id="next">Order Page &raquo;</a>
</form>
<?php
pageBottom();
?>
