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
    <div class="hero-box">
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
    </div>
        <?php
        if (!empty($_GET["id"])) {
            $jobs = new Jobs;
            $all_jobs = $jobs->all_jobs_from_categorie($_GET["id"]);
            echo '<h2 class="job-card__h2" >' . "Jobs in Categorie:" . '</h2>';
            foreach ($all_jobs as $job)
            {
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
                        echo "<ul>";
                    echo '</div>';
                    echo "<p>";
                    echo nl2br($job->description);
                    echo "</p>";
                    echo "<div class='card__btn-divider'>";
                    echo '<button class="btn">';
                    echo "Less info...";
                    echo "</button>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            }
        } else {
            echo "<div class='main-job-card'>";
            echo "<h2 class='job-card__h2'>";
            echo "Wrong Page";
            echo "</h2>";
            echo '<a class="job-card__h3 logout__link" href="index.php">Back to HomePage</a>';
            echo "</div>";
        }
        ?>
    </div>
</main>


<?php
include "footer.php"
?>