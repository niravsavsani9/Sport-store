<?php
#REVISON HISTORY
#       NAME                                        DATE                        COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         19/04/2022                      created login page
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         19/03/2022                      implimented login html form
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         19/03/2022                      mentioned link for new user to get register


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
pagetop("Login Page");
?>

<div class="login-container">
    <form action="index.php" class="formBuying" method="post">
        <br />
        <h1 id="productHead">User Login </h1>
        <input id="fieldData" type="text" placeholder="Username" name="username">
       
        <input class="registerbtn" type="password" placeholder="password" name="password">
        <button type="submit" name="login" class="registerbtn" >Login</button>
        <br />
        <label id="fieldData">Don't have an account? </label>
        <!--link to register new users-->
        <a href="<?php echo FILE_REGISTER; ?>">Register</a>
    </form>
</div>
<?php
pageBottom();
?>

