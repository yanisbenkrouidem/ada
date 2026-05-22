<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'paniers'; // On force le nom de la table
    protected $guarded = [];

    // Relation vers le véhicule
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }

    // Relation vers l'agence de départ
    public function agenceDepart()
    {
        return $this->belongsTo(Agence::class, 'agence_depart_id');
    }
    
    // Relation vers l'agence de retour
    public function agenceRetour()
    {
        return $this->belongsTo(Agence::class, 'agence_retour_id');
    }
}