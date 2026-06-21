<?php 
$title = 'Connexion à votre espace'; 
?>
<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ADA France</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['Manrope', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'] 
                    },
                    colors: { 
                        'ada-blue': '#0056b3', // Bleu classique
                        'ada-blue-hover': '#004494'
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(0, 0, 0, 0.37)',
                        'card': '0 20px 60px -10px rgba(0, 0, 0, 0.25)'
                    }
                }
            }
        }
    </script>
    <style>
        .animate-fade-in { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Bouton Glassmorphism */
        .glass-btn {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .glass-btn:hover { background: rgba(255, 255, 255, 0.2); transform: translateY(-1px); }

        /* Animation Shake */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
        .shake-input {
            animation: shake 0.4s ease-in-out;
            border-color: #ef4444 !important; /* Rouge erreur */
            background-color: #fef2f2 !important;
            color: #b91c1c !important;
        }

        /* Toast Container (Haut Droite) */
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        /* Style du Toast */
        .ux-toast {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-left: 4px solid #ef4444; /* Rouge erreur */
            padding: 14px 18px;
            border-radius: 8px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            font-family: 'Manrope', sans-serif;
            font-weight: 600;
            color: #1f2937;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            max-width: 350px;
        }
        .ux-toast.show {
            transform: translateX(0);
            opacity: 1;
        }
        .ux-toast i {
            color: #ef4444;
            font-size: 18px;
        }
    </style>
</head>
<body class="h-full overflow-hidden font-sans bg-gray-900">

    <div id="toast-container"></div>

    <div id="toast-notification" class="fixed bottom-10 left-1/2 transform -translate-x-1/2 translate-y-20 opacity-0 transition-all duration-500 z-[100] flex items-center bg-white/90 backdrop-blur-md border border-white/20 shadow-2xl rounded-full px-6 py-3 gap-3 pointer-events-none">
        <div class="bg-ada-blue text-white w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-clock text-sm"></i>
        </div>
        <div>
            <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Information</h4>
            <p class="text-xs text-gray-600" id="toast-message">Bientôt disponible.</p>
        </div>
    </div>

    <div class="relative w-full h-full">
        <img src="<?php echo asset('images/2ff256d5c8.webp'); ?>" alt="Background" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-black/40"></div>

        <div class="absolute top-0 left-0 w-full p-6 flex justify-between items-center z-50">
            <a href="<?php echo route('home'); ?>" class="glass-btn text-white rounded-full px-6 py-2.5 flex items-center gap-3 transition-all duration-300 group">
                <i class="fa-solid fa-chevron-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                <span class="text-sm font-bold tracking-wide" data-key="back_home">Retour</span>
            </a>

            <button onclick="toggleLangModal(true)" class="glass-btn text-white rounded-full px-6 py-2.5 flex items-center gap-3 transition-all duration-300 group">
                <i class="fa-solid fa-globe text-xs group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-bold tracking-wide" id="current-lang-label">Français</span>
            </button>
        </div>

        <div class="relative z-10 w-full h-full flex flex-col lg:flex-row items-center justify-center lg:justify-between px-6 lg:px-24 pb-12 pt-24 lg:pt-0">
            
            <div class="text-white max-w-xl hidden lg:block lg:self-end lg:mb-20 animate-fade-in">
                <img src="<?php echo asset('images/ADAlogo1.png'); ?>" alt="ADA Logo" class="h-14 mb-8 brightness-0 invert opacity-90">
                <h1 class="font-serif text-7xl leading-tight mb-6">
                    <span data-key="welcome">Bienvenue sur</span> <br> 
                    <span class="italic text-white">ADA France</span>
                </h1>
                
                <div class="h-2.5 w-full flex rounded-full overflow-hidden mt-10 max-w-sm opacity-90 shadow-glass">
                    <div class="w-1/4 bg-[#003060]"></div>
                    <div class="w-1/4 bg-[#004494]"></div>
                    <div class="w-1/4 bg-[#0056b3]"></div>
                    <div class="w-1/4 bg-[#3378c2]"></div>
                </div>
            </div>

            <div class="w-full max-w-[480px] bg-white rounded-[2.5rem] shadow-card p-8 lg:p-10 animate-fade-in relative mx-auto lg:mx-0">
                
                <div class="text-center lg:text-left mb-8">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-2" data-key="form_title">Connexion à ADA</h2>
                    <p class="text-xs text-gray-500 font-medium leading-relaxed" data-key="form_subtitle">
                        Utilisez votre identifiant unique pour accéder à toutes les offres.
                    </p>
                </div>

                <div class="mb-6">
                    <a href="<?php echo url('/auth/google'); ?>" class="flex items-center justify-center gap-3 py-3 w-full border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors text-gray-700 font-semibold text-sm">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                        <span data-key="google_btn">Continuer avec Google</span>
                    </a>
                </div>

                <div class="relative flex py-2 items-center mb-6">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-400 text-[10px] font-bold uppercase tracking-widest" data-key="or">OU</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <form id="loginForm" action="<?php echo route('client.login'); ?>" method="POST" class="space-y-5" novalidate>
                    <?php echo csrf_field(); ?>

                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-1.5 ml-1" data-key="email">Adresse Email</label>
                        <input type="email" name="email" id="email" value="<?php echo old('email'); ?>" required 
                               class="w-full px-5 py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-sm font-medium focus:bg-white focus:border-ada-blue focus:ring-1 focus:ring-ada-blue outline-none transition-all placeholder-gray-400"
                               placeholder="exemple@email.com">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1.5 ml-1">
                            <label class="block text-xs font-bold text-gray-800" data-key="password">Mot de passe</label>
                        </div>
                        <div class="relative">
                            <input type="password" id="motpasse" name="motpasse" required 
                                   class="w-full px-5 py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-sm font-medium focus:bg-white focus:border-ada-blue focus:ring-1 focus:ring-ada-blue outline-none transition-all placeholder-gray-400"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-ada-blue transition-colors">
                                <i class="fa-regular fa-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-ada-blue hover:bg-ada-blue-hover text-white font-bold py-4 rounded-xl shadow-lg shadow-ada-blue/20 transition-all transform active:scale-[0.98] mt-2" data-key="login_btn">
                        Se connecter
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-500 font-medium">
                        <span data-key="no_account">Pas encore de compte ?</span> 
                        <a href="<?php echo route('client.register.form'); ?>" class="text-ada-blue font-bold hover:underline ml-1" data-key="signup_link">S'inscrire</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="lang-modal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity opacity-0" id="modal-bg" onclick="toggleLangModal(false)"></div>
        <div class="absolute top-0 left-0 w-full bg-white p-10 transform -translate-y-full transition-transform duration-500 shadow-2xl" id="lang-content">
            <div class="flex justify-between items-center mb-8 max-w-7xl mx-auto border-b border-gray-100 pb-6">
                <h2 class="text-4xl font-bold text-gray-900" data-key="select_region">Choisir une région</h2>
                <button onclick="toggleLangModal(false)" class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors"><i class="fa-solid fa-xmark text-2xl text-gray-500"></i></button>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-4 gap-12 text-sm">
                <div>
                    <h4 class="font-bold text-gray-400 mb-6 text-xs uppercase tracking-widest">Europe</h4>
                    <ul class="space-y-4">
                        <li><button onclick="changeLanguage('fr')" class="text-ada-blue font-bold hover:underline text-left w-full border-l-2 border-ada-blue pl-3">Français</button></li>
                        <li><button onclick="changeLanguage('en')" class="text-gray-600 hover:text-ada-blue font-medium text-left w-full hover:pl-2 transition-all">English</button></li>
                        <li><button onclick="changeLanguage('es')" class="text-gray-600 hover:text-ada-blue font-medium text-left w-full hover:pl-2 transition-all">Español</button></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-400 mb-6 text-xs uppercase tracking-widest">Moyen-Orient</h4>
                    <ul class="space-y-4">
                        <li><button onclick="changeLanguage('ar')" class="text-gray-600 hover:text-ada-blue font-medium text-left w-full hover:pl-2 transition-all">العربية</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- GESTION DES TOASTS (Pop-up) ---
        function showValidationToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'ux-toast';
            toast.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i><span>${message}</span>`;
            
            container.appendChild(toast);
            
            requestAnimationFrame(() => {
                toast.classList.add('show');
            });

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400);
            }, 5000); // 5 secondes pour lire
        }

        // Fonction pour mettre un champ en erreur (rouge + tremblement)
        function setError(inputElement, hasError) {
            if(hasError) {
                inputElement.classList.add('shake-input');
                setTimeout(() => inputElement.classList.remove('shake-input'), 400);
            }
        }

        /* --- INJECTION PHP DANS JS --- */
        // Ceci permet d'afficher les erreurs serveur (mauvais mdp) comme des pop-ups JS
        document.addEventListener("DOMContentLoaded", function() {
            const emailInput = document.getElementById('email');
            const passInput = document.getElementById('motpasse');

            // 1. Cas erreur globale (session error)
            <?php if (session('error')): ?>
                showValidationToast("<?php echo addslashes(session('error')); ?>");
                if(emailInput) setError(emailInput, true);
                if(passInput) setError(passInput, true);
            <?php endif; ?>

            // 2. Cas erreur validation (Laravel $errors)
            <?php if ($errors->any()): ?>
                <?php foreach ($errors->all() as $error): ?>
                    showValidationToast("<?php echo addslashes($error); ?>");
                <?php endforeach; ?>
                if(emailInput) setError(emailInput, true);
                if(passInput) setError(passInput, true);
            <?php endif; ?>
        });


        // --- VALIDATION JS CÔTÉ CLIENT (Avant envoi) ---
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            let hasError = false;
            
            const email = document.getElementById('email');
            const password = document.getElementById('motpasse');
            
            // Regex simple email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if(email.value.trim() === '') {
                showValidationToast("L'adresse email est requise.");
                setError(email, true);
                hasError = true;
            } 
            else if(!emailPattern.test(email.value)) {
                showValidationToast("Format d'email invalide.");
                setError(email, true);
                hasError = true;
            }

            if(password.value.trim() === '') {
                showValidationToast("Mot de passe requis.");
                setError(password, true);
                hasError = true;
            }

            if(hasError) {
                e.preventDefault();
            }
        });

        // --- FONCTIONS UI ---
        function showComingSoon(featureName) {
            const toast = document.getElementById('toast-notification');
            const message = document.getElementById('toast-message');
            message.innerText = "La connexion " + featureName + " sera bientôt disponible pour ce projet.";
            
            toast.classList.remove('translate-y-20', 'opacity-0');
            
            // Masquer après 3 secondes
            setTimeout(() => { 
                toast.classList.add('translate-y-20', 'opacity-0'); 
            }, 3000);
        }

        function togglePassword() {
            const input = document.getElementById('motpasse');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        const translations = {
            fr: { back_home: "Retour", welcome: "Bienvenue sur", form_title: "Connexion à ADA", form_subtitle: "Utilisez votre identifiant unique pour accéder à toutes les offres.", email: "Adresse Email", password: "Mot de passe", login_btn: "Se connecter", no_account: "Pas encore de compte ?", signup_link: "S'inscrire", or: "OU", select_region: "Choisir une région" },
            en: { back_home: "Back", welcome: "Welcome to", form_title: "Sign In to ADA", form_subtitle: "Use your unique ID to access all offers.", email: "Email Address", password: "Password", login_btn: "Sign In", no_account: "Don't have an account?", signup_link: "Sign up", or: "OR", select_region: "Select Region" },
            es: { back_home: "Volver", welcome: "Bienvenido a", form_title: "Iniciar sesión", form_subtitle: "Use su identificación única para acceder a todas las ofertas.", email: "Correo electrónico", password: "Contraseña", login_btn: "Entrar", no_account: "¿No tienes cuenta?", signup_link: "Registrarse", or: "O", select_region: "Elegir región" },
            ar: { back_home: "عودة", welcome: "مرحبا بكم في", form_title: "تسجيل الدخول", form_subtitle: "استخدم معرفك الفريد للوصول إلى جميع العروض.", email: "البريد الإلكتروني", password: "كلمة المرور", login_btn: "دخول", no_account: "ليس لديك حساب؟", signup_link: "سجل الآن", or: "أو", select_region: "اختر المنطقة" }
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
            const langNames = { fr: 'Français', en: 'English', es: 'Español', ar: 'العربية' };
            document.getElementById('current-lang-label').innerText = langNames[lang];
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