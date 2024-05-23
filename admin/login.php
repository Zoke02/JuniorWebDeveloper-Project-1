<?php

include "functions.php";
include "head.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;

// print_r($_POST);


if (!empty($_POST)) 
{
    // Validate Class
    $validate = new Validate();
    $validate->is_formular_filled($_POST["email"], "E-Mail");
    $validate->is_formular_filled($_POST["password"], "Password");
    
    if (!$validate->is_errors()) {
        $db = Mysql::getInstanz();
        $sql_email = $db->escape($_POST["email"]);
        $sql_password = $db->escape($_POST["password"]);
        $result = $db->query("SELECT * FROM user WHERE email = '{$sql_email}'");
        $user = $result->fetch_assoc();

        if (empty($user) || !password_verify($sql_password, $user["password"]))
        {
            $validate->error_entry("E-Mail or Password is FALSE.");
        } else {
            $_SESSION["logged_in"] = true;
            $_SESSION["id"] = $user["id"];
            $_SESSION["first_name"] = $user["first_name"];
            $_SESSION["last_name"] = $user["last_name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["firm"] = $user["firm"];
            $_SESSION["admin"] = $user["admin"];
            if (!headers_sent())
            {    
                header('Location: index.php');
                exit;
                }
            else
                {  
                echo '<script type="text/javascript">';
                echo 'window.location.href="index.php";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url=index.php" />';
                echo '</noscript>'; exit;
            }

            // header("Location: index.php");
            exit;
        }
    }
}
?>

<main>
    <form class="login" action="login.php" method="post">
        <h1>
            Login
        </h1>
        <h3>
        <?php
            if (!empty($validate)) {
            echo $validate->error_html();
            }
        ?>
        </h3>
        <div class="login_row">
            <label class="login_label" for="">E-Mail</label>
            <input type="text" class="email" name="email" />
            <label class="login_label" for="">Password</label>
            <input type="password" class="password" name="password" />
        </div>
        <div class="login_row">
            <button class="btn btn-secondary" type="submit">Login</button>
        </div>
    </form>
</main>

<?php
include "footer.php"
?>