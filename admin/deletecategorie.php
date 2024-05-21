<?php 
include "functions.php";
use WIFI\JWE23\DataBanking\MySql;
use WIFI\JWE23\DataBanking\Model\Categories;
use WIFI\JWE23\DataBanking\Model\Jobs;
use WIFI\JWE23\DataBanking\Model\Row\Categorie;
use WIFI\JWE23\DataBanking\Model\Row\Job;
include "head.php";

$error = "";
$categorie = new Categorie($_GET["id"]);
$jobs = new Jobs;
$all_jobs = $jobs->all_jobs_admin();

foreach ($all_jobs as $job) {
    if ($job->categorie_id == $_GET["id"]) {
        $error = "Cant delete Categorie with ID $job->categorie_id because there is at least job with that Categorie.";
    }
} 
    
if (!empty($error)) 
{    
echo "<main class='main-job-card'>";
    echo "<h2 class='job-card__h2'>";
        echo "You cant DELETE Categorie $categorie->name because one or more Jobs are useing it.";
    echo "</h2>";
    echo '<a class="job-card__h3 logout__link" href="categorieslist.php">Back to List of Categories</a>';
echo "</main>";
} elseif (!isset($_GET["doit"])) 
{
?>

<main class='main-job-card'>
        <h2 class='job-card__h2'>Are you sure you want to delete the Categorie?</h2>
        <div class='card__btn-divider-secondary'>
            <button class='btn'><a href="deletecategorie.php?id=<?php echo $_GET["id"] ?>&doit=<?php echo "secretword"?>">Yes</a></button>
            <button class='btn btn-secondary'><a href="jobslist.php">No</a></button>
        </div>
</main>

<?php 
} else {
    $categorie->delete();
    echo "<main class='main-job-card'>";
    echo "<h2 class='job-card__h2'>";
    echo "Categorie was Deleted";
    echo "</h2>";
    echo '<a class="job-card__h3 logout__link" href="categorieslist.php">Back to List of Categories</a>';
    echo "</main>";
}
        
include "footer.php"

?>