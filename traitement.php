<?php
require_once("data.php");
$errorTitre = "";
$errorDate_Echec= "";
$errorDate_Creation= "";
$errorDescription= "";
$errorEtat = "";
$verification = true;
if(isset($_POST["ajouter"])):
    if(trim($_POST["titre"])==""){
         $errorTitre = "le titre est obligatoire";
        $verification = false;
    }
    if(trim($_POST["description"])==""){
         $errorDescription = "la description est obligatoire";
        $verification = false;
    }
    if(trim($_POST["date_creation"])==""){
         $errorDate_Creation  = "la date de création est obligatoire";
        $verification = false;
    }
    if(trim($_POST["date_echeance"])==""){
         $errorDate_Echec = "la date d'échéance est obligatoire";
        $verification = false;
    }
    
   
    if ($verification) {
        $newTache = [
            "id" =>(count($_SESSION["taches"]) + 1),
            "titre" => $_POST['titre'],
            "description" => $_POST['description'],
            "date_creation" => $_POST['date_creation'],
            "date_echeance" => $_POST['date_echeance'],
            "etat" => "en attente",
        ];
       $_SESSION["taches"][]=$newTache;
        header("Location:".WEBROOT."?page=listtaches");
        exit(); 
    }
endif;
?>