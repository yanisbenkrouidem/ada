<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jour
 * 
 * @property int $id
 * @property string|null $libelle
 * 
 * @property Collection|Agence[] $agences
 *
 * @package App\Models
 */
class Jour extends Model
{
	protected $table = 'jours';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'libelle'
	];

	public function agences()
	{
		return $this->belongsToMany(Agence::class)
					->withPivot('heuredebut', 'heurefin');
	}
}
