<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\Validate;
use WIFI\JWE23\DataBanking\MySql;
use WIFI\JWE23\DataBanking\Model\Categories;
use WIFI\JWE23\DataBanking\Model\Row\Categorie;
use WIFI\JWE23\DataBanking\Model\Row\Job;
include "head.php";

$job = new Job($_GET["id"]);

if(!isset($_GET["doit"])) {
?>

<main class='main-job-card'>
        <h2 class='job-card__h2'>Are you sure you want to delete the Job?</h2>
        <div class='card__btn-divider-secondary'>
            <button class='btn'><a href="deletejob.php?id=<?php echo $_GET["id"] ?>&doit=<?php echo "secretword"?>">Yes</a></button>
            <button class='btn btn-secondary'><a href="jobslist.php">No</a></button>
        </div>
</main>

<?php 
} else {
    $job->delete();
    echo "<main class='main-job-card'>";
    echo "<h2 class='job-card__h2'>";
    echo "Job was Deleted";
    echo "</h2>";
    echo '<a class="job-card__h3 logout__link" href="jobslist.php">Back to List of Jobs</a>';
    echo "</main>";
}
        
include "footer.php"

?>