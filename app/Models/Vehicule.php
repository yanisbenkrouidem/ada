<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Indispensable pour les requêtes directes

class Vehicule extends Model
{
    protected $table = 'vehicules';
    public $timestamps = false;

    protected $casts = [
        'categorie_id' => 'int',
        'agence_id' => 'int'
    ];

    protected $fillable = [
        'immat',
        'marque',
        'modele',
        'etatdeslieux',
        'categorie_id',
        'agence_id'
    ];

    // --- RELATIONS ---

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    // --- ACCESSEURS MAGIQUES (POUR AFFICHER LES VRAIES DONNÉES) ---

    /**
     * Récupère le carburant (Attribut ID 14 dans votre SQL)
     * Utilisation dans la vue : $vehicule->carburant
     */
    public function getCarburantAttribute()
    {
        // On cherche dans la table de liaison
        $attribut = DB::table('attribut_categorie')
            ->where('categorie_id', $this->categorie_id)
            ->where('attribut_id', 14) // 14 est l'ID pour "Energie" dans votre SQL
            ->first();

        // Si on trouve, on nettoie la valeur (ex: "Electrique ou Essence" -> "Hybride/Essence")
        // Sinon par défaut on met Essence
        return $attribut ? $attribut->valeur : 'Essence';
    }

    /**
     * Récupère le nombre de places (Attribut ID 17 dans votre SQL)
     * Utilisation dans la vue : $vehicule->places
     */
    public function getPlacesAttribute()
    {
        $attribut = DB::table('attribut_categorie')
            ->where('categorie_id', $this->categorie_id)
            ->where('attribut_id', 17) // 17 est l'ID pour "Places"
            ->first();

        return $attribut ? $attribut->valeur : '5 places';
    }

    /**
     * Récupère la boîte de vitesse.
     * NOTE : Il n'y a pas d'ID "Boite de vitesse" dans votre SQL (seulement Energie, Portes, Places, etc.)
     * On va donc "deviner" si c'est automatique via le nom de la catégorie ou mettre Manuelle par défaut.
     */
    public function getBoiteVitesseAttribute()
    {
        // Si le libellé de la catégorie contient "Auto" ou "Premium", on suppose Auto, sinon Manuelle
        $libelle = $this->category->libelle ?? '';
        
        if (stripos($libelle, 'Auto') !== false || stripos($libelle, 'Premium') !== false) {
            return 'Automatique';
        }

        return 'Manuelle';
    }
}