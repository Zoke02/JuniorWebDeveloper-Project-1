<?php
use WIFI\JWE23\DataBanking\Model\Categories;
?>

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
                <div class="nav-bar-box">
                    <img
                    id="categories-toogle";
                    class="nav-bar__menu"
                    src="icons/list-solid.svg"
                    alt=""/>
                    <a href="index.php">
                        <div class="nav-bar__logo">A2Z</div>
                    </a>
                </div>
                <div class="nav-bar-box">
                    <?php 
                        if (isset(($_SESSION["logged_in"])) && $_SESSION["logged_in"]  == true) {
                        echo '<a href="myaccount.php" class="nav-bar__user">';
                        echo substr($_SESSION["first_name"], 0, 1) . "|" . substr($_SESSION["last_name"], 0, 1);
                        echo '</a>';
                    ?> 
                    <img
                    id="menu-toogle";
                    class="nav-bar__menu"
                    src="icons/menu-solid.svg"
                    alt=""/>
                    <?php } else { ?>
                        <a href="login.php">
                            <div class="nav-bar__user">Jobs</div>
                        </a>
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

            <!-- I get a error called Header cant accept Location -->
            <div class="menu-categories hide">
                <?php
                $categories = new Categories;
                $all_categories = $categories->all_categories();

                foreach ($all_categories as $categorie)
                {
                echo '<div class="categories">';
                    echo '<a href="jobsbycategorie.php?id='. $categorie->id . '" class="categorie">' . $categorie->categorie_name . '</a>';
                echo '</div>';
                }
                ?>
            </div>

            <?php
            if (isset($_SESSION["logged_in"])) {
            ?>
                <div class="menu hide">
                    <div class="categories" >
                        <a href='myaccount.php' class='categorie'>My Account</a>
                    </div>
                    <div class="categories" >
                    <a href='newjob.php' class='categorie'>Create new Job</a>
                    </div>
                    
                    <?php if (isset($_SESSION["admin"])){ ?>
                    <div class="categories" >
                        <a href='jobslist.php' class='categorie'>Jobs Administration</a>
                    </div>
                    <?php } else { ?>
                    <div class="categories" >
                        <a href='jobslist.php' class='categorie'>My Jobs</a>
                    </div>
                    <?php } ?>

                    <?php if (isset($_SESSION["admin"])){ ?>
                    <div class="categories" >
                        <a href='categorieslist.php' class='categorie'>Categories Administration</a>
                    </div>
                    <?php } ?>
                            
                    <div class="categories" >
                    <a href='alljobslist.php' class='categorie'>All Jobs</a>
                    </div>
                    <div class="categories" >
                    <a href='logout.php' class='categorie'>Logout</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </header>