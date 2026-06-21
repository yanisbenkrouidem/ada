<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanierController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes - FINAL & CLEAN
|--------------------------------------------------------------------------
*/

// TEST DEBUG (Pour vérifier si le serveur répond)
Route::any('/test-404', function() {
    return 'Si tu vois ce message, le serveur et Laravel fonctionnent !';
});

// --- 1. ACCUEIL & PAGES PUBLIQUES ---
Route::get('/', [AgenceController::class, 'index'])->name('home');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('/offres-privilege', [OffreController::class, 'index'])->name('offres.privilege');

// --- 2. AUTHENTIFICATION ADMIN ---
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- 3. AUTHENTIFICATION CLIENT ---
Route::get('/espace-client/connexion', [ClientController::class, 'showLoginForm'])->name('client.login.form'); 
Route::post('/espace-client/connexion', [ClientController::class, 'login'])->name('client.login');
Route::post('/espace-client/logout', [ClientController::class, 'logout'])->name('client.logout');
Route::get('/inscription', [ClientController::class, 'showRegisterForm'])->name('client.register.form');
Route::post('/inscription', [ClientController::class, 'register'])->name('client.register');

// OAuth Google
Route::get('/auth/google', [\App\Http\Controllers\OAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\OAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// --- 4. PANIER & COMMANDE (NOUVEAU SYSTÈME) ---
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/ajouter', [PanierController::class, 'store'])->name('panier.add');
Route::delete('/panier/{id}', [PanierController::class, 'destroy'])->name('panier.delete');
// La route CRUCIALE pour valider la réservation
Route::post('/panier/valider', [PanierController::class, 'validerCommande'])->name('panier.valider');

// --- 5. ESPACE CLIENT & LOCATIONS (SÉCURISÉ) ---
Route::middleware(['auth:client'])->group(function () {
    
    // Profil
    Route::get('/mon-profil', [ClientController::class, 'showProfile'])->name('client.profile');
    Route::post('/mon-profil', [ClientController::class, 'updateProfile'])->name('client.profile.update');
    
    // Mes Voyages (Historique)
    Route::get('/mon-espace/mes-voyages', [LocationController::class, 'mesLocations'])->name('client.locations');
    
    // Actions sur les voyages (Stop / Annuler)
    Route::post('/location/{id}/stop', [LocationController::class, 'stop'])->name('location.stop');
    Route::delete('/location/{id}', [LocationController::class, 'destroy'])->name('location.destroy');
Route::middleware(['auth:client'])->group(function () {
    Route::post('/favoris/toggle', [App\Http\Controllers\FavorisController::class, 'toggle'])->name('favoris.toggle');
    Route::get('/mes-favoris', [App\Http\Controllers\FavorisController::class, 'index'])->name('favoris.index');
});
    // Préférences & Famille
    Route::post('/mon-profil/preferences', [ClientController::class, 'updatePreferences'])->name('client.preferences.update');
    Route::post('/mon-profil/carte', [ClientController::class, 'addCard'])->name('client.card.add');
    Route::delete('/mon-profil/carte/{id}', [ClientController::class, 'removeCard'])->name('client.card.remove');
    Route::post('/mon-profil/famille', [ClientController::class, 'addFamilyMember'])->name('client.family.add');
    Route::delete('/mon-profil/famille/{id}', [ClientController::class, 'removeFamilyMember'])->name('client.family.remove');
});

// --- 6. FLOTTE & RECHERCHE ---
Route::get('/flotte', [ClientController::class, 'touteLaFlotte'])->name('vehicules.flotte');
Route::get('/categorie/{id}', [ClientController::class, 'vehiculesParCategorie'])->name('vehicules.categorie');
Route::get('/vehicule/{id}', [AgenceController::class, 'showVehiculeDetails'])->name('vehicule.details');

// Agences & Recherche
Route::get('/agences', [AgenceController::class, 'listeAgences'])->name('agences.liste');
Route::get('/agence/{id}', [AgenceController::class, 'details'])->name('agence.details');
Route::get('/recherche', [AgenceController::class, 'searchForm'])->name('location.search.form');
Route::post('/recherche/resultats', [AgenceController::class, 'searchAvailableVehicules'])->name('location.search.results');
Route::get('/api/offres/search', [AgenceController::class, 'searchHomeVehicules'])->name('api.offres.search');
// Dans routes/web.php

// Ajoutez cette ligne :
Route::get('/carrieres', function () {
    return view('carrieres'); // Assurez-vous que le fichier de vue s'appelle bien carrieres.blade.php
})->name('carrieres');
// --- 7. COMPATIBILITÉ (ANCIENS LIENS DE RÉSERVATION) ---
// Ces routes servent à éviter les erreurs 404 si des liens traînent encore vers l'ancien système
Route::get('/reservation/{id}', [LocationController::class, 'create'])->name('reservation.create');
Route::post('/reserver/{vehicule_id}', [LocationController::class, 'reserver'])->name('reservation.store');

// --- 8. MARKETING & DIVERS ---
Route::post('/newsletter', [AgenceController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
Route::post('/club', [AgenceController::class, 'subscribeClub'])->name('club.subscribe');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// --- 9. ZONE ADMIN ---
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/vehicules', [AdminController::class, 'vehicules'])->name('admin.vehicules');
    Route::get('/admin/clients', [AdminController::class, 'clients'])->name('admin.clients');
    Route::get('/admin/feedbacks', [AdminController::class, 'feedbacks'])->name('admin.feedbacks');
});

// --- 10. OUTILS DE DÉBOGAGE ---
Route::get('/clear-everything', function() {
    try {
        Artisan::call('route:clear'); 
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return "<h1 style='color:green;font-family:sans-serif;'>✅ Cache vidé avec succès !</h1><p>Les nouvelles routes sont actives.</p>";
    } catch (\Exception $e) {
        return "Erreur : " . $e->getMessage();
    }
});
Route::get('/force-clear', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache totalement vidé et HTTPS forcé.";
});
Route::get('/force-create-table', function() {
    try {
        DB::statement("
            CREATE TABLE IF NOT EXISTS feedbacks (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                rating VARCHAR(255) NOT NULL,
                page VARCHAR(255) DEFAULT 'home',
                ip_address VARCHAR(45) NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
            )
        ");
        return "Table feedbacks OK.";
    } catch (\Exception $e) {
        return "Erreur : " . $e->getMessage();
    }
});