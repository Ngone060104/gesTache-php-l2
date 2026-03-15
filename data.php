<?php
session_start();
// session_unset();
// session_destroy();
if (!isset($_SESSION['taches'])) {
    $_SESSION['taches'] = [
        [
            "id" => 1,
            "titre" => "Faire le footing",
            "description" => "Ajouter un nouveau produit dans le stock",
            "date_creation" => "2024-06-01",
            "date_echeance" => "2024-06-10",
            "etat" => "terminé",

        ],
        [
            "id" => 2,
            "titre" => "Révision UML",
            "description" => "Mettre à jour les quantités en stock",
            "date_creation" => "2024-06-02",
            "date_echeance" => "2024-06-12",
            "etat" => "en cours",
        ],
        [
            "id" => 3,
            "titre" => "Rattraper ses prieres",
            "description" => "Supprimer les produits obsolètes",
            "date_creation" => "2024-06-03",
            "date_echeance" => "2024-06-15",
            "etat" => "à faire",
        ],
    ];
}
function getAllTaches(): array
{
    return $_SESSION['taches'];
}

function getTacheById(int $id): array|null
{
    $taches = getAllTaches();
    foreach ($taches as $tache) {
        if ($tache['id'] == $id) {
            return $tache;
        }
    }
    return null;
}
function getProductsByCategory($id_categorie, $produits)
{
    $filtered = [];
    foreach ($produits as $prod) {
        if ($prod['id_categorie'] == $id_categorie) {
            $filtered[] = $prod;
        }
    }
    return $filtered;
}

function addTache(array $tache): void
{
    $taches = getAllTaches();
    $taches[] = $tache;
    $_SESSION['taches'] = $taches;
}

function getTachesByStatut($etat)
{
    $taches = getAllTaches();
    return array_filter($taches, fn($t) => $t['etat'] == $etat);
}

function deleteTache(int $id): void
{
    $taches = getAllTaches();
    foreach ($taches as $key => $tache) {
        if ($tache['id'] == $id) {
            unset($taches[$key]);
            $_SESSION['taches'] = $taches;
        }
    }
}

function marquerTerminer(int $id): void
{
    $taches = getAllTaches();
    foreach ($taches as $key => $tache) {
        if ($tache['id'] == $id) {
            $taches[$key]['etat'] = "terminé";
            $_SESSION['taches'] = $taches;
        }
    }
}
