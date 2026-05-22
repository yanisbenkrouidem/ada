<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * 
 * @property int $id
 * @property Carbon|null $datesignature
 * @property Carbon|null $dateheuredebut
 * @property Carbon|null $dateheurefin
 * @property int|null $nbkmdebut
 * @property int|null $nbkmfin
 * @property float|null $montantfacture
 * @property int $agence_id
 * @property int $vehicule_id
 * @property int $client_id
 * 
 * @property Agence $agence
 * @property Client $client
 * @property Vehicule $vehicule
 *
 * @package App\Models
 */
class Location extends Model
{
	protected $table = 'locations';
	public $timestamps = false;

	protected $casts = [
		'datesignature' => 'datetime',
		'dateheuredebut' => 'datetime',
		'dateheurefin' => 'datetime',
		'nbkmdebut' => 'int',
		'nbkmfin' => 'int',
		'montantfacture' => 'float',
		'agence_id' => 'int',
		'vehicule_id' => 'int',
		'client_id' => 'int'
	];

	protected $fillable = [
		'datesignature',
		'dateheuredebut',
		'dateheurefin',
		'nbkmdebut',
		'nbkmfin',
		'montantfacture',
		'agence_id',
		'vehicule_id',
		'client_id'
	];

	public function agence()
	{
		return $this->belongsTo(Agence::class);
	}

	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function vehicule()
	{
		return $this->belongsTo(Vehicule::class);
	}
}
