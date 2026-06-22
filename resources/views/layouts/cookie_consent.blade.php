<?php
// Note: Le CSS est en ligne pour simplifier et éviter de toucher aux fichiers CSS existants.
?>
<div id="cookie-consent-banner" style="
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #333;
    color: white;
    text-align: center;
    padding: 15px;
    z-index: 1000;
    display: none; /* Cachez-le par défaut */
">
    <p style="margin: 0 20px;">
        Ce site utilise des cookies pour améliorer votre expérience utilisateur. 
        Veuillez accepter pour continuer.
    </p>

    <button id="accept-cookies" style="
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        margin-left: 15px;
        cursor: pointer;
        border-radius: 5px;
    ">
        Accepter
    </button>
</div>