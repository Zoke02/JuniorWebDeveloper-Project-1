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
                <img
                    id="menu-toogle";
                    class="nav-bar__menu"
                    src="icons/menu-solid.svg"
                    alt=""
                />
                <div class="nav-bar-left-box">
                    <a href="index.php?page=home">
                        <div class="nav-bar__logo">A2Z</div>
                    </a>
                    <a href="login.php?page=login">
                        <img
                            class="nav-bar__login"
                            src="icons/user-solid.svg"
                            alt=""
                        />
                    </a>
                </div>
            </div>
            <div class="menu hide"><?php insert_categories($categories) ?></div>

            <div class="hero-box 
            <?php 
            if (!$_GET) {
                echo "show";
            } elseif ($_GET["page"] == "login"){ 
                echo "hide";
            } elseif ($_GET["page"] == "about_us"){
                echo "hide";
            } elseif ($_GET["page"] == "data_prot_and_cookeis"){
                echo "hide";
            } 
                ?>">
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