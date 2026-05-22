<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADA Admin - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Schibsted Grotesk', sans-serif; background-color: #F3F4F6; }
        .sidebar-link { display: flex; align-items: center; gap: 14px; padding: 14px 20px; color: #9CA3AF; border-radius: 16px; transition: all 0.3s; margin-bottom: 8px; font-weight: 500; }
        .sidebar-link:hover, .sidebar-link.active { background: #222; color: white; }
        .sidebar-link.active i { color: #F97316; }
        .ecom-card { background: white; border-radius: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); padding: 24px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside class="w-72 bg-[#111111] text-white flex flex-col p-6 hidden md:flex flex-shrink-0">
        <div class="flex items-center gap-3 mb-12 px-2">
            <img src="<?php echo asset('images/ADAlogo1.png'); ?>" class="h-8 filter invert opacity-90"> 
        </div>
        <nav class="flex-1">
            <a href="<?php echo route('admin.dashboard'); ?>" class="sidebar-link active"><i class="fa-solid fa-grid-2"></i> Dashboard</a>
            <a href="<?php echo route('admin.vehicules'); ?>" class="sidebar-link"><i class="fa-solid fa-car"></i> Véhicules</a>
            <a href="<?php echo route('admin.clients'); ?>" class="sidebar-link"><i class="fa-solid fa-users"></i> Clients</a>
            <a href="<?php echo route('admin.feedbacks'); ?>" class="sidebar-link relative">
                <i class="fa-solid fa-envelope"></i> Feedbacks
                <span class="absolute right-4 bg-orange-500 text-white text-[10px] px-2 py-0.5 rounded-full"><?php echo count($feedbacks); ?></span>
            </a>
        </nav>
        <div class="p-4 bg-[#1A1A1A] rounded-2xl mt-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-orange-400 to-red-500 flex items-center justify-center font-bold text-white text-sm">YB</div>
            <div class="overflow-hidden">
                <p class="text-sm font-bold text-white truncate"><?php echo auth()->user()->name ?? 'Admin'; ?></p>
                <p class="text-xs text-gray-500">Administrateur</p>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="bg-white/50 backdrop-blur-md py-4 px-8 flex justify-between items-center sticky top-0 z-20">
            <h1 class="text-2xl font-bold text-gray-800">Vue d'ensemble</h1>
            <a href="/" class="text-sm font-bold text-gray-500 hover:text-black">Aller sur le site <i class="fa-solid fa-arrow-up-right-from-square ml-1"></i></a>
        </header>

        <div class="p-6 md:p-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="ecom-card">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Chiffre d'Affaire</span>
                        <div class="w-8 h-8 rounded-full bg-green-50 text-green-500 flex items-center justify-center"><i class="fa-solid fa-euro-sign"></i></div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-2"><?php echo number_format($stats['revenue'], 0, ',', ' '); ?> €</h3>
                    <div class="flex items-center gap-2 text-xs"><span class="text-gray-400">Total cumulé</span></div>
                </div>

                <div class="ecom-card">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Locations</span>
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center"><i class="fa-solid fa-cart-shopping"></i></div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-2"><?php echo $stats['rentals_month']; ?></h3>
                    <div class="flex items-center gap-2 text-xs">
                        <?php if($stats['rental_growth'] >= 0): ?>
                            <span class="bg-green-100 text-green-600 px-2 py-0.5 rounded">+<?php echo $stats['rental_growth']; ?>%</span>
                        <?php else: ?>
                            <span class="bg-red-100 text-red-500 px-2 py-0.5 rounded"><?php echo $stats['rental_growth']; ?>%</span>
                        <?php endif; ?>
                        <span class="text-gray-400">vs mois dernier</span>
                    </div>
                </div>

                <div class="ecom-card">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Clients</span>
                        <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-500 flex items-center justify-center"><i class="fa-solid fa-users"></i></div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-2"><?php echo $stats['total_clients']; ?></h3>
                    <div class="flex items-center gap-2 text-xs"><span class="text-gray-400">Inscrits en base</span></div>
                </div>

                <div class="ecom-card relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-orange-400 to-red-500 opacity-10 rounded-bl-full"></div>
                    <div class="flex justify-between items-start mb-2 relative z-10">
                        <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Avis Clients</span>
                        <div class="w-8 h-8 rounded-full bg-yellow-50 text-yellow-500 flex items-center justify-center"><i class="fa-solid fa-star"></i></div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-2 relative z-10"><?php echo $stats['average_rating']; ?> <span class="text-lg text-gray-400 font-normal">/5</span></h3>
                    <div class="flex items-center gap-2 text-xs relative z-10"><span class="text-gray-400">Basé sur <?php echo count($feedbacks); ?> avis</span></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="ecom-card lg:col-span-2">
                    <div class="flex justify-between items-center mb-6"><h3 class="text-lg font-bold text-gray-800">Revenus (7 derniers jours)</h3></div>
                    <div class="w-full h-[300px]"><canvas id="mainChart"></canvas></div>
                </div>

                <div class="ecom-card flex flex-col">
                    <div class="flex justify-between items-center mb-6"><h3 class="text-lg font-bold text-gray-800">Derniers Avis</h3></div>
                    <div class="flex-1 overflow-y-auto pr-2 space-y-4 max-h-[300px] custom-scroll">
                        <?php foreach($feedbacks as $f): ?>
                            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors border border-gray-100">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-sm font-bold text-gray-500 flex-shrink-0"><?php echo strtoupper(substr($f->rating, 0, 1)); ?></div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-center"><p class="text-sm font-bold text-gray-800 truncate"><?php echo $f->rating; ?></p><span class="text-[10px] text-gray-400"><?php echo date('d/m', strtotime($f->created_at)); ?></span></div>
                                    <p class="text-xs text-gray-400 truncate"><?php echo $f->ip_address ?? 'Client'; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if($feedbacks->isEmpty()): ?><div class="text-center py-10 text-gray-400 text-sm">Aucun avis pour le moment.</div><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="ecom-card">
                <div class="flex justify-between items-center mb-6"><h3 class="text-lg font-bold text-gray-800">Véhicules les plus loués</h3></div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="text-gray-400 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                            <tr><th class="pb-3 pl-2">Véhicule</th><th class="pb-3">Catégorie</th><th class="pb-3">Prix/Jour</th><th class="pb-3">Total Locations</th><th class="pb-3">Revenus</th><th class="pb-3 text-right pr-4">Statut</th></tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php foreach($topVehicules as $v): ?>
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-3 pl-2 flex items-center gap-3">
                                    <div class="w-12 h-8 rounded bg-gray-200 overflow-hidden flex items-center justify-center">
                                        <?php if($v->photo): ?>
                                            <img src="<?php echo asset('images/' . $v->photo); ?>" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/100x60?text=Car'">
                                        <?php else: ?><i class="fa-solid fa-car text-gray-400"></i><?php endif; ?>
                                    </div>
                                    <div><span class="font-bold text-gray-700 block"><?php echo $v->marque . ' ' . $v->modele; ?></span><span class="text-[10px] text-gray-400"><?php echo $v->immat; ?></span></div>
                                </td>
                                <td class="py-3 text-gray-500"><?php echo $v->categorie_nom; ?></td>
                                <td class="py-3 font-bold text-gray-800"><?php echo $v->tarifjournee; ?> €</td>
                                <td class="py-3 font-bold text-blue-600 pl-4"><?php echo $v->total_locations; ?></td> <td class="py-3 font-bold text-green-600"><?php echo number_format($v->revenu_genere, 0, ',', ' '); ?> €</td>
                                <td class="py-3 text-right pr-4">
                                    <?php if($v->statut === 'Disponible'): ?><span class="px-2 py-1 rounded bg-green-100 text-green-600 text-[10px] font-bold uppercase">Dispo</span>
                                    <?php else: ?><span class="px-2 py-1 rounded bg-red-100 text-red-600 text-[10px] font-bold uppercase">Louée</span><?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        const chartLabels = <?php echo json_encode($stats['chart_labels']); ?>;
        const chartData = <?php echo json_encode($stats['chart_data']); ?>;
        const ctx = document.getElementById('mainChart').getContext('2d');
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(249, 115, 22, 0.2)');
        gradient.addColorStop(1, 'rgba(249, 115, 22, 0)');

        new Chart(ctx, {
            type: 'line',
            data: { labels: chartLabels, datasets: [{ label: 'Revenus (€)', data: chartData, borderColor: '#F97316', backgroundColor: gradient, borderWidth: 3, tension: 0.4, fill: true, pointBackgroundColor: '#fff', pointBorderColor: '#F97316', pointBorderWidth: 2, pointRadius: 5 }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { borderDash: [5, 5], color: '#f3f4f6' } }, x: { grid: { display: false } } } }
        });
    </script>
</body>
</html>