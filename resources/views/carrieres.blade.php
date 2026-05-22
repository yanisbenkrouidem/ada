<?php 
$title = 'Carrières - ADA'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADA Carrières</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @font-face {
            font-family: 'FuturaLT';
            src: url('Public/fonts/FuturaLT.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'FuturaLT', sans-serif;
            background-color: #ffffff;
            color: #000;
            margin: 0; padding: 0;
            scroll-behavior: smooth;
        }

        /* HEADER FIXE */
        .header-jobs {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 40px; background: white; position: fixed;
            top: 0; left: 0; width: 100%; z-index: 100;
            border-bottom: 1px solid #f0f0f0;
        }
        .logo-main { font-size: 24px; letter-spacing: 2px; font-weight: 500; line-height: 1; text-align: center; }
        .logo-sub { font-size: 10px; letter-spacing: 3px; font-weight: 700; text-align: center; margin-top: 2px; }
        .nav-left a { font-size: 12px; font-weight: 600; margin-right: 25px; text-decoration: none; color: black; }
        .btn-offers { border: 1px solid #000; border-radius: 30px; padding: 8px 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; transition: 0.3s; }
        .btn-offers:hover { background: #000; color: #fff; }

        /* HERO & SEARCH */
        .hero-section {
            position: relative; height: 90vh; width: 100%;
            display: flex; align-items: center; justify-content: center;
            padding-top: 60px;
        }
        .hero-bg {
            position: absolute; inset: 0; object-fit: cover;
            background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000'); 
            background-size: cover; background-position: center;
        }

        /* SEARCH CAPSULE */
        .search-panel {
            position: relative; z-index: 10; background: white;
            border-radius: 20px; width: 95%; max-width: 1150px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 40px 30px;
            animation: fadeUp 0.6s ease-out;
        }
        .panel-title { font-size: 26px; font-weight: 300; margin-bottom: 30px; text-align: center; color: #000; }

        .search-row { display: flex; align-items: center; width: 100%; gap: 0; border: 1px solid #eee; border-radius: 12px; padding: 5px; }
        
        .input-wrapper {
            flex: 1; position: relative; border-right: 1px solid #f0f0f0;
            padding: 0 20px; height: 50px; display: flex; align-items: center;
        }
        .input-wrapper:last-child { border-right: none; }
        
        .input-wrapper input {
            width: 100%; height: 100%; border: none; outline: none;
            font-size: 13px; color: #000; background: transparent; font-weight: 500; cursor: pointer;
        }
        .input-wrapper input::placeholder { color: #999; font-weight: 400; }
        .icon-left { margin-right: 10px; color: #000; font-size: 14px; }
        .icon-chevron { margin-left: auto; color: #000; font-size: 10px; pointer-events: none; }

        /* DROPDOWNS */
        .suggestions-list {
            position: absolute; top: 110%; left: 0; width: 100%;
            background: white; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-height: 0; overflow: hidden; transition: max-height 0.3s ease; z-index: 50;
            border: 1px solid #f0f0f0;
        }
        .suggestions-list.active { max-height: 300px; overflow-y: auto; padding: 5px 0; }
        
        .suggestion-item {
            padding: 10px 20px; font-size: 13px; color: #333; cursor: pointer;
            display: flex; justify-content: space-between; align-items: center;
        }
        .suggestion-item:hover { background-color: #f5f5f5; font-weight: 600; }

        /* BUTTONS */
        .search-actions { margin-left: 15px; display: flex; gap: 10px; }
        .btn-search-main {
            background: #000; color: #fff; height: 48px; padding: 0 40px;
            border-radius: 10px; font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.05em; transition: 0.3s;
        }
        .btn-search-main:hover { background: #333; }
        .btn-reset {
            width: 48px; height: 48px; border-radius: 10px; border: 1px solid #eee;
            display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s;
        }
        .btn-reset:hover { background: #f9f9f9; color: red; border-color: red; }

        /* TAGS RAPIDES */
        .quick-tags { display: flex; justify-content: center; gap: 10px; margin-top: 20px; flex-wrap: wrap; }
        .tag-pill-btn {
            background: #f3f4f6; padding: 6px 12px; border-radius: 20px; font-size: 11px; 
            font-weight: 600; color: #555; cursor: pointer; transition: all 0.2s; border: 1px solid transparent;
        }
        .tag-pill-btn:hover { background: #e5e7eb; color: #000; border-color: #d1d5db; }

        /* JOBS GRID */
        .jobs-section { padding: 80px 40px; max-width: 1400px; margin: 0 auto; }
        .jobs-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        .jobs-title { font-size: 28px; font-weight: 300; }
        .jobs-count { font-size: 12px; font-weight: 700; color: #666; text-transform: uppercase; }

        .jobs-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
        
        .job-card {
            background: white; border: 1px solid #eee; padding: 30px;
            transition: all 0.3s; position: relative; display: flex; flex-direction: column; min-height: 250px;
        }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.05); border-color: transparent; }
        
        .tag-pill {
            display: inline-block; padding: 4px 10px; background: #f5f5f5; color: #666;
            font-size: 10px; font-weight: 700; text-transform: uppercase; border-radius: 4px; margin-bottom: 15px;
        }
        .card-title { font-size: 20px; font-weight: 400; margin-bottom: 10px; line-height: 1.3; }
        .card-info { font-size: 13px; color: #666; margin-bottom: 25px; display: flex; align-items: center; gap: 5px; }
        .card-link { margin-top: auto; font-size: 11px; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid #eee; align-self: flex-start; padding-bottom: 2px; }

        /* VIDEO */
        .video-block { position: relative; height: 500px; background: black; overflow: hidden; display: flex; align-items: center; justify-content: center; text-align: center; color: white; }
        .video-overlay { position: absolute; inset: 0; opacity: 0.6; background: url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2000') center/cover; }
        .video-content { position: relative; z-index: 10; padding: 0 20px; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 1024px) {
            .search-row { flex-direction: column; border: none; gap: 10px; padding: 0; }
            .input-wrapper { width: 100%; border: 1px solid #eee; border-radius: 8px; }
            .jobs-grid { grid-template-columns: 1fr; }
            .nav-left { display: none; }
            .search-panel { padding: 20px; }
        }
    </style>
</head>
<body>

    <header class="header-jobs">
        <nav class="nav-left hidden md:block">
            <a href="<?php echo route('home'); ?>">La Maison</a>
            <a href="#">Les Métiers</a>
            <a href="#">Actualités</a>
        </nav>
        <div class="absolute left-1/2 -translate-x-1/2 text-center">
            <div class="logo-main">ADA</div>
            <div class="logo-sub">JOBS</div>
        </div>
        <button onclick="document.getElementById('jobs-anchor').scrollIntoView()" class="btn-offers">Toutes les offres</button>
    </header>

    <section class="hero-section">
        <div class="hero-bg"></div>

        <div class="search-panel">
            <h1 class="panel-title">Votre prochain voyage commence ici</h1>
            
            <div class="flex flex-col lg:flex-row gap-4">
                <div class="search-row flex-1">
                    
                    <div class="input-wrapper relative">
                        <i class="fa-solid fa-magnifying-glass icon-left"></i>
                        <input type="text" id="search-keyword" placeholder="Poste, mot-clé..." autocomplete="off">
                        <div class="suggestions-list" id="list-keyword">
                            </div>
                    </div>

                    <div class="input-wrapper relative">
                        <i class="fa-solid fa-location-dot icon-left"></i>
                        <input type="text" id="search-location" placeholder="Ville ou Région" autocomplete="off" onfocus="showSuggestions('list-location')">
                        <i class="fa-solid fa-chevron-down icon-chevron"></i>
                        <div class="suggestions-list" id="list-location">
                            <div class="suggestion-item" onclick="setSearchParam('search-location', 'Toute la France')">🌍 Toute la France</div>
                            <div class="suggestion-item" onclick="setSearchParam('search-location', 'Mâcon')">📍 <strong>Mâcon</strong> <small>Bourgogne</small></div>
                            <div class="suggestion-item" onclick="setSearchParam('search-location', 'Chalon-sur-Saône')">📍 <strong>Chalon-sur-Saône</strong> <small>Bourgogne</small></div>
                            <div class="suggestion-item" onclick="setSearchParam('search-location', 'Paris')">📍 Paris <small>Île-de-France</small></div>
                            <div class="suggestion-item" onclick="setSearchParam('search-location', 'Lyon')">📍 Lyon <small>Auvergne-Rhône-Alpes</small></div>
                        </div>
                    </div>

                    <div class="input-wrapper relative" style="flex: 0.6;">
                        <input type="text" id="search-contract" placeholder="Contrat" readonly style="cursor: pointer;" onclick="showSuggestions('list-contract')">
                        <i class="fa-solid fa-chevron-down icon-chevron"></i>
                        <div class="suggestions-list" id="list-contract">
                            <div class="suggestion-item" onclick="setSearchParam('search-contract', 'Tous types')">Tous types</div>
                            <div class="suggestion-item" onclick="setSearchParam('search-contract', 'CDI')">CDI</div>
                            <div class="suggestion-item" onclick="setSearchParam('search-contract', 'CDD')">CDD</div>
                            <div class="suggestion-item" onclick="setSearchParam('search-contract', 'Alternance')">Alternance</div>
                            <div class="suggestion-item" onclick="setSearchParam('search-contract', 'Stage')">Stage</div>
                        </div>
                    </div>
                </div>

                <div class="search-actions">
                    <button class="btn-reset" onclick="resetSearch()" title="Réinitialiser"><i class="fa-solid fa-rotate-right"></i></button>
                    <button class="btn-search-main" onclick="runSearch()">Rechercher</button>
                </div>
            </div>

            <div class="quick-tags">
                <div class="tag-pill-btn" onclick="quickSearch('', 'Mâcon', '')">📍 Postes à Mâcon</div>
                <div class="tag-pill-btn" onclick="quickSearch('', 'Chalon', '')">📍 Postes à Chalon</div>
                <div class="tag-pill-btn" onclick="quickSearch('', '', 'CDI')">📄 Tous les CDI</div>
                <div class="tag-pill-btn" onclick="quickSearch('Manager', '', '')">👔 Management</div>
                <div class="tag-pill-btn" onclick="quickSearch('Préparateur', '', '')">🚗 Flotte & Auto</div>
            </div>
        </div>
    </section>

    <div id="jobs-anchor" class="jobs-section">
        <div class="jobs-header">
            <h2 class="jobs-title">Opportunités disponibles</h2>
            <span class="jobs-count" id="jobs-counter">Chargement...</span>
        </div>

        <div class="jobs-grid" id="jobs-container">
            </div>
        
        <div id="no-results" class="hidden text-center py-20">
            <i class="fa-regular fa-face-frown text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 mb-6">Aucune offre ne correspond exactement.</p>
            <button onclick="resetSearch()" class="text-sm font-bold underline hover:text-blue-600">Voir toutes les offres disponibles</button>
        </div>
    </div>

    <section class="video-block">
        <div class="video-overlay"></div>
        <div class="video-content">
            <span class="text-xs uppercase tracking-[0.2em] mb-4 block">Inside ADA</span>
            <h2 class="text-4xl mb-8 font-light">Découvrez le quotidien de nos équipes</h2>
            <button class="border border-white px-8 py-3 rounded-full text-xs font-bold uppercase hover:bg-white hover:text-black transition">Voir la vidéo</button>
        </div>
    </section>

    <footer class="py-10 text-center text-xs text-gray-400 border-t">
        &copy; <?php echo date('Y'); ?> ADA France. Tous droits réservés.
    </footer>

    <script>
        /* --- 1. BASE DE DONNÉES SIMULÉE (OFFRES MÂCON & CHALON) --- */
        const jobsDB = [
            { id: 1, title: "Responsable d'Agence", city: "Mâcon", region: "Bourgogne", type: "CDI", dept: "Management", date: "Il y a 2 jours" },
            { id: 2, title: "Agent de Comptoir", city: "Chalon-sur-Saône", region: "Bourgogne", type: "CDD", dept: "Vente", date: "Aujourd'hui" },
            { id: 3, title: "Préparateur de Véhicules", city: "Mâcon", region: "Bourgogne", type: "CDI", dept: "Opérations", date: "Il y a 3 jours" },
            { id: 4, title: "Conseiller Commercial", city: "Chalon-sur-Saône", region: "Bourgogne", type: "Alternance", dept: "Vente", date: "Il y a 1 semaine" },
            { id: 5, title: "Responsable Régional", city: "Lyon", region: "Auvergne", type: "CDI", dept: "Management", date: "Il y a 1 semaine" },
            { id: 6, title: "Développeur Web Fullstack", city: "Paris (Siège)", region: "IDF", type: "CDI", dept: "Digital", date: "Il y a 3 jours" },
            { id: 7, title: "Assistant(e) RH", city: "Paris (Siège)", region: "IDF", type: "Stage", dept: "Support", date: "Hier" },
            { id: 8, title: "Chef de Parc Automobile", city: "Mâcon", region: "Bourgogne", type: "CDI", dept: "Opérations", date: "Il y a 1 mois" },
            { id: 9, title: "Chargé de Clientèle", city: "Dijon", region: "Bourgogne", type: "CDD", dept: "Vente", date: "Il y a 2 semaines" },
            { id: 10, title: "Comptable Fournisseurs", city: "Paris (Siège)", region: "IDF", type: "CDI", dept: "Finance", date: "Il y a 4 jours" },
            { id: 11, title: "Agent de Location", city: "Lyon", region: "Auvergne", type: "CDD", dept: "Vente", date: "Aujourd'hui" },
            { id: 12, title: "Manager Junior", city: "Bordeaux", region: "Aquitaine", type: "Alternance", dept: "Management", date: "Il y a 6 jours" },
            { id: 13, title: "Mécanicien Flotte", city: "Mâcon", region: "Bourgogne", type: "CDI", dept: "Opérations", date: "Il y a 2 jours" },
            { id: 14, title: "Responsable Adjoint", city: "Chalon-sur-Saône", region: "Bourgogne", type: "CDI", dept: "Management", date: "Hier" },
            { id: 15, title: "Stagiaire Marketing", city: "Paris", region: "IDF", type: "Stage", dept: "Digital", date: "Il y a 1 jour" }
        ];

        /* --- 2. FONCTIONS D'AFFICHAGE --- */
        function renderJobs(jobs) {
            const container = document.getElementById('jobs-container');
            const counter = document.getElementById('jobs-counter');
            const noResults = document.getElementById('no-results');

            container.innerHTML = '';
            
            if (jobs.length === 0) {
                container.classList.add('hidden');
                noResults.classList.remove('hidden');
                counter.innerText = '0 OFFRE';
                return;
            }

            container.classList.remove('hidden');
            noResults.classList.add('hidden');
            counter.innerText = jobs.length + (jobs.length > 1 ? ' OFFRES' : ' OFFRE');

            jobs.forEach(job => {
                const html = `
                    <div class="job-card group">
                        <div>
                            <span class="tag-pill">${job.dept}</span>
                            <h3 class="card-title group-hover:underline">${job.title}</h3>
                            <div class="card-info">
                                <i class="fa-solid fa-location-dot"></i> ${job.city} 
                                <span class="mx-2">•</span> 
                                <span class="font-bold text-black">${job.type}</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-end w-full">
                            <span class="card-link group-hover:border-black">Voir l'offre</span>
                            <span class="text-[10px] text-gray-400 font-bold uppercase">${job.date}</span>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });
        }

        /* --- 3. MOTEUR DE RECHERCHE --- */
        function runSearch() {
            const keyword = document.getElementById('search-keyword').value.toLowerCase();
            const location = document.getElementById('search-location').value.toLowerCase();
            const contract = document.getElementById('search-contract').value;

            const btn = document.querySelector('.btn-search-main');
            btn.innerText = '...';

            setTimeout(() => {
                btn.innerText = 'Rechercher';
                
                const filtered = jobsDB.filter(job => {
                    // Logique permissive : si le champ est vide, on ignore le filtre
                    const matchKey = !keyword || job.title.toLowerCase().includes(keyword) || job.dept.toLowerCase().includes(keyword);
                    
                    // Match Ville : "chalon" trouve "Chalon-sur-Saône"
                    const matchLoc = !location || location === 'toute la france' || job.city.toLowerCase().includes(location) || job.region.toLowerCase().includes(location);
                    
                    const matchType = !contract || contract === 'Tous types' || job.type === contract;

                    return matchKey && matchLoc && matchType;
                });

                renderJobs(filtered);
                document.getElementById('jobs-anchor').scrollIntoView({ behavior: 'smooth' });
            }, 300);
        }

        /* --- 4. INTERACTION UI --- */
        function showSuggestions(id) {
            closeAllDropdowns();
            document.getElementById(id).classList.add('active');
        }

        function setSearchParam(inputId, val) {
            document.getElementById(inputId).value = val;
            closeAllDropdowns();
        }

        function quickSearch(key, loc, type) {
            if(key) document.getElementById('search-keyword').value = key;
            if(loc) document.getElementById('search-location').value = loc;
            if(type) document.getElementById('search-contract').value = type;
            runSearch();
        }

        function resetSearch() {
            document.getElementById('search-keyword').value = '';
            document.getElementById('search-location').value = '';
            document.getElementById('search-contract').value = '';
            renderJobs(jobsDB);
            document.getElementById('jobs-anchor').scrollIntoView({ behavior: 'smooth' });
        }

        function closeAllDropdowns() {
            document.querySelectorAll('.suggestions-list').forEach(el => el.classList.remove('active'));
        }

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.input-wrapper')) closeAllDropdowns();
        });

        // INIT
        renderJobs(jobsDB);

    </script>
</body>
</html>