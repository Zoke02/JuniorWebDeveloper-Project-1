<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;
use WIFI\JWE23\DataBanking\Model\Categories;
use WIFI\JWE23\DataBanking\Model\Jobs;
use WIFI\JWE23\DataBanking\Model\Row\Categorie;
use WIFI\JWE23\DataBanking\Model\Row\Job;
include "head.php";

?>

<main>
    <h2 class="pad-bot2 pad-top2"><?php
    if ($_SESSION["admin"] == 1) {
        echo htmlspecialchars("Jobs Administration");
    } else {
        echo htmlspecialchars("Jobs you created");
    } ?></h2>
    <?php
    if ($_SESSION["admin"]) {
        $jobs = new Jobs;
        $all_jobs = $jobs->all_jobs_admin();

        foreach ($all_jobs as $job) {
            $created_on = $job->created_on;
            $display_date = date("d-m-Y", strtotime($created_on));
            $status = "";
            if ($job->status == 0) {
                $status = "Hidden";
            } else {
                $status = "Vissible";
            }
            echo '<div class="cards">';
                echo '<div class="card">';
                    echo '<h2 class="card__title">';
                    echo $job->job_title;
                    echo '</h2>';
                    echo '<div>';
                        echo "<ul>";
                            echo "<li>" . "Categorie: " .  $job->get_categorie()->name . "</li>";
                            echo "<li>" . "Qualification: " .  $job->get_qualification()->name . "</li>";
                            echo "<li>" . "Place of work: " . $job->place_of_work . "</li>";
                            echo "<li>" . "Hours: " . $job->hours . "</li>";
                            echo "<li>" . "Sarary: " . $job->salary . "</li>";
                            echo "<li>" . "Created: " .  $display_date . "</li>";
                            echo "<li>" . "Status: " .  $status . "</li>";
                        echo "<ul>";
                    echo '</div>';
                    echo "<p>";
                    echo $job->description;
                    echo "</p>";
                    echo "<div class='card__btn-divider'>";
                    echo '<button class="btn">';
                    echo "<a href='newjob.php?id={$job->id}'>Modify Job</a>";
                    echo "</button>";
                    echo '<button class="btn">';
                    echo "<a href='deletejob.php?id={$job->id}'>Delete Job</a>";
                    echo "</button>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
    }
    if (empty($_SESSION["admin"])) {
        $jobs = new Jobs;
        $all_jobs = $jobs->all_jobs_from_user($_SESSION["id"]);

        foreach ($all_jobs as $job) {
            $created_on = $job->created_on;
            $display_date = date("d-m-Y", strtotime($created_on));
            $status = "";
            if ($job->status == 0) {
                $status = "Hidden";
            } else {
                $status = "Vissible";
            }
            echo '<div class="cards">';
                echo '<div class="card">';
                    echo '<h2 class="card__title">';
                    echo $job->job_title;
                    echo '</h2>';
                    echo '<div>';
                        echo "<ul>";
                            echo "<li>" . "Categorie: " .  $job->get_categorie()->name . "</li>";
                            echo "<li>" . "Qualification: " .  $job->get_qualification()->name . "</li>";
                            echo "<li>" . "Place of work: " . $job->place_of_work . "</li>";
                            echo "<li>" . "Hours: " . $job->hours . "</li>";
                            echo "<li>" . "Sarary: " . $job->salary . "</li>";
                            echo "<li>" . "Created: " .  $display_date . "</li>";
                            echo "<li>" . "Status: " .  $status . "</li>";
                        echo "<ul>";
                    echo '</div>';
                    echo "<p>";
                    echo $job->description;
                    echo "</p>";
                    echo "<div class='card__btn-divider'>";
                    echo '<button class="btn">';
                    echo "<a href='newjob.php?id={$job->id}'>Modify Job</a>";
                    echo "</button>";
                    echo '<button class="btn">';
                    echo "<a href='deletejob.php?id={$job->id}'>Delete Job</a>";
                    echo "</button>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
    }
    ?>
</main>

<?php
include "footer.php"
?>