<footer class="bg-white font-sans text-gray-800 relative border-t border-gray-100">

    <div class="max-w-[1400px] mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-10">
            
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider mb-4 text-gray-900">TÉLÉCHARGER L'APPLICATION ADA</h4>
                <div class="flex gap-3">
                    <a href="<?php echo route('page.show', 'application-mobile'); ?>" class="border border-gray-300 rounded-lg px-4 py-2 flex items-center gap-3 hover:border-[var(--ada-red)] hover:text-[var(--ada-red)] transition-all group bg-white text-gray-800 no-underline">
                        <i class="fa-brands fa-google-play text-xl text-gray-600 group-hover:text-[var(--ada-red)] transition-colors"></i>
                        <div class="text-left">
                            <div class="text-[9px] uppercase leading-none text-gray-500 group-hover:text-[var(--ada-red)]">Disponible sur</div>
                            <div class="text-sm font-bold leading-none group-hover:text-[var(--ada-red)]">Google Play</div>
                        </div>
                    </a>
                    <a href="<?php echo route('page.show', 'application-mobile'); ?>" class="border border-gray-300 rounded-lg px-4 py-2 flex items-center gap-3 hover:border-[var(--ada-red)] hover:text-[var(--ada-red)] transition-all group bg-white text-gray-800 no-underline">
                        <i class="fa-brands fa-apple text-xl text-gray-600 group-hover:text-[var(--ada-red)] transition-colors"></i>
                        <div class="text-left">
                            <div class="text-[9px] uppercase leading-none text-gray-500 group-hover:text-[var(--ada-red)]">Télécharger dans</div>
                            <div class="text-sm font-bold leading-none group-hover:text-[var(--ada-red)]">l'App Store</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full lg:w-auto">
                <h4 class="text-xs font-bold uppercase tracking-wider mb-4 text-gray-900">NEWSLETTER</h4>
                <form onsubmit="handleFooterNewsletter(event)" id="footer-newsletter-form" class="flex relative">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" required placeholder="Votre email" class="bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-l-md px-4 py-3 w-full lg:w-80 outline-none focus:border-[var(--ada-red)] focus:ring-1 focus:ring-[var(--ada-red)] transition-all">
                    <input type="hidden" name="source" value="Footer">
                    <button type="submit" id="footer-newsletter-btn" class="bg-[#1a1a1a] text-white font-bold text-xs uppercase px-6 py-3 rounded-r-md hover:bg-[var(--ada-red)] transition-colors shadow-sm">
                        OK
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>

    <div class="max-w-[1400px] mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <div class="space-y-6">
                <a href="<?php echo route('home'); ?>" class="opacity-80 hover:opacity-100 transition-opacity block">
                    <img src="<?php echo asset('images/ADAlogo1.png'); ?>" alt="ADA" class="h-8"> 
                </a>
                
                <div class="text-xs text-gray-500 leading-relaxed">
                    <p class="font-bold text-gray-900 mb-1">Architecture & Développement : Yanis Benkrouidem.</p>
                    <p>Assistance technique & Documentation : Nathan Heu.</p>
                    <p class="mt-3 text-[9px] uppercase tracking-widest text-gray-400 font-bold border-l-2 border-[var(--ada-red)] pl-2">Projet BTS SIO SLAM</p>
                </div>

                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-100 w-fit">
                    <i class="fa-solid fa-shield-halved text-[var(--ada-red)]"></i>
                    <div class="text-[9px] text-gray-400 leading-tight">
                        <span class="block font-bold text-gray-600">SITE SÉCURISÉ</span>
                        Démonstration technique
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xs font-bold text-gray-900 mb-6 uppercase tracking-wider">Découvrir ADA</h3>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="<?php echo route('page.show', 'utilitaires'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Utilitaires & Camions</a></li>
                    <li><a href="<?php echo route('page.show', 'abonnement'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Abonnement Flexible</a></li>
                    <li><a href="<?php echo route('agences.liste'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline font-bold text-[var(--ada-red)]">Nos Agences (Carte)</a></li>
                    <li><a href="<?php echo route('page.show', 'offres'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Codes Promo & Offres</a></li>
                    <li><a href="<?php echo route('page.show', 'blog'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Conseils & Actualités</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-bold text-gray-900 mb-6 uppercase tracking-wider">Professionnels</h3>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="<?php echo route('page.show', 'espace-pro'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Connexion Espace Pro</a></li>
                    <li><a href="<?php echo route('page.show', 'gestion-flotte'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Gestion de Flotte</a></li>
                    <li><a href="<?php echo route('page.show', 'franchise'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Devenir Franchisé</a></li>
                    <li><a href="<?php echo route('page.show', 'publicite'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Publicité</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-bold text-gray-900 mb-6 uppercase tracking-wider">Besoin d'aide ?</h3>
                <ul class="space-y-3 text-sm text-gray-500 mb-8">
                    <li><a href="<?php echo route('page.show', 'centre-aide'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Centre d'aide</a></li>
                    <li><a href="<?php echo route('page.show', 'faq'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">FAQ</a></li>
                    <li><a href="<?php echo route('page.show', 'assistance'); ?>" class="hover:text-[var(--ada-red)] transition-colors hover:translate-x-1 duration-200 inline-block text-left no-underline">Assistance 24/7</a></li>
                </ul>

                <h3 class="text-[10px] font-bold text-gray-400 mb-4 uppercase tracking-widest">Réseaux Sociaux</h3>
                
                <div class="flex gap-4 mb-8">
                    <a href="https://www.linkedin.com/in/yanisbenkrouidem/" target="_blank" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-[#0077b5] hover:text-white transition-all shadow-sm" title="Suivre Yanis Benkrouidem sur LinkedIn">
                        <i class="fa-brands fa-linkedin-in text-xs"></i>
                    </a>
                </div>

                <a href="<?php echo route('page.show', 'contact'); ?>" class="border border-gray-200 text-gray-900 px-6 py-3 rounded-full text-xs font-bold hover:bg-[var(--ada-red)] hover:text-white hover:border-[var(--ada-red)] transition-all flex items-center gap-2 uppercase tracking-wide no-underline w-fit">
                    <i class="fa-solid fa-envelope"></i> Nous contacter
                </a>
            </div>

        </div>
    </div>

   

    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-8 left-8 w-10 h-10 bg-white text-gray-900 border border-gray-200 rounded-full flex items-center justify-center hover:bg-[var(--ada-red)] hover:text-white hover:border-[var(--ada-red)] transition-all shadow-lg z-30 opacity-0 pointer-events-none transform translate-y-4 transition-all duration-500" id="scroll-top-btn">
        <i class="fa-solid fa-arrow-up text-xs"></i>
    </button>

</footer>

<script>
// --- LOGIQUE NEWSLETTER DU FOOTER ---
async function handleFooterNewsletter(e) {
    e.preventDefault();
    const form = e.target;
    const btn = document.getElementById('footer-newsletter-btn');
    const email = form.querySelector('input[name="email"]').value;
    const url = "<?php echo route('newsletter.subscribe'); ?>";
    const originalText = btn.innerText;

    btn.disabled = true;
    btn.innerText = "...";

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ email: email, source: 'footer' })
        });

        const result = await response.json();

        if (response.ok) {
            alert("Félicitations ! Vous êtes bien inscrit à la newsletter ADA. Un email de confirmation vous a été envoyé via votre compte Gmail.");
            form.reset();
        } else {
            alert(result.message || "Une erreur est survenue.");
        }
    } catch (error) {
        console.error("Erreur:", error);
        alert("Impossible de joindre le serveur SMTP.");
    } finally {
        btn.disabled = false;
        btn.innerText = originalText;
    }
}

// Gestion du bouton "Scroll Top"
window.addEventListener('scroll', () => {
    const btn = document.getElementById('scroll-top-btn');
    if (window.scrollY > 500) {
        btn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
    } else {
        btn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
    }
});
</script>