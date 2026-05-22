<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Agence
 * 
 * @property int $id
 * @property string|null $nom
 * @property string|null $adresse
 * @property string|null $cp
 * @property string|null $ville
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $motpasse
 * 
 * @property Collection|Jour[] $jours
 * @property Collection|Location[] $locations
 * @property Collection|Vehicule[] $vehicules
 *
 * @package App\Models
 */
class Agence extends Model
{
	protected $table = 'agences';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nom',
		'adresse',
		'cp',
		'ville',
		'telephone',
		'email',
		'motpasse'
	];

	public function jours()
	{
		return $this->belongsToMany(Jour::class)
					->withPivot('heuredebut', 'heurefin');
	}

	public function locations()
	{
		return $this->hasMany(Location::class);
	}

	public function vehicules()
	{
		return $this->hasMany(Vehicule::class);
	}
}
