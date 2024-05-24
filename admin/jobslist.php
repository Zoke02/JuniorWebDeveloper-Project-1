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
    <div class="hero-box border-bottom">
        <h1>
            Search<br />
            <?php
            if ($_SESSION["admin"] == 1) {
                echo htmlspecialchars("Jobs Administration");
            } else {
                echo htmlspecialchars("Jobs you Created");
            } ?>
        </h1>
        <div class="search-box">
            <div class="search-box__field">
                <img
                    class="search-box__lens"
                    src="icons/magnifying-glass-solid.svg"
                    alt=""
                />
                <input
                    type="search"
                    name="search"
                    id="search"
                    onkeyup="search()"
                    placeholder="Search"
                />
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <h2 class="job-card__h2"><?php
        if ($_SESSION["admin"] == 1) {
            echo htmlspecialchars("Jobs");
        } else {
            echo htmlspecialchars("My Jobs");
        } ?>
        </h2>
        <div class="cards-box">
            <?php
            if ($_SESSION["admin"]) {
                $jobs = new Jobs;
                $all_jobs = $jobs->all_jobs_admin();
                foreach ($all_jobs as $job) {
                    $created_on = $job->created_on;
                    $display_date = date("d-m-Y", strtotime($created_on));
                    $modified_on = $job->modified_on;
                    $display_modified = date("d-m-Y", strtotime($modified_on));
                    echo '<div class="cards">';
                        echo '<div class="card">';
                            echo '<h2 class="card__title">';
                            echo $job->job_title;
                            echo '</h2>';
                            echo '<div>';
                                echo "<ul>";
                                    echo "<li>" . "Categorie: " .  $job->get_categorie()->categorie_name . "</li>";
                                    echo "<li>" . "Qualification: " .  $job->get_qualification()->qualification_name . "</li>";
                                    echo "<li>" . "Place of work: " . $job->place_of_work . "</li>";
                                    echo "<li>" . "Hours: " . $job->hours . "</li>";
                                    echo "<li>" . "Sarary: " . $job->salary . "</li>";
                                    echo "<li>" . "Created: " .  $display_date . "</li>";
                                    if ($job->modified_on) {
                                        echo "<li>" . "Last Updated: " .  $modified_on . "</li>";
                                    } else {
                                        echo "<li>" . "Last Updated: Never" . "</li>";
                                    }
                                    echo "<li>" . "Status: " .  $job->status . "</li>";
                                echo "<ul>";
                            echo '</div>';
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
                    $modified_on = $job->modified_on;
                    $display_modified = date("d-m-Y", strtotime($modified_on));
                    echo '<div class="cards">';
                        echo '<div class="card">';
                            echo '<h2 class="card__title">';
                            echo $job->job_title;
                            echo '</h2>';
                            echo '<div>';
                                echo "<ul>";
                                    echo "<li>" . "Categorie: " .  $job->get_categorie()->categorie_name . "</li>";
                                    echo "<li>" . "Qualification: " .  $job->get_qualification()->qualification_name . "</li>";
                                    echo "<li>" . "Place of work: " . $job->place_of_work . "</li>";
                                    echo "<li>" . "Hours: " . $job->hours . "</li>";
                                    echo "<li>" . "Sarary: " . $job->salary . "</li>";
                                    echo "<li>" . "Created: " .  $display_date . "</li>";
                                    if ($job->modified_on) {
                                        echo "<li>" . "Last Updated: " .  $modified_on . "</li>";
                                    } else {
                                        echo "<li>" . "Last Updated: Never" . "</li>";
                                    }
                                    echo "<li>" . "Status: " .  $job->status . "</li>";
                                echo "<ul>";
                            echo '</div>';
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
        </div>
    </div>
</main>

<?php
include "footer.php"
?>