<?php
require "admin/functions.php";
use WIFI\JWE23\DataBanking\Validate;
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
    fehler("Bitte geben Sie eine API-Version an");
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
    fehler("Nach der Version wurde keine Methode übergeben. Prüfen Sie Ihren Aufruf!");
}
// echo "gut";

// print_r($_SERVER);

//--bis hier eigentlich Grundlagen für alle APIs
//--
//--ab hier Spezifizierung je nach Anwendzngsbedarf

if ($parameter[0] == "list") {
    $ausgabe = array(
        "status" => 1,
        "result" => array()
    );

    $jobs = new Jobs;
    $all_jobs = $jobs->get_all_jobs();

    foreach ($jobs as $row){
        $ausgabe["result"][] = $row;
    }

    // print_r($result);

    echo json_encode($ausgabe);
    exit;
} elseif ($parameter[0] == "jobs") {

    if(!empty($parameter[1])) {
        // ID wurde übergeben
        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );

        // Rezeptedaten ermitteln
        $sql_rezepte_id = escape($parameter[1]);
        $result = query("SELECT * FROM rezepte WHERE id = '{$sql_rezepte_id}'");
        $rezept = mysqli_fetch_assoc($result);
        if (!$rezept) {
            fehler("Mit dieser ID'{$parameter[1]}' wurde kein Rezept gefunden!");
        }
        $ausgabe["result"] = $rezept; 

        // Benutzerdaten ermitteln und an die Ausgabe anhängen
        $result = query("SELECT id, benutzername, email FROM benutzer WHERE id = '{$rezept["benutzer_id"]}'");
        $ausgabe["benutzer"] = mysqli_fetch_assoc($result);

        //Zutaten ermitteln und an Ausgabe anhängen
        $result = query("SELECT zutaten.* FROM zutaten_zu_rezepte JOIN zutaten 
        ON zutaten_zu_rezepte.zutaten_id = zutaten.id 
        WHERE zutaten_zu_rezepte.rezepte_id = '{$sql_rezepte_id}' 
        ORDER BY zutaten_zu_rezepte.id");

        $ausgabe["zutaten"] = array();
        while ($zutat = mysqli_fetch_assoc($result)){
            $ausgabe["zutaten"][] = $zutat;
        }


        echo json_encode($ausgabe); // Umwandlung eines Array in JSON
        exit;
    } else {
    // Liste der Rezepte
        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );
        $result = query("SELECT * FROM rezepte ORDER BY id ASC");
        while ($row = mysqli_fetch_assoc($result)){
            $ausgabe["result"][] = $row;
        }

        echo json_encode($ausgabe); // Umwandlung eines Array in JSON
        exit;
    }
} else {
    fehler("Die methode '{$parameter[0]}' existiert nicht.");
}
