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

if (!empty($_POST))  {
    $validate = new Validate;
    $validate->is_formular_filled($_POST["job_title"], "Job Title");
    $validate->is_formular_filled($_POST["categorie"], "Categorie");
    $validate->is_formular_filled($_POST["qualification_id"], "Qualification");
    $validate->is_formular_filled($_POST["place_of_work"], "Place of Work");
    $validate->is_formular_filled($_POST["hours"], "Hours");
    $validate->is_formular_filled($_POST["salary"], "Salary");
    $validate->is_formular_filled($_POST["description"], "Description");

    if (!$validate->is_errors()) {
        
        $status = "Hidden";
        if (isset($_POST["status"])) {
            $status = "Visible";
        }

        if (!empty($_GET["id"])) 
        {
            $job = new Job(array(
                "id" => $_GET["id"] ?? null,
                "job_title" => $_POST["job_title"],
                "categorie_id" => $_POST["categorie"],
                "qualification_id" =>$_POST["qualification_id"],
                "place_of_work" => $_POST["place_of_work"],
                "hours" => $_POST["hours"],
                "salary" => $_POST["salary"],
                "description" => $_POST["description"],
                "status" => $status,
                "modified_on" => date("Y-m-d")
            ));
        }
        if (empty($_GET["id"])) 
        {
            $job = new Job(array(
                "id" => $_GET["id"] ?? null,
                "user_id" => $_SESSION["id"],
                "job_title" => $_POST["job_title"],
                "categorie_id" => $_POST["categorie"],
                "qualification_id" =>$_POST["qualification_id"],
                "place_of_work" => $_POST["place_of_work"],
                "hours" => $_POST["hours"],
                "salary" => $_POST["salary"],
                "description" => $_POST["description"],
                "status" => $status,
                "created_on" => date("Y-m-d")
            ));
        }   
        $job->save();
        $success = true;
    }
}


?>
    <?php
    // print_r($_POST);
    if ($success) {
        echo "<main class='main-job-card'>";
        echo "<h2 class='job-card__h2'>";
        if (!empty($_GET["id"])) echo "Job was Updated";
        if (empty($_GET["id"])) echo "Job was Created";
        echo "</h2>";
        echo '<a class="job-card__h3 logout__link" href="index.php">Back to Homepage</a>';
        echo "</main>";
    } else {
    ?>
<main>

    <?php
    if (!empty($_GET["id"]))
    {
        $job = new Job($_GET["id"]);
    }
    ?>
    <form class="job-card" action="newjob.php<?php
        if (!empty($job)) {
            echo "?id=" . $job->id;
        } ?>" method="post">
        <h2 class="job-card__h2"><?php 
        if (!empty($_GET["id"])) echo "Update Job";
        if (empty($_GET["id"])) echo "Create new Job";
        ?></h2>
        <h3 class="job-card__h3">
        <?php
            if (!empty($validate)) {
            echo $validate->error_html();
            }
        ?>
        </h3>
        <div class="job-card__form">
            <div class="job-card__checkbox">
                <label class="job-card__label" for="status">Visible</label>
                <span><input  type="checkbox" id="status" name="status" <?php 
                if (!empty($_GET["id"]) && (!isset($_POST["status"])))
                {
                    if ($job->status == 'Visible') {
                    echo "checked";
                    } else if ($job->status == 'Hidden') {
                    echo "";
                    } 
                }

                if (!isset($_POST["status"])) {
                    echo "";
                } else if (isset($_POST["status"])) {
                    echo "checked";
                }
                
                ?> /></span>
            </div>
            <label class="job-card__label" for="job_title">Job Title:</label>
            <input class="job-card__input" type="text" name="job_title" id="job_title" value="<?php 
            if (!empty($_POST["job_title"])) 
            {
                echo htmlspecialchars($_POST["job_title"]);
            } else if (!empty($job)) {
                echo htmlspecialchars($job->job_title);
            }
            ?>">

            <label class="job-card__label" for="categorie">Categorie:</label>
            <select class="job-card__select" name="categorie" id="categorie">
                <option value=""> <- Chose from List -></option>
                
                <?php
                $categories = new Categories;
                $result = $categories->all_categories();
                foreach ($result as $key => $categorie) {
                    echo '<option value="';
                    echo $categorie->id;
                    echo '">';
                    echo $categorie->categorie_name;
                    echo '</option>';
                }
                ?>
            </select>

            <label class="job-card__label" for="qualification_id">Qualification:</label>
            <select class="job-card__select" name="qualification_id" id="qualification_id">
                <option value=""> - Chose from List -</option>
                
                <?php
                $qualifications = new Qualifications;
                $result = $qualifications->all_qualifications();
                foreach ($result as $key => $qualification) {
                    echo '<option value="';
                    echo $qualification->id;
                    echo '">';
                    echo $qualification->qualification_name;
                    echo '</option>';
                }
                ?>
            </select>
            
            <label class="job-card__label" for="place_of_work">Place of Work:</label>
            <input class="job-card__input" type="text" name="place_of_work" id="place_of_work" value="<?php 
            if (!empty($_POST["place_of_work"])) 
            {
                echo htmlspecialchars($_POST["place_of_work"]);
            } else if (!empty($job)) {
                echo htmlspecialchars($job->place_of_work);
            }
            ?>">
            <label class="job-card__label" for="hours">Hours:</label>
            <input class="job-card__input" type="text" name="hours" id="hours" value="<?php 
            if (!empty($_POST["hours"])) 
            {
                echo htmlspecialchars($_POST["hours"]);
            } else if (!empty($job)) {
                echo htmlspecialchars($job->hours);
            }
            ?>">
            <label class="job-card__label" for="salary">Salary:</label>
            <input class="job-card__input" type="text" name="salary" id="salary" value="<?php 
            if (!empty($_POST["salary"])) 
            {
                echo htmlspecialchars($_POST["salary"]);
            } else if (!empty($job)) {
                echo htmlspecialchars($job->salary);
            }
            ?>">
            <label class="job-card__label" for="description">Description:</label>
            <textarea class="job-card__textarea" id="description" name="description" rows="25" cols="50" ><?php 
            if (!empty($_POST["description"])) 
            {
                echo htmlspecialchars($_POST["description"]);
            } else if (!empty($job)) {
                echo htmlspecialchars($job->description);
            }?></textarea>
        </div>
        <div class="job_card__btn">
            <button class="btn" type="submit"><?php 
                if (!empty($_GET["id"])) echo "Update Job";
                if (empty($_GET["id"])) echo "Create new Job";
            ?></button>
        </div>
    </form>
    <?php
    }
    ?>
</main>


<?php
include "footer.php"
?>