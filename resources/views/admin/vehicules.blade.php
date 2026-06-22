<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VÃ©hicules - Ada Location Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            <a href="<?php echo route('admin.dashboard'); ?>" class="sidebar-link"><i class="fa-solid fa-grid-2"></i> Dashboard</a>
            <a href="<?php echo route('admin.vehicules'); ?>" class="sidebar-link active"><i class="fa-solid fa-car"></i> VÃ©hicules</a>
            <a href="<?php echo route('admin.clients'); ?>" class="sidebar-link"><i class="fa-solid fa-users"></i> Clients</a>
            <a href="<?php echo route('admin.feedbacks'); ?>" class="sidebar-link relative">
                <i class="fa-solid fa-envelope"></i> Feedbacks
            </a>
        </nav>
        <div class="p-4 bg-[#1A1A1A] rounded-2xl mt-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-orange-400 to-red-500 flex items-center justify-center font-bold text-white text-sm">YB</div>
            <div class="overflow-hidden"><p class="text-sm font-bold text-white truncate"><?php echo auth()->user()->name ?? 'Admin'; ?></p><p class="text-xs text-gray-500">Administrateur</p></div>
        </div>
    </aside>
    
    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="bg-white/50 backdrop-blur-md py-4 px-8 flex justify-between items-center sticky top-0 z-20">
            <h1 class="text-2xl font-bold text-gray-800">Flotte Automobile</h1>
        </header>

        <div class="p-8">
            <div class="ecom-card">
                <table class="w-full text-left">
                    <thead class="text-gray-400 text-xs font-bold uppercase border-b border-gray-100">
                        <tr>
                            <th class="pb-4 pl-2">ModÃ¨le</th>
                            <th class="pb-4">Immatriculation</th>
                            <th class="pb-4">CatÃ©gorie</th>
                            <th class="pb-4">Agence</th>
                            <th class="pb-4">Tarif/J</th>
                            <th class="pb-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php foreach($vehicules as $v): ?>
                        <tr class="group hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0">
                            <td class="py-4 pl-2 flex items-center gap-3">
                                <div class="w-12 h-8 rounded bg-gray-100 overflow-hidden flex items-center justify-center">
                                    <img src="<?php echo asset('images/' . $v->photo); ?>" class="w-full h-full object-cover" onerror="this.style.display='none'">
                                </div>
                                <span class="font-bold text-gray-700"><?php echo $v->marque . ' ' . $v->modele; ?></span>
                            </td>
                            <td class="py-4 font-mono text-gray-500"><?php echo $v->immat; ?></td>
                            <td class="py-4"><span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-bold"><?php echo $v->categorie; ?></span></td>
                            <td class="py-4 text-gray-500"><i class="fa-solid fa-location-dot mr-1"></i> <?php echo $v->agence_ville; ?></td>
                            <td class="py-4 font-bold"><?php echo $v->tarifjournee; ?> â‚¬</td>
                            <td class="py-4 text-right"><button class="text-gray-400 hover:text-orange-500"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="mt-4">
                    <?php echo $vehicules->links(); ?> 
                </div>
            </div>
        </div>
    </main>
</body>
</html>
