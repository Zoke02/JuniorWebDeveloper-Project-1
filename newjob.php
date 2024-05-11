<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;
use WIFI\JWE23\DataBanking\Model\Categories;
use WIFI\JWE23\DataBanking\Model\Row\Categorie;
include "head.php";

$succes = false;

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if (!empty($_POST))  {
    $validate = new Validate;
    $validate->is_formular_filled($_POST["job_title"], "Job Title");
    $validate->is_formular_filled($_POST["categorie"], "Categorie");
    $validate->is_formular_filled($_POST["place_of_work"], "Place of Work");
    $validate->is_formular_filled($_POST["hours"], "Hours");
    $validate->is_formular_filled($_POST["salary"], "Salary");
    $validate->is_formular_filled($_POST["description"], "Description");

    if (!$validate) {
        $job_title = $_POST["job_title"];
        $categorie = $_POST["categorie"];
        $place_of_work = $_POST["place_of_work"];
        $hours = $_POST["hours"];
        $salary = $_POST["salary"];
        $description = $_POST["description"];
        $created = date();
    
        $db = Mysql::getInstanz();

    }
}


?>

<main>
    <h2 class="job-card__h2">Createing a new Job</h1>
    <h3 class="job-card__h3">
    <?php
        if (!empty($validate)) {
        echo $validate->error_html();
        }
    ?>
    </h3>
    <form class="job-card" action="newjob.php" method="post">
        <div class="job-card__form">
            <label class="job-card__label" for="job_title">Job Title:</label>
            <input class="job-card__input" type="text" name="job_title" id="job_title">
            <label class="job-card__label" for="categorie">Categorie:</label>
            <select class="job-card__select" name="categorie" id="categorie">
                <option value=""></option>
                <?php
                $categories = new Categories;
                $result = $categories->all_categories();
                foreach ($result as $key => $categorie) {
                    echo '<option value="';
                    echo $categorie->id;
                    echo '">';
                    echo $categorie->name;
                    echo '<option>';
                }
                ?>
            </select>
            <label class="job-card__label" for="place_of_work">Place of Work:</label>
            <input class="job-card__input" type="text" name="place_of_work" id="place_of_work">
            <label class="job-card__label" for="hours">Hours:</label>
            <input class="job-card__input" type="text" name="hours" id="hours">
            <label class="job-card__label" for="salary">Salary:</label>
            <input class="job-card__input" type="text" name="salary" id="salary">
            <label class="job-card__label" for="description">Description:</label>
            <textarea class="job-card__textarea" id="description" name="description" rows="15" cols="50"></textarea>
        </div>
        <div class="job_card__btn">
            <button class="btn" type="submit">Create Job</button>
        </div>
    </form>
</main>


<?php
include "footer.php"
?>