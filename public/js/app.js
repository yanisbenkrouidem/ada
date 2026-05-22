import './bootstrap';
/**
 * Fonction utilitaire pour lire un cookie
 */
function getCookie(name) {
    // ... (Code de la fonction getCookie vu précédemment)
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

/**
 * Fonction utilitaire pour définir un cookie
 */
function setCookie(name, value, days) {
    // ... (Code de la fonction setCookie vu précédemment)
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/; SameSite=Lax";
}


document.addEventListener('DOMContentLoaded', () => {
    const consentBanner = document.getElementById('cookie-consent-banner');
    const acceptButton = document.getElementById('accept-cookies');

    // 1. Vérifier si l'utilisateur a déjà donné son consentement
    if (!getCookie('cookie_consent')) {
        // 2. Si non, afficher la bannière
        if (consentBanner) {
            consentBanner.style.display = 'block';
        }
    }

    // 3. Écouter le clic sur le bouton d'acceptation
    if (acceptButton && consentBanner) {
        acceptButton.addEventListener('click', () => {
            // Créer le cookie 'cookie_consent' avec la valeur 'accepted' pour 365 jours
            setCookie('cookie_consent', 'accepted', 365);
            
            // Masquer la bannière
            consentBanner.style.display = 'none';
        });
    }
});