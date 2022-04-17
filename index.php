<?php
#Revision History
#
#DEVELOPER                                         DATE                            COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         28/02/2022           created index.php file
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           defined constants for functions.
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           wrote some lines on website details
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           Accessed images from diffrent folder and shuffled it for random images
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         01/03/2022           gave condition to get one image with width 100% and height 100%
#
//constant declaration
define("FOLDER_PHP", "./Function/");
define("FILE_PHP", FOLDER_PHP . "./functions.php");
//defined image constant as an array for random images
define("RANDOM_IMAGES", array("BTB_Nike_Cleats_Mercurial2.jpg",
    "baseball.jpg",
    "GetImage.asmx.jpg",
    "cricket_a484.jpg",
    "usatsi-12333463.jpg"));
include_once(FILE_PHP);
//called pagetop function to get html code and default values
//Assign image array to a varible
$random_images1 = RANDOM_IMAGES;
//shffled that variable using shuffle function
shuffle($random_images1);
pagetop("HomePage");
?>
<h1>WE FIT YOUR GAME.</h1>
<table class="tableIndexPage">
    <tr>
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
<a href="buying.php" id="next">Buying Page &raquo;</a>

<?php
//called pageBottom function to get copyright details
pageBottom();


