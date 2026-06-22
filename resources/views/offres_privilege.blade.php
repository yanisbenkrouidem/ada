<?php 
$title = 'Le Club - ADA'; 
require resource_path('views/partials/header.php');

// DonnÃ©es des plans
$plans = [
    [
        'id' => 'access',
        'nom' => 'Access',
        'tagline' => 'L\'essentiel',
        'points' => 2500,
        'price_monthly' => 50,
        'price_yearly' => 540,
        'image' => asset('images/4.jpg'), 
        'benefits' => ['AccÃ¨s prioritaire', '5% de rÃ©duction', 'Service client dÃ©diÃ©']
    ],
    [
        'id' => 'select',
        'nom' => 'Select',
        'tagline' => 'Confort',
        'points' => 5000,
        'price_monthly' => 150,
        'price_yearly' => 1620,
        'image' => asset('images/3.jpeg'),
        'benefits' => ['Surclassement x1', 'Conducteur additionnel', 'AccÃ¨s prioritaire']
    ],
    [
        'id' => 'exclusive',
        'nom' => 'Exclusive',
        'tagline' => 'PremiÃ¨re',
        'points' => 15000,
        'price_monthly' => 300,
        'price_yearly' => 3240,
        'image' => asset('images/2.avif'),
        'benefits' => ['Surclassement illimitÃ©', 'Annulation J-1', 'Lavage inclus']
    ],
    [
        'id' => 'ultimate',
        'nom' => 'Ultimate',
        'tagline' => 'IllimitÃ©',
        'points' => 20000,
        'price_monthly' => 500,
        'price_yearly' => 5400,
        'image' => asset('images/1.avif'),
        'benefits' => ['Statut Gold', 'Service Voiturier', 'AccÃ¨s Lounge', 'Conciergerie 24/7']
    ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* FONTS */
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
            margin: 0; padding: 0;
            overflow-x: hidden;
            padding-top: 100px; /* Espace pour le header fixe */
        }

        /* --- HEADER & NAV --- */
        /* On force le header existant Ã  s'adapter au style LV */
        header {
            background-color: white !important;
            border-bottom: 1px solid #f0f0f0;
            color: black !important;
        }
        header a, header span, header i { color: black !important; }
        header img { filter: brightness(0) !important; } /* Logo noir */

        /* --- TYPOGRAPHIE LV --- */
        .lv-title {
            font-size: 32px;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 10px;
        }
        .lv-subtitle {
            font-size: 13px;
            color: #666;
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        .section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #999;
            margin-bottom: 15px;
            display: block;
        }

        /* --- TOGGLE BUTTONS --- */
        .toggle-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 60px;
            border-bottom: 1px solid #eee;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        .toggle-btn {
            background: none;
            border: none;
            padding-bottom: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            color: #999;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }
        .toggle-btn.active {
            color: #000;
            border-bottom: 2px solid #000;
        }

        /* --- CARDS (PRODUCT STYLE) --- */
        .plan-card {
            cursor: pointer;
            group: true;
        }
        .card-img-container {
            width: 100%;
            aspect-ratio: 3/4; /* Format Portrait Mode */
            overflow: hidden;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            position: relative;
        }
        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .plan-card:hover .card-img {
            transform: scale(1.05);
        }
        
        .plan-name {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .plan-price {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        .btn-discover {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 2px;
            transition: border-color 0.3s;
        }
        .plan-card:hover .btn-discover {
            border-color: #000;
        }

        /* --- HERO --- */
        .club-hero {
            position: relative;
            height: 70vh;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 80px;
        }
        .club-hero img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .club-hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
        }

        /* --- MODAL (Clean White) --- */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px);
            z-index: 9999; display: none; justify-content: center; align-items: center;
            opacity: 0; transition: opacity 0.4s;
        }
        .modal-overlay.active { display: flex; opacity: 1; }
        
        .modal-box {
            background: white;
            width: 100%; max-width: 900px;
            height: auto; max-height: 90vh;
            display: flex;
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
            overflow: hidden;
            transform: translateY(20px); transition: transform 0.4s;
        }
        .modal-overlay.active .modal-box { transform: translateY(0); }

        .modal-img { width: 40%; background: #f5f5f5; object-fit: cover; }
        .modal-content { width: 60%; padding: 50px; overflow-y: auto; display: flex; flex-col; justify-content: space-between; }

        .btn-black {
            background: #000; color: #fff; padding: 15px 0; width: 100%;
            text-align: center; font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.1em;
            margin-top: 20px; transition: 0.3s; cursor: pointer; border: none;
        }
        .btn-black:hover { background: #333; }

        /* --- FOOTER --- */
        footer { border-top: 1px solid #eee; padding-top: 40px; margin-top: 100px; }
    </style>
</head>
<body>

    <section class="club-hero">
        <img src="<?php echo asset('images/montagne.jpg'); ?>" alt="Hero">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="club-hero-content">
            <span class="text-xs font-bold uppercase tracking-[0.3em] mb-4 block">Programme de FidÃ©litÃ©</span>
            <h1 class="text-5xl md:text-7xl font-light mb-6 tracking-wide">LE CLUB ADA</h1>
            <p class="text-lg font-light max-w-xl mx-auto opacity-90">AccÃ©dez Ã  un monde de privilÃ¨ges exclusifs et redÃ©finissez votre expÃ©rience de voyage.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="section-label">La Collection</span>
        <h2 class="lv-title">Choisissez votre Exception</h2>
        <p class="lv-subtitle">
            Une gamme d'abonnements conÃ§ue pour s'adapter Ã  votre rythme de vie. 
            Profitez de tarifs prÃ©fÃ©rentiels et accumulez des points pour des expÃ©riences inoubliables.
        </p>

        <div class="toggle-container">
            <button class="toggle-btn active" id="btn-monthly" onclick="setPeriod('monthly')">Mensuel</button>
            <button class="toggle-btn" id="btn-yearly" onclick="setPeriod('yearly')">Annuel (2 mois offerts)</button>
        </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-12">
            <?php foreach($plans as $index => $plan): ?>
            <div class="plan-card" onclick="openCheckout(<?php echo $index; ?>)">
                <div class="card-img-container">
                    <img src="<?php echo $plan['image']; ?>" class="card-img" alt="<?php echo $plan['nom']; ?>">
                    <div class="absolute top-4 right-4 bg-white px-3 py-1 text-[10px] font-bold uppercase tracking-widest">
                        <?php echo $plan['nom']; ?>
                    </div>
                </div>
                
                <div class="text-center">
                    <h3 class="plan-name"><?php echo $plan['nom']; ?></h3>
                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-2"><?php echo $plan['tagline']; ?></p>
                    
                    <div class="plan-price text-display" 
                         data-monthly="<?php echo $plan['price_monthly']; ?> â‚¬" 
                         data-yearly="<?php echo number_format($plan['price_yearly'], 0, ',', ' '); ?> â‚¬">
                        <?php echo $plan['price_monthly']; ?> â‚¬ <span class="text-xs">/ mois</span>
                    </div>

                    <span class="btn-discover">DÃ©couvrir</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="w-full bg-[#f6f5f3] py-24">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <span class="section-label">ExpÃ©riences</span>
                <h2 class="text-3xl font-light mb-6">Le Simulateur de Voyage.</h2>
                <p class="text-gray-600 mb-8 font-light leading-relaxed">
                    Projetez-vous dans votre prochaine aventure. Estimez vos gains de points en fonction de vos trajets et transformez chaque kilomÃ¨tre en une nouvelle opportunitÃ©.
                </p>
                <button onclick="openSimulator()" class="btn-black max-w-[200px]">Lancer le simulateur</button>
            </div>
            <div class="relative h-[500px]">
                <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=1000" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
            </div>
        </div>
    </div>

    <footer class="text-center pb-10">
        <div class="flex justify-center gap-8 mb-8 text-[10px] font-bold uppercase tracking-widest text-gray-500">
            <a href="#" class="hover:text-black">Conditions GÃ©nÃ©rales</a>
            <a href="#" class="hover:text-black">Politique de ConfidentialitÃ©</a>
            <a href="#" class="hover:text-black">Nous Contacter</a>
        </div>
        <img src="<?php echo asset('images/ADAlogo1.png'); ?>" class="h-6 mx-auto mb-4 opacity-50 block">
        <p class="text-[10px] text-gray-400">&copy; <?php echo date('Y'); ?> ADA. Tous droits rÃ©servÃ©s.</p>
    </footer>

    <div id="modal-checkout" class="modal-overlay">
        <div class="modal-box">
            <img id="modal-img" src="" class="modal-img hidden md:block">
            
            <div class="modal-content relative">
                <button onclick="closeModal('modal-checkout')" class="absolute top-6 right-6 text-gray-400 hover:text-black"><i class="fa-solid fa-xmark text-xl"></i></button>
                
                <div>
                    <span class="section-label mb-2">Votre sÃ©lection</span>
                    <h2 id="modal-title" class="text-3xl font-light mb-2 uppercase">Nom du plan</h2>
                    <p id="modal-tagline" class="text-sm text-gray-500 mb-6 italic">Description</p>
                    
                    <div class="bg-gray-50 p-6 mb-6">
                        <ul id="modal-benefits" class="space-y-3 text-sm text-gray-700"></ul>
                    </div>

                    <div class="flex items-end gap-2 mb-2">
                        <span id="modal-price" class="text-4xl font-light">0â‚¬</span>
                        <span id="modal-period" class="text-sm text-gray-500 mb-1">/ mois</span>
                    </div>
                </div>

                <div id="step-1">
                    <button onclick="toStep2()" class="btn-black">ProcÃ©der au paiement</button>
                </div>

                <div id="step-2" class="hidden">
                    <input type="text" placeholder="NumÃ©ro de carte" class="w-full border-b border-gray-300 py-3 mb-4 outline-none text-sm font-futura">
                    <div class="flex gap-4 mb-6">
                        <input type="text" placeholder="MM/AA" class="w-1/2 border-b border-gray-300 py-3 outline-none text-sm">
                        <input type="text" placeholder="CVC" class="w-1/2 border-b border-gray-300 py-3 outline-none text-sm">
                    </div>
                    <button onclick="processPayment()" id="btn-pay-final" class="btn-black">Payer</button>
                </div>

                <div id="step-3" class="hidden text-center py-10">
                    <i class="fa-solid fa-check text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Bienvenue au Club</h3>
                    <p class="text-sm text-gray-500 mb-6">Votre abonnement est actif.</p>
                    <a href="#" id="final-link" class="underline text-xs font-bold uppercase tracking-widest">AccÃ©der Ã  mon espace</a>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-simulator" class="modal-overlay">
        <div class="bg-white w-full max-w-lg p-10 shadow-2xl relative">
            <button onclick="closeModal('modal-simulator')" class="absolute top-4 right-4 text-gray-400 hover:text-black"><i class="fa-solid fa-xmark"></i></button>
            <h2 class="text-2xl font-light mb-8 text-center uppercase">Simulateur</h2>
            
            <div class="space-y-8">
                <div>
                    <div class="flex justify-between text-xs font-bold uppercase mb-2"><span>Distance</span><span id="sim-dist-display">500 km</span></div>
                    <input type="range" id="sim-dist" min="100" max="5000" step="100" value="500" class="w-full accent-black h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer" oninput="calcSim()">
                </div>
                <div>
                    <div class="flex justify-between text-xs font-bold uppercase mb-2"><span>DurÃ©e</span><span id="sim-days-display">3 jours</span></div>
                    <input type="range" id="sim-days" min="1" max="30" value="3" class="w-full accent-black h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer" oninput="calcSim()">
                </div>
                
                <div class="text-center pt-6 border-top border-gray-100">
                    <p class="text-xs text-gray-400 uppercase tracking-widest mb-2">Gain estimÃ©</p>
                    <p class="text-5xl font-light" id="sim-result">1 500</p>
                    <p class="text-sm text-gray-500">Points</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const plans = <?php echo json_encode($plans); ?>;
        let currentPeriod = 'monthly';
        let currentPlan = null;

        function setPeriod(p) {
            currentPeriod = p;
            document.getElementById('btn-monthly').className = p === 'monthly' ? 'toggle-btn active' : 'toggle-btn';
            document.getElementById('btn-yearly').className = p === 'yearly' ? 'toggle-btn active' : 'toggle-btn';
            
            document.querySelectorAll('.text-display').forEach(el => {
                el.innerHTML = el.getAttribute(`data-${p}`) + ` <span class="text-xs">/ ${p === 'monthly' ? 'mois' : 'an'}</span>`;
            });
        }

        function openCheckout(index) {
            currentPlan = plans[index];
            const price = currentPeriod === 'monthly' ? currentPlan.price_monthly : currentPlan.price_yearly;
            
            document.getElementById('modal-img').src = currentPlan.image;
            document.getElementById('modal-title').innerText = currentPlan.nom;
            document.getElementById('modal-tagline').innerText = currentPlan.tagline;
            document.getElementById('modal-price').innerText = price + 'â‚¬';
            document.getElementById('modal-period').innerText = currentPeriod === 'monthly' ? '/ mois' : '/ an';
            document.getElementById('btn-pay-final').innerText = 'Payer ' + price + 'â‚¬';

            const list = document.getElementById('modal-benefits');
            list.innerHTML = '';
            currentPlan.benefits.forEach(b => list.innerHTML += `<li class="flex items-center gap-3"><i class="fa-solid fa-check text-[10px]"></i> ${b}</li>`);

            // Reset steps
            document.getElementById('step-1').classList.remove('hidden');
            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-3').classList.add('hidden');
            
            document.getElementById('modal-checkout').classList.add('active');
        }

        function toStep2() {
            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');
        }

        function processPayment() {
            const btn = document.getElementById('btn-pay-final');
            btn.innerText = 'Traitement...';
            setTimeout(() => {
                document.getElementById('step-2').classList.add('hidden');
                document.getElementById('step-3').classList.remove('hidden');
                // Link logic (Register or Profile)
                const isLogged = <?php echo session('client_id') ? 'true' : 'false'; ?>;
                const link = isLogged ? "<?php echo route('client.profile'); ?>" : "<?php echo route('client.register.form'); ?>?plan=" + currentPlan.id;
                document.getElementById('final-link').href = link;
            }, 1500);
        }

        function openSimulator() { document.getElementById('modal-simulator').classList.add('active'); calcSim(); }
        
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }

        function calcSim() {
            const d = document.getElementById('sim-dist').value;
            const j = document.getElementById('sim-days').value;
            document.getElementById('sim-dist-display').innerText = d + ' km';
            document.getElementById('sim-days-display').innerText = j + ' jours';
            // Formule fictive : 1km = 1pt, 1j = 100pts
            const total = Math.round(parseInt(d) + (parseInt(j) * 100));
            document.getElementById('sim-result').innerText = new Intl.NumberFormat('fr-FR').format(total);
        }

        // Close on click outside
        document.querySelectorAll('.modal-overlay').forEach(el => {
            el.addEventListener('click', e => { if(e.target === el) el.classList.remove('active'); });
        });
    </script>
</body>
</html>
