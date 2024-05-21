<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;
use WIFI\JWE23\DataBanking\Model\Categories;
use WIFI\JWE23\DataBanking\Model\Row\Categorie;
use WIFI\JWE23\DataBanking\Model\Qualifications;
use WIFI\JWE23\DataBanking\Model\Row\Qualification;
use WIFI\JWE23\DataBanking\Model\Row\Job;
include "head.php";

$success = false;

if (!empty($_POST)) 
{
    $categorie = new Categorie(array(
        "id" => $_GET["id"],
        "name" => $_POST["name"]
    ));
    $categorie->save();
    $success = true;
}   


if ($success) {
    echo "<main class='main-job-card'>";
    echo "<h2 class='job-card__h2'>";
    echo "Categorie was Updated";
    echo "</h2>";
    echo '<a class="job-card__h3 logout__link" href="categorieslist.php">Back to List of Categories</a>';
    echo "</main>";
} else { ?>


<main>
    <h2 class="job-card__h2">Update Categorie</h2>
    <h3 class="job-card__h3">
    <?php
        if (!empty($validate)) {
        echo $validate->error_html();
        }
    ?>
    </h3>
    
    <?php
    if (!empty($_GET["id"]))
    {
        $categorie = new Categorie($_GET["id"]);
    }
    ?>

    <form class="job-card" action="updatelist.php?id= <?php echo $categorie->id ?>" method="post">
        <div class="job-card__form">
            <label class="job-card__label">Update from: <?php echo $categorie->name; ?></label>
            <label class="job-card__label" for="name">Update to:</label>
            <input class="job-card__input" type="text" name="name" id="name" value="<?php 
            if (!empty($categorie)) {
                echo htmlspecialchars($categorie->name);
            }
            ?>">
            <div class="job_card__btn">
                <button class="btn" type="submit">Update Categorie</button>
            </div>
        </div>
    </form>
</main>


<?php
}
include "footer.php"
?>