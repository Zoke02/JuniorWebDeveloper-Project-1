<?php
include "functions.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;
use WIFI\JWE23\DataBanking\Model\Categories;
use WIFI\JWE23\DataBanking\Model\Jobs;
use WIFI\JWE23\DataBanking\Model\Row\Categorie;
use WIFI\JWE23\DataBanking\Model\Row\Job;
include "head.php";

// RUN CRONJOB HERE: expiration_functions.php
include "expiration_functions.php";
hide_after_90_days();
delete_after_365_days();

?>
<main>
    <div class="max-width border-bottom">
        <div class="hero-box main-wrapper">
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
                    <input
                        type="search"
                        name="search"
                        id="search"
                        onkeyup="search()"
                        placeholder="Search"
                    />
                </div>
            </div>
            <a class="btn" href="alljobslist.php">List of All Jobs</a>
        </div>
    </div>
        <h2 class="hot-title" >Last 10 created jobs!</h2>

        <div class="main-wrapper">
            <div class="cards-box">
                <?php
                $jobs = new Jobs;
                $all_jobs = $jobs->last_jobs_vissible();
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
                                echo "<ul>";
                            echo '</div>';
                            echo "<p class='hide'>";
                            echo nl2br($job->description);
                            echo "</p>";
                            echo "<div class='card__btn-divider'>";
                            echo '<button class="btn">';
                            echo '<a href="viewjob.php?id='. $job->id .'">';
                            echo "More info...";
                            echo '</a>';
                            echo "</button>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</main>
<?php
include "footer.php"
?>