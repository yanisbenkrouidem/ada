<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients - ADA Admin</title>
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
    
    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="bg-white/50 backdrop-blur-md py-4 px-8 flex justify-between items-center sticky top-0 z-20">
            <h1 class="text-2xl font-bold text-gray-800">Base Clients</h1>
        </header>

        <div class="p-8">
            <div class="ecom-card">
                <table class="w-full text-left">
                    <thead class="text-gray-400 text-xs font-bold uppercase border-b border-gray-100">
                        <tr>
                            <th class="pb-4 pl-2">Nom</th>
                            <th class="pb-4">Email</th>
                            <th class="pb-4">Téléphone</th>
                            <th class="pb-4">Ville</th>
                            <th class="pb-4 text-right">Fiche</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php foreach($clients as $c): ?>
                        <tr class="group hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0">
                            <td class="py-4 pl-2 font-bold text-gray-700"><?php echo strtoupper($c->nom) . ' ' . $c->prenom; ?></td>
                            <td class="py-4 text-gray-500"><?php echo $c->email; ?></td>
                            <td class="py-4 text-gray-500"><?php echo $c->telephone; ?></td>
                            <td class="py-4 text-gray-500"><?php echo $c->ville ?? 'N/A'; ?></td>
                            <td class="py-4 text-right"><button class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center hover:bg-black hover:text-white transition-colors"><i class="fa-solid fa-eye"></i></button></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="mt-4">
                    <?php echo $clients->links(); ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>