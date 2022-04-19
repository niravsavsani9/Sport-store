<?php
require_once './connection.php';
require_once './Classes/customer.php';
define("FOLDER_PHP1", "./Function/");
define("PHP_FILE1", FOLDER_PHP1 . "./functions.php");
include_once(PHP_FILE1);
//called pagetop function to get html code and default values
pagetop("Login Page");
?>

<div class="login-container">
    <form action="index.php" method="post">
        <input type="text" placeholder="Username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="login" >Login</button>
        <a href="<?php echo FILE_REGISTER; ?>">Register</a>
    </form>
</div>
<?php
pageBottom();
?>

