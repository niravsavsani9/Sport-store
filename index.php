<?php
#Revision History
#
#DEVELOPER                                         DATE                            COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         28/02/2022           created index.php file
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           defined constants for functions.
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           wrote some lines on website details
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           Accessed images from diffrent folder and shuffled it for random images
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           gave condition to get one image with width 100% and height 100%
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           mentioned cheatsheet link to direct download
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           implimented logout input to logout user


#declared  or defined the constants to fetch data from common php function file
#gave path for folder
define("FOLDER_PHP", "./Function/");
#gave path to access file inside the folder
define("FILE_PHP", FOLDER_PHP . "./functions.php");
#gave path to access text file cheat sheet
define("CHEATSHEET", "./cheatSheet.txt");
#defined image constant as an array for random images
define("RANDOM_IMAGES", array("BTB_Nike_Cleats_Mercurial2.jpg",
    "baseball.jpg",
    "GetImage.asmx.jpg",
    "cricket_a484.jpg",
    "usatsi-12333463.jpg"));
#included the file to fetch all the code which is inside the file.
include_once(FILE_PHP);
#called pagetop function to get html code and default values
#Assign image array to a varible
$random_images1 = RANDOM_IMAGES;
#shffled that variable using shuffle function
shuffle($random_images1);
#called pagetop function to get html code and default values inside function file
pagetop("HomePage");

?>

<table class="tableIndexPage">
    <tr>
        <h1>WE FIT YOUR GAME.</h1>
        <td id="dataOfTableContent">
            <h3>No matter your level of play, personal style, or budget, you can feel confident that one of 
                our 150+ stores across Canada will have what you're looking for, in store or online.</h3>
        </td>
        <td id="imageTable">

            <!--gave link on an image to redirect on other pages(any)-->
            <a href="https://www.youtube.com/watch?v=zZqitcGmqPc" target="_blank"> 
                <img src="<?php echo FOLDER_IMAGES . $random_images1[0]; ?>" class="<?php
                if ($random_images1[0] == "baseball.jpg") {
                    echo "oneRandomImageChange";
                } else {
                    echo "randomImagesChange";
                }
                ?>" alt="advertising" srcset=""> </a>
        </td>
    </tr>
</table>
<!--link to download cheat sheet-->
<a href="<?php echo CHEATSHEET; ?>" download id="previous">Download Cheat Sheet</a>
<form method="post">
    <?php 
    #created object of customer
    $username1 = new customer();
    if(isset($_POST["logout"])){
        
       echo "<script>alert('Logged Out Successfully');</script>";
            session_destroy();
    }
    if(!empty($_SESSION["customer_id"]))
    { 
    ?>
    <input type="submit" class="registerbtn" value="Logout" name="logout" />
    
    <?php
    }
    ?>
</form>
    <?php
#called pageBottom function to get copyright details
pageBottom();


