<?php
define("WEBROOT", "http://localhost:8000/");
require_once('data.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des taches</title>
</head>

<body>
    <div>
        <a href="<?= WEBROOT ?>?page=liste"> liste</a>
        <a href="<?= WEBROOT ?>?page=ajout"> Ajout</a>
    </div>
    <?php
    $page = $_REQUEST['page'] ?? 'listtaches';
    if ($page == 'listtaches' || $page ==  'filtre') {
        // On récupère l'état choisi, s'il est vide on affiche tout
        $etat = $_REQUEST["etat"] ?? "";
        if ($page == 'filtre' && !empty($etat)) {
            $taches = getTachesByStatut($etat);
        } else {
            $taches = getAllTaches();
        }
        // echo "État recherché : " . $etat . " | Nombre de tâches trouvées : " . count($taches);
        require_once('listtaches.php');
    } elseif ($page == 'ajout') {
        require_once('ajout.php');
    } elseif ($page == 'detail') {
        require_once('details.php');
        // recuperation de l'id dans l'URL
        $id = $_GET["id"] ?? 0;
        if ($id > 0) {
            deleteTache($id);
        }
        header("Location: " . WEBROOT . "?page=listtaches");
        exit();
    } elseif ($page == 'supprimer') {
         // recuperation de l'id dans l'URL
        $id = $_GET["id"] ?? 0;
        if ($id > 0) {
            deleteTache($id);
        }
        header("Location: " . WEBROOT . "?page=listtaches");
        exit();
    } elseif ($page == 'terminé') {
        // var_dump($_SESSION['taches']); die();
          // recuperation de l'id dans l'URL via GET
        $id = $_GET["id"] ?? 0;
        if ($id > 0) {
            marquerTerminer($id);
        }
        header("Location: " . WEBROOT . "?page=listtaches");
        exit();
    } else {
        echo "page introuvable";
    }


    ?>
</body>

</html>