<?php
#Revision History
#
#DEVELOPER                                         DATE                            COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         28/02/2022           created function.php page
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           defined all constant in one page for whole project
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           created top and bottom function
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         03/03/2022           created functions for error Handling and exceptions
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         03/03/2022           write a code to save all errors and exception in log file
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         03/03/2022           set display(company) logo for home page
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         07/03/2022           set an opacity conndition for css
//defined all constant of project
require_once './connection.php';
require_once './Classes/customer.php';
session_start();
define("FOLDER_FUNCTION", "./Function/");
define("PHP_FILE", FOLDER_FUNCTION . "./functions.php");
define("FOLDER_CSS", "./CSS/");
define("FILE_NEWFILE", FOLDER_CSS . "./newFinalProject.css");
define("FILE_CSS", FOLDER_CSS . "./finalProject.css");
define("FOLDER_IMAGES", "./Image/");
define("FILE_INDEX", "./index.php");
define("FILE_BUYING", "./buying.php");
define("FILE_ORDER", "./orderProject.php");
define("FILE_BUY", "./buy.php");
define("FILE_ACCOUNT", "./account.php");
define("FILE_LOGIN", "./login.php");
define("FILE_REGISTER", "./register.php");
define("FOLDER_TEXT", "./Orders/");
define("FOLDER_LOG", "./Logs/");
define("File_TEXT1", FOLDER_TEXT . "./order.txt");
define("FILE_LOG", FOLDER_LOG . "./log.txt");
define("PRODUCTCODE_MAXIMUM_LENGTH", 12);
define("FIRSTNAME_MAXIMUM_LENGTH", 20);
define("LASTNAME_MAXIMUM_LENGTH", 20);
define("CITY_MAXIMUM_LENGTH", 8);
define("COMMENTBOX_MAXIMUM_LENGTH", 200);
define("PRICE_MAXIMUM", 10000);
define("QUANTITY_MINIMUM", 1);
define("QUANTITY_MAXIMUM", 99);
define("LOCAL_TAX", 13.45);
//Created page top function to minimise every time html code overlapping
define("DEBUGGING_MODE", true);
$currentDateTime = date('Y-m-d');
$userUsername = "";
$userPassword = "";
$errorUserUsername = "";
$errorUserLogin = "";
$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

function manageError($errorNumber, $errorString, $errorFile, $errorLine) {
    global $currentDateTime;
    $detailedError = $currentDateTime . " - An error " . $errorNumber . "{" . $errorString . "} occurred in the file " . $errorFile . " at line " . $errorLine;
    if (DEBUGGING_MODE == true) {
        #for developers
        echo $detailedError;
    }
    #for end-user
    echo "<br>An error occurred";
    #save in the file the detail error
    $data = $detailedError;
    $JSONdata = json_encode($detailedError);
    $fileHandle = fopen(FILE_LOG, "a");
    // write in file
    fwrite($fileHandle, $JSONdata . "\n");
    fclose($fileHandle);
    exit(); # kill PHP
}

function manageException($exception) {
    global $currentDateTime;
    $detailedError = $currentDateTime . "An exception " . $exception->getCode() . "{" . $exception->getMessage() . "} occurred in the file " . $exception->getFile() . " at line " . $exception->getLine();
    if (DEBUGGING_MODE == true) {
        #for developers
        echo $detailedError;
    }
    #for end-user
    echo "<br>An exception occurred";
    #save in the file the detail error
    $JSONdata = json_encode($detailedError);
    file_put_contents(FILE_LOG, "$JSONdata\r\n", FILE_APPEND);
    exit(); # kill PHP
}

set_error_handler("manageError");
set_exception_handler("manageException");

$username = new customer();

function pagetop($pageTitle) {
    header('Expires: Sat, 03 Dec 1994 16:00:00 GMT');
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    header('Content-type: text/html; charset=UTF-8');

    if (isset($_POST["login"])) {
        global$username;
        global $errorUserLogin, $userPassword, $userUsername;
        $userUsername = htmlspecialchars($_POST["username"]);
        $userPassword = htmlspecialchars($_POST["password"]);

        $errorUserLogin = $username->customerLogin($userUsername, $userPassword);
//        echo $_SESSION["customer_id"];

        if ($userUsername == "" || $userPassword == "" || $errorUserLogin = "") {
            echo "session not created";
        } else {
            echo "session  created";
        }
    } else {
        if (isset($_POST["logout"])) {
            echo "session destroyed";
            session_destroy();
            header("Location: index.php");
        } else {
            if (isset($_SESSION["customer_id"])) {
                $username = $_SESSION["customer_id"];
            }
        }
    }
    ?><!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS; ?>"/> 

            <title><?php echo $pageTitle; ?> </title>
        </head>
        <body class="">
            <table class="mainNavigationTable" width="101%">
                <tr>
                    <td id="1ColumTable">


                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                            <a href="<?php echo FILE_INDEX; ?>">Index</a>


    <?php
    if (empty($_SESSION["firstname"])) {
        ?>
                                <a href="<?php echo FILE_LOGIN; ?>">Login</a>
        <?php
    }
    ?>

                            <?php
                            if (!empty($_SESSION["firstname"])) {
                                $username1 = new customer();
                                ?>
                                <a href="<?php echo FILE_ORDER; ?>">Orders</a>
                                <a href="<?php echo FILE_BUY; ?>">Buy</a>
                                <a href="<?php echo FILE_REGISTER; ?>">Account</a>
                                <!--<img src="../Image/yoga.jpeg" base64_encode() />-->
                                <!--<img src="../Image/yoga.jpeg" base64_encode(<?php echo $username1->getPicture(); ?>) alt="alt"/>-->
                                <!--<input type="submit" value="Logout" name="logout" />-->
                                <?php
                            }
                            ?>


                        </div>
                        <div id="main" >
                            <span id="accessNavigationButton" onclick="openNav()">&#9776; Menu</span>
                        </div>

                    </td>
                    <td >
                        <h1 id="title">
                            Global Athletic Sports Expo
                        </h1>
                    </td>
                    <td id="mainLogo">
                        <img id="mainLogoImage" src="Image/yoga.jpeg" alt="alt"/>
                    </td>
                </tr>
            </table>
           
            <hr class="line">
            <br />
    <?php
    //passed navigation menu functions to operate website at every pages
    navigationMenu();
}

function navigationMenu() {
    ?>
            <script>
                function openNav() {
                    document.getElementById("mySidenav").style.width = "250px";
                    document.getElementById("main").style.marginLeft = "250px";
                }
                function closeNav() {
                    document.getElementById("mySidenav").style.width = "0";
                    document.getElementById("main").style.marginLeft = "0";
                }
            </script>
    <?php
}

//bottom page function to write default message at the bottom of the page
function pageBottom() {
    ?>
            <!-- copy right year dynamic printed at the bottom-->
            <p class="copyRightInfo">Copyright® Niravkumar Savsani(2110222) <?php echo date('Y'); ?> </p>
        </body>
    </html>
            <?php
        }
        ?>