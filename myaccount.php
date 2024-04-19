<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;
include "head.php";

$success = false;

?>


<main>
    <?php
    if (isset($_GET["id"]) && $_GET["id"] == $_SESSION["id"]) { ?>
        <div class="myaccount">
            <div class="myaccount__block">
                <p class="myaccount__p">First Name: <span><input type="text" name="color" id="color"></span> </p>
                <p class="myaccount__p">Last Name: <?php echo $_SESSION["last_name"]; ?></p>
                <p class="myaccount__p">E-Mail: <?php echo $_SESSION["email"]; ?></p>
                <p class="myaccount__p">Password Status: Good</p>
            </div>
        </div>
    <?php } ?>

    <div class="myaccount">
        <div class="myaccount__block">
            <p class="myaccount__p">First Name: <?php echo $_SESSION["first_name"]; ?> </p>
            <p class="myaccount__p">Last Name: <?php echo $_SESSION["last_name"]; ?></p>
            <p class="myaccount__p">E-Mail: <?php echo $_SESSION["email"]; ?></p>
            <p class="myaccount__p">Password Status: Good</p>
        </div>
        <div class="myaccount__block">
            <a href="myaccount.php?id=<?php echo $_SESSION["id"]; ?>"><button class="btn" type="button">Change Account Data</button></a>
            <button class="btn" type="button">Change Password</button>

        </div>
    </div>
</main>

<?php
include "footer.php"
?>