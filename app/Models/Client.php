<?php

namespace App\Models;

// IMPORTS CRUCIAUX POUR L'AUTHENTIFICATION
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Client
 * * @property int $id
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $email
 * @property string|null $motpasse
 * @property Collection|Location[] $locations
 *
 * @package App\Models
 */
class Client extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';
    public $timestamps = false;

    // J'ai ajouté les champs newsletter/sms pour que le profil fonctionne aussi
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'cp',
        'ville',
        'telephone',
        'email',
        'motpasse',
        'newsletter_optin',
        'sms_optin'
    ];

    // On cache le mot de passe pour qu'il ne s'affiche jamais par erreur
    protected $hidden = [
        'motpasse',
        'remember_token',
    ];

    /**
     * C'EST ICI LA CLÉ DU PROBLÈME :
     * Laravel cherche par défaut une colonne "password".
     * On lui dit d'utiliser "motpasse" à la place.
     */
    public function getAuthPassword()
    {
        return $this->motpasse;
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}