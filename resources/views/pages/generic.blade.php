<?php 
$title = $page['title'] . ' - ADA'; 
require resource_path('views/layouts/header.blade.php'); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* IMPORT FONTS */
        @font-face {
            font-family: 'FuturaLT';
            src: url('Public/fonts/FuturaLT.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'FuturaLT', 'Futura', sans-serif;
            background-color: #ffffff;
            color: #000;
            overflow-x: hidden;
            padding-top: 100px; /* Espace pour le header fixe */
        }

        /* --- OVERRIDE HEADER POUR CETTE PAGE --- */
        header {
            background-color: white !important;
            border-bottom: 1px solid #f0f0f0;
            color: black !important;
        }
        header a, header span, header i { color: black !important; }
        header img { filter: brightness(0) !important; } /* Logo noir */
        .nav-search-input { background: #f5f5f5 !important; color: black !important; border: 1px solid #e5e5e5 !important; }
        .nav-search-icon-pos { color: #999 !important; }

        /* --- TYPOGRAPHIE --- */
        .lv-heading {
            font-size: 42px;
            font-weight: 300;
            line-height: 1.2;
            letter-spacing: 0.02em;
        }
        .lv-subheading {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #999;
            margin-bottom: 20px;
            display: block;
        }
        .lv-text {
            font-size: 14px;
            line-height: 1.8;
            color: #444;
            font-weight: 400;
        }

        /* --- HERO SECTION --- */
        .page-hero {
            position: relative;
            height: 60vh;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 80px;
        }
        .page-hero img {
            position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
        }
        .page-hero-overlay {
            position: absolute; inset: 0; background: rgba(0,0,0,0.3);
        }
        .page-hero-content {
            position: relative; z-index: 10; text-align: center; color: white;
        }

        /* --- SIDEBAR CONTACT --- */
        .sidebar-box {
            background: #f9f9f9;
            padding: 40px;
            border: 1px solid #eee;
        }

        /* --- FEATURES GRID --- */
        .feature-item {
            border-top: 1px solid #eee;
            padding-top: 30px;
            transition: all 0.3s ease;
        }
        .feature-item:hover { border-top-color: #000; }
        
        .btn-black {
            background: #000; color: #fff; padding: 15px 40px; 
            border-radius: 9999px; font-size: 11px; font-weight: 700; 
            text-transform: uppercase; letter-spacing: 0.1em;
            display: inline-block; transition: all 0.3s;
        }
        .btn-black:hover { background: #333; transform: translateY(-2px); }

        .btn-outline {
            background: transparent; color: #000; padding: 15px 40px; 
            border: 1px solid #e5e5e5; border-radius: 9999px; 
            font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;
            display: inline-block; transition: all 0.3s;
        }
        .btn-outline:hover { border-color: #000; }
    </style>
</head>
<body>

    <div class="page-hero">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2000&auto=format&fit=crop" alt="Hero Background">
        <div class="page-hero-overlay"></div>
        
        <div class="page-hero-content max-w-4xl px-6">
            <span class="text-xs font-bold uppercase tracking-[0.3em] mb-4 block opacity-80">
                <?php echo $page['subtitle'] ?? 'La Maison ADA'; ?>
            </span>
            <h1 class="text-5xl md:text-7xl font-light tracking-wide mb-6">
                <?php echo $page['title']; ?>
            </h1>
            <div class="flex items-center justify-center gap-3 text-[10px] font-bold uppercase tracking-widest text-white/80">
                <a href="/" class="hover:text-white hover:underline">Accueil</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span><?php echo $page['title']; ?></span>
            </div>
        </div>
    </div>

    <div class="max-w-[1200px] mx-auto px-6 mb-24">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <div class="lg:w-2/3">
                <span class="lv-subheading">A Propos</span>
                <h2 class="text-3xl font-light mb-8 flex items-center gap-4">
                    <?php echo $page['title']; ?>
                </h2>
                
                <div class="lv-text space-y-6 text-justify">
                    <p class="font-medium text-black text-lg">
                        <?php echo $page['intro']; ?>
                    </p>
                    <p>
                        Chez ADA, nous nous engageons à offrir une expérience de mobilité fluide et transparente. Que ce soit pour des besoins professionnels ou personnels, nos solutions sont conçues pour s'adapter à votre rythme de vie avec l'élégance et la simplicité qui nous caractérisent.
                    </p>
                    <p>
                        Depuis notre création, nous n'avons cessé d'innover pour proposer des services toujours plus proches de vos attentes, alliant technologie de pointe et savoir-faire humain.
                    </p>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="sidebar-box sticky top-32">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-4 block">Assistance</span>
                    <h3 class="text-lg font-medium mb-4">Besoin d'aide ?</h3>
                    <p class="text-sm text-gray-500 mb-8 leading-relaxed">
                        Nos concierges sont disponibles pour répondre à toutes vos questions et vous accompagner dans votre expérience.
                    </p>
                    
                    <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-200">
                        <i class="fa-solid fa-phone text-xl"></i>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-400">Téléphone</p>
                            <p class="font-medium">01 45 45 45 45</p>
                        </div>
                    </div>

                    <a href="<?php echo route('page.show', 'contact'); ?>" class="btn-black w-full text-center">
                        Nous contacter
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-[#f6f5f3] py-24">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center mb-16">
                <span class="lv-subheading">Savoir-faire</span>
                <h2 class="text-3xl font-light">L'Excellence ADA</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <?php foreach($page['features'] as $feature): ?>
                <div class="feature-item">
                    <div class="mb-6 text-2xl">
                        <i class="fa-solid <?php echo $feature['icon']; ?>"></i>
                    </div>
                    <h4 class="text-lg font-medium mb-3 uppercase tracking-wide text-sm">
                        <?php echo $feature['title']; ?>
                    </h4>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        <?php echo $feature['desc']; ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="py-24 text-center">
        <h2 class="text-3xl font-light mb-8">Prêt à prendre la route ?</h2>
        <div class="flex justify-center gap-6">
            <a href="/" class="btn-black">
                Réserver un véhicule
            </a>
            <a href="<?php echo route('agences.liste'); ?>" class="btn-outline">
                Trouver une agence
            </a>
        </div>
    </div>

    <?php require resource_path('views/layouts/footer.blade.php'); ?>

</body>
</html>
