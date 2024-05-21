<?php
require "admin/functions.php";

use WIFI\JWE23\DataBanking\MySql;
use WIFI\JWE23\DataBanking\Model\Categories;
use WIFI\JWE23\DataBanking\Model\Jobs;
use WIFI\JWE23\DataBanking\Model\Row\Categorie;
use WIFI\JWE23\DataBanking\Model\Row\Job;

header("Content-Type: application/json");

function fehler($message){
    header("HTTP/1.1 404 Not Found");
    echo json_encode(array(
        "status" => 0, // Status gibt man meist mit, das man nicht in HTTP Code Analysieren muss, dann erkennt man gleich am Status ob es funktioniert hat
        "error" => $message
    ));
    exit;
}

//  GET-Parameter aus request uri 
$request_uri_ohne_get = explode("?", $_SERVER["REQUEST_URI"])[0];

$teile = explode("/api/", $request_uri_ohne_get , 2);
$parameter = explode("/", $teile[1]);

$api_version = ltrim(array_shift($parameter), "vV"); // Kleines u. großes V auf der LINKEN Seite entfernen

if (empty($api_version)) {
    fehler("Please select a version. (Jobs or Categories)");
}

// leere Einträge aus Parameter-Array entfernen
foreach ($parameter as $k => $v) {
    if (empty($v)) {
        unset($parameter[$k]);
    } else {
        // Alle parameter in kleinbuchstaben umwadeln, falls diese falsch daherkommen
        $parameter[$k] = mb_strtolower($v);
    }
}

// Indizies neu zuordnen, falls mit doppeklten Schrägstrichen aufgerufen wird
$parameter = array_values($parameter);

if (empty($parameter)) {
    fehler("After you selected a version next write what results you want from DataBase.");
}
// echo "gut";

// print_r($_SERVER);

//--bis hier eigentlich Grundlagen für alle APIs
//--
//--ab hier Spezifizierung je nach Anwendzngsbedarf

if ($api_version == "jobs") {
    
    if ($parameter[0] == "list") {
        $result = array(
            "status" => 1,
            "result" => array()
        );
        
        $jobs = new Jobs;
        $all_jobs = $jobs->get_all_jobs();
        
        foreach ($all_jobs as $row){
            $result["result"][] = $row;
        }
        
        echo json_encode($result);
        exit;
    } elseif (!check_if_id_in_database(($parameter[0]), $api_version)) { 
        $result = array(
            "status" => 0,
            "result" => array()
        );
        $result["result"][] = "Job with ID: $parameter[0] is not in DataBase '$api_version'";
        echo json_encode($result);
        exit;

    } elseif (check_if_id_in_database(($parameter[0]), $api_version)) { 

        $result = array(
            "status" => 1,
            "result" => array()
        );
    
        $jobs = new Jobs;
        $one_job = $jobs->get_row_from_id($parameter[0], $api_version);
        $result["result"][] = $one_job;
        echo json_encode($result);
        exit;
    }
}

if ($api_version == "categories") {
    if ($parameter[0] == "list" && empty($parameter[1])) {
        $result = array(
            "status" => 1,
            "result" => array()
        );
        
        $jobs = new Jobs;
        $all_jobs = $jobs->get_all_categories();
        
        foreach ($all_jobs as $row){
            $result["result"][] = $row;
        }
        echo json_encode($result);
        exit;
    } elseif (!check_if_id_in_database(($parameter[0]), $api_version) && empty($parameter[1])) { 
        // print_r(check_if_job_in_database($parameter[0]));
        $result = array(
            "status" => 0,
            "result" => array()
        );
        $result["result"][] = "Categories with ID: $parameter[0] is not in DataBase '$api_version'";
        echo json_encode($result);
        exit;

    } elseif (check_if_id_in_database(($parameter[0]), $api_version) && empty($parameter[1])) {
        $result = array(
            "status" => 1,
            "result" => array()
        );
    
        $categories = new Jobs;
        $one_categorie = $categories->get_row_from_id($parameter[0], $api_version);
        $result["result"][] = $one_categorie;
        echo json_encode($result);
        exit;
    } elseif (check_if_id_in_database(($parameter[0]), $api_version) && $parameter[1] != "jobs")
    {
        $result = array(
            "status" => 0,
            "result" => array()
        );
        $result["result"][] = "After categodie/id/ you selected a false API.";
        echo json_encode($result);
        exit;
    } elseif (check_if_id_in_database(($parameter[0]), $api_version) && $parameter[1] == "jobs")
    {
        $result = array(
            "status" => 1,
            "result" => array()
        );
    
        $categories = new Jobs;
        $all_categorie = $categories->get_all_categories_by_id($parameter[0], $parameter[1]);
        $result["result"][] = $all_categorie;
        echo json_encode($result);
        exit;
    }
}

    