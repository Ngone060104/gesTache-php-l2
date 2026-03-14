<?php require_once("traitement.php");
require_once("data.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body>
    <!-- div_container-->
    <div class="flex h-screen">
        <!-- div_sidebar -->
          <!-- Sidebar - Cachée sur mobile -->
        <aside class="hidden md:flex flex-col w-64 bg-slate-900 text-white transition-all duration-300">
            <div class="p-6">
                <h2 class="text-2xl font-bold tracking-tight text-blue-400">Gestion des Taches</h2>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="<?=WEBROOT?>?page=listtaches" class="flex items-center gap-3 p-3 bg-blue-600 rounded-lg transition">
                    <i class="fas fa-list-ul w-5"></i>
                    <span>Mes Tâches</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                    <i class="fas fa-chart-pie w-5"></i>
                    <span>Statistiques</span>
                </a>
            </nav>
        </aside>
        <!-- div_main -->
       <!-- div_main -->
<div class="w-full bg-gray-50 overflow-y-auto">
    <!-- Header discret -->
    <div class="p-4 m-2 bg-white shadow-sm border border-gray-200 rounded-xl flex items-center">
        <div class="relative w-full max-w-md">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" class="w-full bg-gray-100 text-gray-700 border-none rounded-lg py-2 pl-10 pr-4 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Rechercher une tâche...">
        </div>
    </div>

    <!-- Formulaire d'Ajout -->
    <div class="max-w-3xl mx-auto mt-8 p-8 bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-8">
            <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                <i class="fas fa-plus-circle text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Nouvelle Tâche</h1>
                <p class="text-sm text-gray-500">Remplissez les détails pour organiser votre travail.</p>
            </div>
        </div>

        <form action="<?= WEBROOT ?>?page=ajout" method="POST" class="space-y-6">
            <!-- Titre -->
            <div>
                <label for="titre" class="block text-sm font-semibold text-gray-700 mb-1">Titre de la tâche</label>
                <input type="text" id="titre" name="titre" 
                    class="w-full border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                    placeholder="Ex: Réunion de projet">
                <?php if(!empty($errorTitre)): ?>
                    <p class="mt-1 text-xs text-red-500 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> <?= $errorTitre ?></p>
                <?php endif; ?>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" 
                    placeholder="Décrivez les étapes clés..."></textarea>
                <?php if(!empty($errorDescription)): ?>
                    <p class="mt-1 text-xs text-red-500 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> <?= $errorDescription ?></p>
                <?php endif; ?>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="date_creation" class="block text-sm font-semibold text-gray-700 mb-1">Date de début</label>
                    <input type="date" id="date_creation" name="date_creation" 
                        class="w-full border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-gray-600">
                    <?php if(!empty($errorDate_Creation)): ?>
                        <p class="mt-1 text-xs text-red-500 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i><?= $errorDate_Creation ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="date_echeance" class="block text-sm font-semibold text-gray-700 mb-1">Échéance</label>
                    <input type="date" id="date_echeance" name="date_echeance" 
                        class="w-full border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-gray-600">
                    <?php if(!empty($errorDate_Echec)): ?>
                        <p class="mt-1 text-xs text-red-500 flex items-center gap-1"> <i class="fas fa-exclamation-circle"></i><?= $errorDate_Echec ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bouton -->
            <div class="pt-4">
                <button type="submit" name="ajouter" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5 active:scale-95">
                    Créer la tâche
                </button>
            </div>
        </form>
    </div>

</body>

</html>