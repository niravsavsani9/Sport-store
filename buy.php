<?php

#Revision History
#
#DEVELOPER                                         DATE                            COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      created buy.php file
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      created html form
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      defined costants
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      mentioned connections
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      declared variables
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                      save data when press buy buttion
#declared required(mendatory) connections
require_once './connection.php';
require_once './Classes/collectionArray.php';
require_once './Classes/products.php';
require_once './Classes/product.php';
require_once './Classes/order.php';
#declared  or defined the constants to fetch data from common php function file
#gave path for folder
define("FOLDER_PHP2", "./Function/");
#gave path to access file inside the folder
define("PHP_FILE2", FOLDER_PHP2 . "./functions.php");
#included the file to fetch all the code which is inside the file.
include_once(PHP_FILE2);
#called pagetop function to get html code and default values inside function file
pagetop("buy Page");
#delcared global connection for get connetion to database
global $connection;
#varibale declaration
$subTotal = 0;
$product_id = "";
$retail_price = 0;
$total = 0;
$taxes = 0;
$quantity = 0;
$saveComments = "";
$savePrice = "";
$saveProductId = "";
$saveQuantity = "";
$saveSubTotal = "";
$saveTotal = "";
$saveTaxes = "";
$saveCustomerId = "";
$customer_id = "";
$errorOccured = false;
#created object of class customer 
$validate = new customer();
#fetch function varifySession from class customer to create session
//$valdateSession = $validate->varifySession();
#created object of class products 
$buy = new products();
#set condition to perform operation on buy button
if (isset($_POST["buy"])) {

    #get user input using $_POST and assigned it to variable
    $userComment = $_POST["comment"];
    $quantity = $_POST["quantity"];
    $product_id = $_POST["product"];
    #foreach loop to get required data from the product table
    foreach ($buy->items as $product) {
        #compared product it using if condition
        if ($_POST["product"] == $product->getProductID()) {
            #get reatail price using getter method
            $retil_price = $product->getRetailPrice();
        }
    }
    #counted subtotal and assigned to variable
    $subTotal = round((float)$retil_price * (float)$quantity,2);
    #counted taxes and assigned to variable
    $taxes = round($subTotal * LOCAL_TAX / 100,2);
    #counted total and assigned to variable
    $total = round($subTotal + $taxes,2);
    #created object of class order
    $saveOrder = new order();
    #set all user input into the database using setter method
    $saveCustomerId = $saveOrder->setCustomerId($_SESSION["customer_id"]);
    $saveProductId = $saveOrder->setProductId($product_id);
    $saveQuantity = $saveOrder->setQuantity($quantity);
    $savePrice = $saveOrder->setPrice($retil_price);
    $saveComments = $saveOrder->setComments($userComment);
    $saveSubTotal = $saveOrder->setSubTotal($subTotal);
    $saveTaxes = $saveOrder->setTaxes($taxes);
    $saveTotal = $saveOrder->setTotal($total);
if ($saveQuantity != "") {
        $errorOccured = true;
    } else {
    #saving all the user input into order table by calling save function
    $saveOrder->save();
    #message to user about his profile
    ?>
    <script> alert("Your order has been placess successfully......");
    </script>

    <?php
}
}
?>
<!--created form for placing an order-->
<form enctype="Multipart/form-data" class="formBuying" action="buy.php" method="POST">
    <br />
    <!--header of the page-->
    <h1 id="productHead">Buy Form </h1>
    <label id="customerForm">&emsp;Product :</label>
    <label class="required">*</label>

    <?php
    #select tag to select items from the selection
    echo "<select name='product'>";
    #created object of products
    $products = new products();
    #implimeted foreach loop to display all the product from the database
    foreach ($products->items as $product) {
        echo "<option value='" . $product->getProductID() . "'>" . $product->getProductCode() . " - " . $product->getProductDescription() . " (" . $product->getRetailPrice() . "$)" . "</option>";
    }
    #closed select tag
    echo "</select>";
    ?>
    <br />
    <br />

    <label id="customerForm">&emsp;Comments :</label>
        <span class="validationError">
<?php echo $saveComments; ?>
    </span>
    <input id="fieldData" type="Text" name="comment"  placeholder="&nbsp;Enter Comments" />

    <br />

    <label id="customerForm">&emsp;Quantity :
    </label><label class="required">*</label>
    <span class="validationError">
<?php echo $saveQuantity; ?>
    </span>
    <input id="fieldData" type="Text" name="quantity"  placeholder="&nbsp;Enter quantity" />
    <br />

    <!--button to place an order or save data-->
    <button type="submit" name="buy" class="registerbtn"">BUY</button>
    <br />
<!--closed form tag-->
</form>
<?php
pageBottom();
?>