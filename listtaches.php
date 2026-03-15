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

        body {
            font-family: 'Inter', sans-serif;
        }
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
                <a href="<?= WEBROOT ?>?page=listtaches" class="flex items-center gap-3 p-3 bg-blue-600 rounded-lg transition">
                    <i class="fas fa-list-ul w-5"></i>
                    <span>Mes Tâches</span>
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
                <!-- Titre et Bouton -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">Liste des Tâches</h1>
                        <p class="text-sm text-slate-500">Gérez vos priorités quotidiennes efficacement.</p>
                    </div>
                    <a href="<?= WEBROOT ?>?page=ajout" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-sm transition-all transform active:scale-95">
                        <i class="fas fa-plus mr-2"></i> Ajouter une tâche
                    </a>
                </div>

                <!-- Filters -->
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-wrap gap-3 items-center">
                    <form action="<?= WEBROOT ?>" method="GET" class="p-4 rounded-2xl  flex flex-wrap gap-3 items-center">
                        <!-- Champ caché pour dire à l'index.php qu'on veut filtrer -->
                        <input type="hidden" name="page" value="filtre">
                        <div class="relative min-w-[200px]">
                            <select name="etat" id="etat" class="appearance-none w-full bg-white border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Tous les états</option>
                                <option value="en cours">en cours</option>
                                <option value="terminé">terminé</option>
                                <option value="en attente">en attente</option>
                                <option value="à faire">à faire</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        <button type="submit" class="px-5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition cursor-pointer">
                            <i class="fas fa-filter mr-2"></i> Filtrer par Etat
                        </button>
                    </form>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase text-slate-500">Titre</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase text-slate-500">Création</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase text-slate-500">Échéance</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase text-slate-500 text-center">État</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase text-slate-500 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($taches as $tache): ?>
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="px-6 py-4 font-medium text-slate-800  <?= $tache['etat'] == 'terminé' ? 'line-through text-slate-400' : 'text-slate-800' ?>"><?= $tache['titre'] ?></td>
                                        <td class="px-6 py-4 text-slate-500 text-sm"><?= $tache['date_creation'] ?></td>
                                        <td class="px-6 py-4 text-slate-500 text-sm italic"><?= $tache['date_echeance'] ?></td>
                                        <td class="px-6 py-4 text-center">
                                            <?php
                                            $colors = [
                                                'terminé'    => 'bg-green-100 text-green-700 border-green-200',
                                                'en cours'   => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'à faire'    => 'bg-gray-100 text-gray-700 border-gray-200',
                                                'en attente' => 'bg-amber-100 text-amber-700 border-amber-200'
                                            ];
                                            $badgeStyle = $colors[$tache['etat']] ?? 'bg-slate-100 text-slate-600';
                                            ?>
                                            <span class="px-3 py-1 rounded-full text-xs font-bold border <?= $badgeStyle ?>">
                                                <?= $tache['etat'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="<?= WEBROOT ?>?page=detail&id=<?= $tache['id'] ?>" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition" title="Voir"><i class="fas fa-eye"></i></a>
                                                <a href="<?= WEBROOT ?>?page=terminé&id=<?= $tache['id'] ?>" class="p-2 text-green-500 hover:bg-green-50 rounded-lg transition" title="Terminer"><i class="fas fa-check"></i></a>
                                                <a href="<?= WEBROOT ?>?page=supprimer&id=<?= $tache['id'] ?>" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Supprimer"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>


                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>