<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;
include "head.php";

?>


<main>

    <?php
    // if (isset($_GET["id"]) && $_GET["id"] == $_SESSION["id"]) { ?>
        <!-- <div class="myaccount">
            <div class="myaccount__block">
                <p class="myaccount__p">First Name: <span><input type="text" name="color" id="color"></span> </p>
                <p class="myaccount__p">Last Name: <?php // echo $_SESSION["last_name"]; ?></p>
                <p class="myaccount__p">E-Mail: <?php // echo $_SESSION["email"]; ?></p>
            </div>
        </div> -->
    <?php 
    // } 
    ?>

    <div class="myaccount">
        <img class="myaccount__image" src="icons/user-photo.png" alt="">
        <div class="myaccount__block">
            <p class="myaccount__p">First Name: <?php echo $_SESSION["first_name"]; ?> </p>
            <p class="myaccount__p">Last Name: <?php echo $_SESSION["last_name"]; ?></p>
            <p class="myaccount__p">E-Mail: <?php echo $_SESSION["email"]; ?></p>
        </div>
    </div>
</main>

<?php
include "footer.php"
?>