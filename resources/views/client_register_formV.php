<?php 
// Page Standalone Inscription - Style Classique (Bleu)
// On ne charge PAS le header ici pour éviter les conflits de design
$errors = session('errors');
?>
<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - ADA France</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* RESET & BASE */
        body { font-family: 'Lato', sans-serif; background: #000; overflow-x: hidden; overflow-y: auto; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }

        /* ANIMATIONS */
        .slide-in-card {
            animation: slideCard 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            transform: translateY(20px);
            opacity: 0;
        }
        .fade-in-text {
            opacity: 0;
            animation: fadeIn 1s ease-out 0.4s forwards;
        }
        @keyframes slideCard { to { transform: translateY(0); opacity: 1; } }
        @keyframes fadeIn { to { opacity: 1; } }

        /* SHAKE ANIMATION POUR LES ERREURS */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
        .shake-input {
            animation: shake 0.4s ease-in-out;
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        /* TOAST NOTIFICATION (POP UP UX - ERREURS) */
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column; /* Empile les erreurs verticalement */
            gap: 10px;
            pointer-events: none; /* Permet de cliquer à travers si transparent */
        }
        .ux-toast {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border-left: 4px solid #ef4444;
            padding: 12px 16px;
            border-radius: 4px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 12px;
            font-weight: 600;
            color: #333;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            max-width: 320px;
        }
        .ux-toast.show {
            transform: translateX(0);
            opacity: 1;
        }
        .ux-toast i {
            color: #ef4444;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* INPUTS DESIGN (STANDARD) */
        .vs-input {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            padding: 0 12px;
            font-size: 13px;
            color: #333;
            width: 100%;
            transition: all 0.2s;
            height: 40px; 
        }
        .vs-input:focus {
            /* Changement ici : Couleur BLEUE au focus (#0056b3) */
            border-color: #0056b3;
            box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
            outline: none;
        }
        /* Classe ajoutée par PHP ou JS en cas d'erreur */
        .vs-input.is-invalid {
            border-color: #ef4444 !important;
            background-color: #fef2f2;
        }
        .vs-label {
            font-size: 11px;
            font-weight: 700;
            color: #4b5563;
            margin-bottom: 2px;
            display: block;
            text-transform: uppercase;
        }
        .error-msg {
            color: #ef4444;
            font-size: 10px;
            font-weight: 600;
            margin-top: 1px;
            display: block;
        }
        .social-btn {
            height: 38px;
            border-radius: 5px;
            border: 1px solid #e5e7eb;
            background: white;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .social-btn:hover { background: #f9fafb; transform: translateY(-1px); border-color: #d1d5db; }
        
        /* === ZONE "LAPTOP" (MODE MAIGRE & POSITIONNEMENT PRECIS) === */
        @media (min-width: 1024px) and (max-height: 850px) {
            .laptop-card { 
                max-width: 340px !important; 
                padding: 20px !important;
                max-height: 580px; 
            }
            .vs-input { height: 32px !important; font-size: 12px !important; }
            .social-btn { height: 32px !important; }
            .vs-label { font-size: 10px !important; margin-bottom: 0 !important; }
            h1 { font-size: 3rem !important; }
            h2 { font-size: 1.1rem !important; }
            .laptop-container { 
                padding-top: 60px !important; /* Ajusté car pas de header */
            } 
        }
    </style>
</head>
<body>

<div id="toast-container"></div>

<div id="toast-notification" class="fixed bottom-10 left-1/2 transform -translate-x-1/2 translate-y-20 opacity-0 transition-all duration-500 z-[100] flex items-center bg-white/90 backdrop-blur-md border border-white/20 shadow-2xl rounded-full px-6 py-3 gap-3 pointer-events-none">
    <div class="bg-[#0056b3] text-white w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
        <i class="fa-solid fa-clock text-sm"></i>
    </div>
    <div>
        <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Information</h4>
        <p class="text-xs text-gray-600" id="toast-message">Bientôt disponible.</p>
    </div>
</div>

<div class="relative w-full min-h-screen">

    <div class="fixed inset-0 z-0">
        <video autoplay loop muted playsinline class="w-full h-full object-cover">
            <source src="https://res.cloudinary.com/djlv5llvw/video/upload/v1766353615/Promotion__C_est_l_temps_de_voyager_hz3zmd.mov" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <button onclick="toggleLangModal(true)" class="fixed bottom-4 right-4 z-50 flex items-center gap-2 bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/20 text-white text-[10px] font-bold hover:bg-black/50 transition-all shadow-lg group">
        <i class="fa-solid fa-globe group-hover:scale-110 transition-transform"></i> <span id="current-lang-label">FR</span>
    </button>

    <div class="relative z-10 w-full min-h-screen grid grid-cols-1 lg:grid-cols-2 laptop-container items-center">

        <div class="flex flex-col justify-center px-8 pt-32 pb-10 lg:pt-0 lg:pb-0 lg:px-16 text-center lg:text-left h-full">
            <div class="fade-in-text">
                <h1 class="text-4xl md:text-5xl lg:text-7xl text-white leading-tight font-medium drop-shadow-2xl">
                    <span data-key="welcome">Bienvenue sur</span> <br>
                    <span class="font-bold">ADA France</span>
                </h1>
                <p class="text-white/80 mt-4 lg:mt-6 text-sm lg:text-lg font-light lg:border-l-2 border-white/50 lg:pl-5 max-w-md mx-auto lg:mx-0 leading-relaxed" data-key="tagline">
                    Votre passeport unique pour une mobilité sans limites.
                </p>
            </div>
            
            <div class="hidden lg:block mt-12 fade-in-text">
                <a href="<?php echo route('home'); ?>" class="inline-flex items-center gap-3 text-white/80 hover:text-white transition-all group">
                    <div class="w-8 h-8 rounded-full border border-white/30 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all backdrop-blur-sm">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                    </div>
                    <span class="uppercase tracking-widest text-[10px] font-bold" data-key="back_home">Retour Accueil</span>
                </a>
            </div>
        </div>

        <div class="flex justify-center px-4 pb-20 lg:pb-0 w-full">
            
            <div class="bg-white w-full max-w-[380px] rounded-[20px] shadow-2xl p-6 slide-in-card relative overflow-y-auto laptop-card" style="max-height: 85vh;">
                
                <div class="mb-4 text-center lg:text-left">
                    <h2 class="text-xl font-bold text-gray-900" data-key="form_title">Créer un compte</h2>
                    <p class="text-[10px] text-gray-500 mt-0.5" data-key="form_subtitle">Accédez à tous nos services avec ADA Smart ID.</p>
                </div>

                <form id="registerForm" action="<?php echo route('client.register'); ?>" method="POST" class="space-y-2" novalidate>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                    <div class="flex gap-2">
                        <div class="w-1/2">
                            <label class="vs-label" data-key="firstname">Prénom</label>
                            <input type="text" name="prenom" id="prenom" value="<?php echo old('prenom'); ?>" placeholder="Yanis" class="vs-input <?php echo ($errors && $errors->has('prenom')) ? 'is-invalid' : ''; ?>">
                            <?php if($errors && $errors->has('prenom')): ?>
                                <span class="error-msg"><?php echo $errors->first('prenom'); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="w-1/2">
                            <label class="vs-label" data-key="lastname">Nom</label>
                            <input type="text" name="nom" id="nom" value="<?php echo old('nom'); ?>" placeholder="Benkrouidem" class="vs-input <?php echo ($errors && $errors->has('nom')) ? 'is-invalid' : ''; ?>">
                            <?php if($errors && $errors->has('nom')): ?>
                                <span class="error-msg"><?php echo $errors->first('nom'); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label class="vs-label" data-key="email">Adresse Email</label>
                        <input type="email" name="email" id="email" value="<?php echo old('email'); ?>" placeholder="exemple@email.com" class="vs-input <?php echo ($errors && $errors->has('email')) ? 'is-invalid' : ''; ?>">
                        <?php if($errors && $errors->has('email')): ?>
                            <span class="error-msg"><?php echo $errors->first('email'); ?></span>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="vs-label" data-key="phone">Téléphone</label>
                        <input type="tel" name="telephone" id="telephone" value="<?php echo old('telephone'); ?>" placeholder="06 12 34 56 78" class="vs-input <?php echo ($errors && $errors->has('telephone')) ? 'is-invalid' : ''; ?>">
                        <?php if($errors && $errors->has('telephone')): ?>
                            <span class="error-msg"><?php echo $errors->first('telephone'); ?></span>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="vs-label" data-key="password">Mot de passe</label>
                        <div class="relative">
                            <input type="password" name="motpasse" id="motpasse" placeholder="••••••••" class="vs-input pr-10 <?php echo ($errors && $errors->has('motpasse')) ? 'is-invalid' : ''; ?>">
                            <button type="button" id="togglePassword" class="absolute right-0 top-0 h-full px-3 text-gray-400 cursor-pointer hover:text-gray-600">
                                <i class="fa-regular fa-eye text-xs" id="eyeIcon"></i>
                            </button>
                        </div>
                        <?php if($errors && $errors->has('motpasse')): ?>
                            <span class="error-msg"><?php echo $errors->first('motpasse'); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center gap-2 mt-2">
                        <input type="checkbox" id="remember" class="w-3.5 h-3.5 rounded border-gray-300 accent-[#0056b3]">
                        <label for="remember" class="text-[10px] text-gray-600" data-key="remember">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="w-full bg-[#0056b3] text-white font-bold py-2.5 rounded-lg shadow-md hover:bg-[#004494] transition-all text-xs uppercase tracking-wide mt-3" data-key="submit_btn">
                        Confirmer l'inscription
                    </button>

                    <div class="relative py-2 mt-1">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                        <div class="relative flex justify-center text-[9px] font-bold text-gray-400 uppercase"><span class="px-2 bg-white" data-key="or">Ou</span></div>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <button type="button" onclick="showComingSoon('Apple')" class="social-btn">
                            <i class="fa-brands fa-apple text-lg"></i>
                        </button>
                        <button type="button" onclick="showComingSoon('Facebook')" class="social-btn">
                            <i class="fa-brands fa-facebook-f text-sm text-[#1877F2]"></i>
                        </button>
                        <button type="button" onclick="showComingSoon('Google')" class="social-btn">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-3.5 h-3.5" alt="Google">
                        </button>
                    </div>

                    <div class="text-center pt-3 pb-1">
                        <p class="text-[10px] text-gray-500">
                            <span data-key="already_account">Déjà un compte ?</span> 
                            <a href="<?php echo route('client.login.form'); ?>" class="text-[#0056b3] font-bold ml-1 hover:underline" data-key="login_link">Se connecter</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="lang-modal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity opacity-0" id="modal-bg" onclick="toggleLangModal(false)"></div>
        <div class="absolute top-0 left-0 w-full bg-white p-6 transform -translate-y-full transition-transform duration-500 shadow-2xl max-h-[90vh] overflow-y-auto" id="lang-content">
            <div class="flex justify-between items-center mb-6 max-w-6xl mx-auto border-b border-gray-100 pb-4">
                <h2 class="text-2xl font-bold text-gray-900" data-key="select_region">Région</h2>
                <button onclick="toggleLangModal(false)" class="w-8 h-8 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors"><i class="fa-solid fa-xmark text-lg text-gray-500"></i></button>
            </div>
            <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
                <div>
                    <h4 class="font-bold text-gray-400 mb-3 text-[10px] uppercase tracking-widest">Europe</h4>
                    <ul class="space-y-2">
                        <li><button onclick="changeLanguage('fr')" class="text-[#0056b3] font-bold text-left w-full border-l-2 border-[#0056b3] pl-2">Français</button></li>
                        <li><button onclick="changeLanguage('en')" class="text-gray-600 hover:text-[#0056b3] font-medium text-left w-full hover:pl-2 transition-all">English</button></li>
                        <li><button onclick="changeLanguage('de')" class="text-gray-600 hover:text-[#0056b3] font-medium text-left w-full hover:pl-2 transition-all">Deutsch</button></li>
                        <li><button onclick="changeLanguage('es')" class="text-gray-600 hover:text-[#0056b3] font-medium text-left w-full hover:pl-2 transition-all">Español</button></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-400 mb-3 text-[10px] uppercase tracking-widest">Moyen-Orient</h4>
                    <ul class="space-y-2">
                        <li><button onclick="changeLanguage('ar')" class="text-gray-600 hover:text-[#0056b3] font-medium text-left w-full hover:pl-2 transition-all">العربية</button></li>
                        <li><button onclick="changeLanguage('en')" class="text-gray-600 hover:text-[#0056b3] font-medium text-left w-full hover:pl-2 transition-all">English (ME)</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /* --- FONCTIONS UX UI (Pop-ups) --- */
    
    // 1. Toast pour "Bientôt disponible" (Centré en bas)
    function showComingSoon(featureName) {
        const toast = document.getElementById('toast-notification');
        const message = document.getElementById('toast-message');
        message.innerText = "L'inscription " + featureName + " sera bientôt disponible pour ce projet.";
        
        toast.classList.remove('translate-y-20', 'opacity-0');
        
        // Masquer après 3 secondes
        setTimeout(() => { 
            toast.classList.add('translate-y-20', 'opacity-0'); 
        }, 3000);
    }

    // 2. Toast pour les ERREURS formulaires (Haut droite)
    function showToast(message) {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = 'ux-toast';
        toast.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i><span>${message}</span>`;
        
        container.appendChild(toast);
        
        // Animation d'entrée
        requestAnimationFrame(() => {
            toast.classList.add('show');
        });

        // Disparition automatique
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 4000 + (Math.random() * 500));
    }

    // Fonction pour animer l'input en erreur
    function setError(inputElement, hasError) {
        if(hasError) {
            inputElement.classList.add('is-invalid', 'shake-input');
            setTimeout(() => inputElement.classList.remove('shake-input'), 400);
        } else {
            inputElement.classList.remove('is-invalid');
        }
    }

    // Validation du formulaire
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        let hasError = false;
        
        // Récupération des champs
        const prenom = document.getElementById('prenom');
        const nom = document.getElementById('nom');
        const email = document.getElementById('email');
        const telephone = document.getElementById('telephone');
        const password = document.getElementById('motpasse');

        /* Validation Prénom */
        if(prenom.value.trim() === '') {
            showToast("Le prénom est obligatoire.");
            setError(prenom, true);
            hasError = true;
        } else { setError(prenom, false); }

        /* Validation Nom */
        if(nom.value.trim() === '') {
            showToast("Le nom est obligatoire.");
            setError(nom, true);
            hasError = true;
        } else { setError(nom, false); }

        /* Validation Email */
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailPattern.test(email.value)) {
            showToast("Adresse email invalide.");
            setError(email, true);
            hasError = true;
        } else { setError(email, false); }

        /* Validation Téléphone */
        const phoneClean = telephone.value.replace(/\D/g,''); 
        if(phoneClean.length < 8) {
            showToast("Numéro de téléphone invalide (8 chiffres min).");
            setError(telephone, true);
            hasError = true;
        } else { setError(telephone, false); }

        /* Validation Mot de passe */
        if(password.value.length < 8) {
            showToast("Le mot de passe doit faire 8 caractères minimum.");
            setError(password, true);
            hasError = true;
        } else { setError(password, false); }

        // Si AU MOINS une erreur est détectée, on bloque l'envoi
        if(hasError) {
            e.preventDefault();
        }
    });

    /* LOGIQUE DE L'OEIL */
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#motpasse');
    const eyeIcon = document.querySelector('#eyeIcon');

    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    }

    /* LOGIQUE TRADUCTION */
    const translations = {
        fr: { welcome: "Bienvenue sur", tagline: "Votre passeport unique pour une mobilité sans frontières.", back_home: "Retour Accueil", form_title: "Créer un compte", form_subtitle: "ADA Smart ID pour accéder à tous nos services.", firstname: "Prénom", lastname: "Nom", email: "Adresse Email", phone: "Téléphone", password: "Mot de passe", remember: "Se souvenir de moi", submit_btn: "Confirmer l'inscription", or: "Ou", already_account: "Déjà un compte ?", login_link: "Se connecter", select_region: "Région" },
        en: { welcome: "Welcome To", tagline: "Your single passport for borderless mobility.", back_home: "Back to Home", form_title: "Create an Account", form_subtitle: "Enjoy ADA Smart ID to access all our services.", firstname: "First Name", lastname: "Last Name", email: "Email Address", phone: "Phone Number", password: "Password", remember: "Remember Me", submit_btn: "Confirm Registration", or: "Or", already_account: "Already have an account?", login_link: "Log In", select_region: "Region" }
    };

    function toggleLangModal(show) {
        const modal = document.getElementById('lang-modal');
        const content = document.getElementById('lang-content');
        const bg = document.getElementById('modal-bg');
        if(show) {
            modal.classList.remove('hidden');
            setTimeout(() => { content.classList.remove('-translate-y-full'); bg.classList.remove('opacity-0'); }, 10);
        } else {
            content.classList.add('-translate-y-full'); bg.classList.add('opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 500);
        }
    }

    function changeLanguage(lang) {
        const t = translations[lang];
        if(!t) return;
        document.getElementById('current-lang-label').innerText = lang.toUpperCase();
        document.querySelectorAll('[data-key]').forEach(el => {
            const key = el.getAttribute('data-key');
            if (t[key]) el.innerText = t[key];
        });
        document.body.dir = lang === 'ar' ? 'rtl' : 'ltr';
        toggleLangModal(false);
    }
</script>

</body>
</html>