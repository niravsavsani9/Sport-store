<?php //
//Revision History
#
#DEVELOPER                                         DATE                            COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         28/02/2022           created order.php file
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           defined constants for functions.
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           created html table
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           put conditions and read code to have access data and print it on table
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         04/03/2022           set table  colors during output as per requirement
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           gave cheatesheet download link
//declare constants
define("FOLDER_PHP", "./Function/");
define("FILE_PHP2", FOLDER_PHP . "./functions.php");
include_once(FILE_PHP2);
pagetop("order Page");
?>

<table  class="tableOrderPage" border="2px">
    <thead>
        <tr>
            <th><b>Product Id</b></th>
            <th><b>First Name</b></th>
            <th><b>Last Name</b></th>
            <th><b>City</b></th>
            <th><b>Comment</b></th>
            <th><b>Price</b></th>
            <th><b>Quantity</b></th>
            <th><b>sub total</b></th>
            <th><b>tax</b></th>
            <th><b>Grand total</b></th>
        </tr>
    </thead>
    <?php
// check if file exists
    if (file_exists(File_TEXT1)) {
        // open file
        $fileHandle = fopen(File_TEXT1, "r");
        while (($fileline = fgets($fileHandle)) != false) {
            if ($fileline != "") {

                $allOrderData = json_decode($fileline);
                echo "<tr>";
                for ($i = 0; $i < 10; $i++) {
                    $text_color = "";
                    if ($i == 5 || $i == 7 || $i == 8 || $i == 9) {
                        if ($i == 7) {
                            if (isset($_GET["command"])) {
                                if ($_GET["command"] == "color") {
                                    if ($allOrderData[$i] <= 100) {
                                        $text_color = "subtotalRed";
                                    } elseif ($allOrderData[$i] > 100 && $allOrderData[$i] < 999.9) {
                                        $text_color = "subtotalOrange";
                                    } elseif ($allOrderData[$i] > 1000) {
                                        $text_color = "subtotalGreen";
                                    }
                                }
                            }
                        }
                        echo "<td class=$text_color>" . $allOrderData[$i] . "$</td>";
                    } else {
                        echo "<td>" . $allOrderData[$i] . "</td>";
                    }
                }
                echo "</tr>";
            }
        }

        echo "</table>";

        // close the file
        fclose($fileHandle);
    } else {
        echo "<h1 class='no_order'>No order has been placed yet!</h1>";
    }
    ?>
    <br />
    <a href="buying.php" id="next"> &laquo; Buying Page</a>
    <a href="index.php" id="previous">Home</a>

    

    <?php
//called pageBottom function to get copyright details
    pageBottom();
    ?>
