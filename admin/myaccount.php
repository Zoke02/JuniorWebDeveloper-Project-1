<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;
include "head.php";

?>


<main>
    <div class="myaccount">
        <img class="myaccount__image" src="icons/user-tie-solid.svg" alt="">
        <div class="myaccount__block">
            <p class="myaccount__p">First Name: <?php echo $_SESSION["first_name"]; ?> </p>
            <p class="myaccount__p">Last Name: <?php echo $_SESSION["last_name"]; ?></p>
            <p class="myaccount__p">E-Mail: <?php echo $_SESSION["email"]; ?></p>
            <?php if (($_SESSION["admin"]) == 1){ ?>
                <p class="myaccount__p">Status Website: <?php echo $_SESSION["firm"]; ?></p>
            <?php } else { ?>
                <p class="myaccount__p">Company: <?php echo $_SESSION["firm"]; ?></p>
            <?php } ?>
        </div>
    </div>
</main>

<?php
include "footer.php"
?>