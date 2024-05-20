<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>A2Z Jobs</title>
        <link rel="stylesheet" href="css/style.css" />
        <script defer src="js/jquery-3.7.1.min.js"></script>
        <script defer src="js/main.js"></script>
    </head>
    <body>
        <header>
            <div class="nav-bar">
                <a href="index.php">
                    <div class="nav-bar__logo">A2Z</div>
                </a>
                <div class="nav-bar-left-box">
                    <a class="" href="myaccount.php">
                        <?php if (isset(($_SESSION["logged_in"])) && $_SESSION["logged_in"]  == true) { ?>
                        <div class="nav-bar__user">
                            <?php
                            echo substr($_SESSION["first_name"], 0, 1) . "|" . substr($_SESSION["last_name"], 0, 1);
                            ?>
                    </a>
                    </div>
                    </a>
                    <img
                    id="menu-toogle";
                    class="nav-bar__menu"
                    src="icons/menu-solid.svg"
                    alt=""/>
                    <?php } else { ?>
                        <a href="login.php">
                            <img
                            class="nav-bar__login"
                            src="icons/user-solid.svg"
                            alt=""
                            />
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="menu hide">
                <div class="categories" >
                <a href='myaccount.php' class='categorie'>My Account</a>
                </div>
                <div class="categories" >
                <a href='newjob.php' class='categorie'>Create new Job</a>
                </div>
                
                <?php if (($_SESSION["admin"]) == 1){ ?>
                <div class="categories" >
                    <a href='jobslist.php' class='categorie'>Jobs Administration</a>
                </div>
                <?php } else { ?>
                <div class="categories" >
                    <a href='jobslist.php' class='categorie'>Your Jobs</a>
                </div>
                <?php } ?>
                        
                <div class="categories" >
                <a href='alljobslist.php' class='categorie'>All Jobs List</a>
                </div>
                <div class="categories" >
                <a href='logout.php' class='categorie'>Logout</a>
                </div>
            </div>
        </header>