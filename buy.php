<?php

require_once './connection.php';
require_once './Classes/collectionArray.php';
require_once './Classes/products.php';
require_once './Classes/product.php';
require_once './Classes/order.php';
define("FOLDER_PHP2", "./Function/");
define("PHP_FILE2", FOLDER_PHP2 . "./functions.php");
include_once(PHP_FILE2);
pagetop("buy Page");
global $connection;
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

$validate = new customer();
$valdateSession = $validate->varifySession();
$buy = new products();
//$buy->load($_POST["product_id"]);
//echo $buy;

if (isset($_POST["buy"])) {
    

    $userComment = $_POST["comment"];
    $quantity = $_POST["quantity"];
    $product_id = $_POST["product"];
//    $PDOobject->execute();
//   
    foreach($buy->items as $product) {
        if ($_POST["product"] == $product->getProductID()) {
            $retil_price = $product->getRetailPrice();
        }
    }
    
    $subTotal = $retil_price * $quantity;
    $taxes = $subTotal * LOCAL_TAX / 100;
    $total = $subTotal + $taxes;

    $saveOrder = new order();
    $saveCustomerId = $saveOrder->setCustomerId($_SESSION["customer_id"]);
    $saveProductId = $saveOrder->setProductId($product_id);
    $saveQuantity = $saveOrder->setQuantity($quantity);
    $savePrice = $saveOrder->setPrice($retil_price);
    $saveComments = $saveOrder->setComments($userComment);
    $saveSubTotal = $saveOrder->setSubTotal($subTotal);
    $saveTaxes = $saveOrder->setTaxes($taxes);
    $saveTotal = $saveOrder->setTotal($total);

  
    $saveOrder->save();
    echo "Order placed successfully.....";
        
//   $PDOobject->closeCursor();
//   $connection=null;
}
?>

<form enctype="Multipart/form-data" class="formBuying" action="buy.php" method="POST">
    <br />
    <h1 id="productHead">Buy Form </h1>

    <label id="customerForm">
        &emsp;Product :
    </label><label class="required">*</label>

    <?php
    
    echo "<select name='product'>";

                $products = new products();
                foreach ($products->items as $product) {

                    echo "<option value='" . $product->getProductID() . "'>" . $product->getProductCode() . " - " . $product->getProductDescription() . " (" . $product->getRetailPrice() . "$)" . "</option>";
                }
    echo "</select>";
   
    ?>
    <br />
    <br />

    <label id="customerForm">
        &emsp;Comments :
    </label><input id="fieldData" type="Text" name="comment"  placeholder="&nbsp;Enter Comments" />
    <br />

    <label id="customerForm">
        &emsp;Quantity :
    </label><label class="required">*</label>
    <input id="fieldData" type="Text" name="quantity"  placeholder="&nbsp;Enter quantity" />
    <br />

    <button type="submit" name="buy" class="registerbtn"">BUY</button>
    <br />

</form>
<?php
pageBottom();
?>


