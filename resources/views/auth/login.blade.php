<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - ADA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Schibsted Grotesk', sans-serif; background: #000; color: white; }</style>
</head>
<body class="h-screen flex items-center justify-center relative overflow-hidden">
    
    <div class="absolute inset-0 z-0">
        <img src="<?php echo asset('images/montagne.jpg'); ?>" class="w-full h-full object-cover opacity-40">
    </div>

    <div class="relative z-10 w-full max-w-md p-8 bg-black/80 border border-white/10 rounded-3xl backdrop-blur-xl shadow-2xl">
        <div class="text-center mb-8">
            <img src="<?php echo asset('images/ADAlogo1.png'); ?>" class="h-8 mx-auto mb-6 filter invert opacity-80">
            <h1 class="text-2xl font-bold">Administration</h1>
            <p class="text-gray-400 text-sm mt-2">Accès réservé au personnel.</p>
        </div>

        <form action="<?php echo url('/login'); ?>" method="POST" class="space-y-5">
            <?php echo csrf_field(); ?>
            
            <div>
                <input type="email" name="email" required class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white outline-none focus:border-orange-500 transition-colors placeholder-gray-500" placeholder="Email">
                <?php if($errors->has('email')): ?>
                    <p class="text-red-500 text-xs mt-2 pl-1"><?php echo $errors->first('email'); ?></p>
                <?php endif; ?>
            </div>

            <div>
                <input type="password" name="password" required class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white outline-none focus:border-orange-500 transition-colors placeholder-gray-500" placeholder="Mot de passe">
            </div>

            <button type="submit" class="w-full bg-white text-black font-bold py-3.5 rounded-xl hover:bg-gray-200 transition-colors mt-4">
                Se connecter
            </button>
        </form>
    </div>
</body>
</html>