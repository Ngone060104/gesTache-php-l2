<?php
define("WEBROOT", "http://localhost:8000/");
require_once('data.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEstion des taches</title>
</head>

<body>
    <div>
        <a href="<?= WEBROOT ?>?page=liste"> liste</a>
        <a href="<?= WEBROOT ?>?page=ajout"> Ajout</a>
    </div>
    <?php
    $page = $_REQUEST['page'] ?? 'listtaches';
    if ($page == 'listtaches') {
        $taches = getAllTaches();
        require_once('listtaches.php');
    } elseif ($page == 'ajout') {
        require_once('ajout.php');
    } elseif ($page == 'detail') {
        require_once('details.php');
         $id = $_REQUEST["id"] ?? 0;
        if ($id > 0) {
            deleteTache($id);
        }
        header("Location: " . WEBROOT . "?page=listtaches");
        exit();
    }
        elseif($page == 'filtre'){
    } elseif ($page == 'supprimer') {
        $id = $_REQUEST["id"] ?? 0;
        if ($id > 0) {
            deleteTache($id);
        }
        header("Location: " . WEBROOT . "?page=listtaches");
        exit();
    } elseif ($page == 'terminer') {
        echo "terminer";
    } else {
        echo "page introuvable";
    }


    ?>
</body>

</html>