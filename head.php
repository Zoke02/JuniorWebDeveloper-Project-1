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
                    <?php if (isset(($_SESSION["logged_in"])) && $_SESSION["logged_in"]  == true) { ?>
                        <a href="index.php" class="nav-bar__user">
                            <?php
                        echo $_SESSION["first_name"];
                        ?>
                    </a>
                    <img
                    id="menu-toogle";
                    class="nav-bar__menu"
                    src="icons/menu-solid.svg"
                    alt=""
                    />
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
            <div class="menu hide"></div>

            <div class="hero-box 
            <?php
                echo "show";
            ?>
            ">
                <h1>
                    Find your <br />
                    dreamjob!
                </h1>
                <div class="search-box">
                    <div class="search-box__field">
                        <img
                            class="search-box__lens"
                            src="icons/magnifying-glass-solid.svg"
                            alt=""
                        />
                        <form>
                            <input
                                type="search"
                                name="search"
                                id="search"
                                placeholder="Search"
                            />
                        </form>
                    </div>
                </div>
            </div>
        </header>