<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\MySql;
use WIFI\JWE23\DataBanking\Model\Categories;
use WIFI\JWE23\DataBanking\Model\Jobs;
use WIFI\JWE23\DataBanking\Model\Row\Categorie;
use WIFI\JWE23\DataBanking\Model\Row\Job;
include "head.php";

$categorie_exists;
$success = false;
$categories = new Categories;
$all_categories = $categories->all_categories();

if (empty($_POST["categorie"])) {
    $categorie_exists = "";
} else {
    foreach ($all_categories as $categories) {
        if (strtolower($categories->categorie_name) == strtolower($_POST["categorie"])) {
            $categorie_exists = "A Categorie with the same name already exists.";
        }
    }
}


if (!empty($_POST) && !empty($_GET["id"]))
{
    $categorie = new Categorie(array(
        "id" => null,
        "categorie_name" => $_POST["categorie"]
    ));
    $categorie->save();
    $success = true;
}

if (!empty($categorie_exists)) {
    echo "<main class='main-job-card'>";
    echo "<h2 class='job-card__h2'>";
        echo "$categorie_exists";
    echo "</h2>";
    echo '<a class="job-card__h3 logout__link" href="categorieslist.php">Back to List of Categories</a>';
echo "</main>";
} elseif  (empty($categorie_exists) && !empty($_POST["categorie"])) {
    if (!empty($_POST) && empty($_GET["id"]))
    {
        $categorie = new Categorie(array(
            "id" => null,
            "categorie_name" => $_POST["categorie"]
        ));
        $categorie->save();
        $success = true;
    }
    echo "<main class='main-job-card'>";
    echo "<h2 class='job-card__h2'>";
    echo "Categorie was Created";
    echo "</h2>";
    echo '<a class="job-card__h3 logout__link" href="categorieslist.php">Back to List of Categories</a>';
    echo "</main>";
}
else { 
?>
<main>
    <div class="job-categories">
        <h2 class="job-card__h2" >Create Categorie</h2>
        <form class="job-card" action="categorieslist.php" method="post">
            <div class="job-card__form">
                <label class="job-card__label" for="categorie">Categorie Name:</label>
                <input class="job-card__input" type="text" name="categorie" id="categorie" value="<?php
                if (!empty($_POST["categorie"]))
                {
                    echo htmlspecialchars($_POST["categorie"]);
                } ?>">
            </div>
            <div class="job_card__btn">
                <button class="btn" type="submit">Create</button>
            </div>
        </form>
        <h2 class="job-card__h2 border-top" >List of all Categories</h2>
        <div class="job-categories-box main-wrapper">
            <?php
            $categories = new Categories;
            $all_categories = $categories->all_categories();

            foreach ($all_categories as $categorie)
            {
            echo '<div class="cards">';
                echo '<div class="card">';
                    echo '<h2 class="card__title">';
                        echo $categorie->categorie_name;
                    echo '</h2>';
                    echo "<div class='card__btn-divider'>";
                        echo '<button class="btn">';
                            echo "<a href='updatelist.php?id={$categorie->id}'>Update</a>";
                        echo "</button>";
                        echo '<button class="btn">';
                            echo "<a href='deletecategorie.php?id={$categorie->id}'>Delete</a>";
                        echo "</button>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            }
            ?>
        </div>
    </div>
</main>
<?php
}
include "footer.php"
?>

