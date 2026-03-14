<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Cachée sur mobile -->
        <aside class="hidden md:flex flex-col w-64 bg-slate-900 text-white transition-all duration-300">
            <div class="p-6">
                <h2 class="text-xl font-bold tracking-tight text-blue-400">Gestion des Taches</h2>
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

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-y-auto">
            <!-- Header / Navbar -->
            <header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center sticky top-0 z-10">
                <div class="relative w-full max-w-md">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" placeholder="Rechercher une tâche...">
                </div>
                <div class="flex items-center gap-4 ml-4">
                    <button class="text-gray-500 hover:text-blue-600 transition md:hidden"><i class="fas fa-bars text-xl"></i></button>
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200 text-xs">Admin</div>
                </div>
            </header>

            <div class="p-6 space-y-6">
                <!-- Title & Add Button -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">Détails d'une Tâche</h1>
                    </div>
                </div>


                <!-- div_main -->
<div class="w-full bg-gray-50 p-6">
    <?php 
        $id = $_REQUEST['id'] ?? 0;
        $tache = getTacheById((int)$id);
        
        if (!$tache): 
    ?>
        <div class="bg-red-100 text-red-700 p-4 rounded-lg">Tâche introuvable.</div>
    <?php else: ?>

    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header de la fiche -->
        <div class="bg-gray-800 p-6 text-white flex justify-between items-center">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-300">Détails de la tâche</span>
                <h2 class="text-2xl font-bold"><?= $tache['titre'] ?></h2>
            </div>
            <a href="<?= WEBROOT ?>?page=listtaches" class="text-gray-400 hover:text-white transition">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>

        <!-- Corps de la fiche -->
        <div class="p-8 space-y-6">
            <!-- Description -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase mb-2">Description</h3>
                <p class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <?= $tache['description'] ?>
                </p>
            </div>

            <!-- Infos Temporelles -->
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center gap-3 p-4 border border-gray-100 rounded-xl">
                    <div class="text-blue-500 bg-blue-50 p-3 rounded-lg text-lg">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Créée le</p>
                        <p class="font-semibold text-gray-800"><?= $tache['date_creation'] ?></p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-4 border border-gray-100 rounded-xl">
                    <div class="text-orange-500 bg-orange-50 p-3 rounded-lg text-lg">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Échéance</p>
                        <p class="font-semibold text-gray-800"><?= $tache['date_echeance'] ?></p>
                    </div>
                </div>
            </div>

            <!-- Pied de fiche (Actions) -->
            <div class="pt-6 border-t border-gray-100 flex gap-3 ">
                 <!-- Description -->
            <div class="w-full">
                <h3 class="text-sm font-semibold text-gray-400 uppercase mb-2">Etat</h3>
                <p class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <?= $tache['etat'] ?>
                </p>
            </div>
            
            </div>
               <div class="pt-6 flex flex-col-reverse sm:flex-row justify-end gap-3">
                <a href="<?= WEBROOT ?>?page=supprimer&id=<?= $tache['id'] ?>" 
                   class="bg-red-100 w-full sm:w-auto text-center px-8 py-3.5 text-gray-600 font-semibold hover:bg-red-500 text-white rounded-xl transition-all">
                    Supprimer
                </a>
                <button type="submit" name="terminer" 
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200 transition-all transform active:scale-95">
                    Marquer comme terminée
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

            </div>
        </main>
    </div>
</body>
</html>
