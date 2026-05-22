<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AgenceJour
 * 
 * @property int $agence_id
 * @property int $jour_id
 * @property Carbon|null $heuredebut
 * @property Carbon|null $heurefin
 * 
 * @property Agence $agence
 * @property Jour $jour
 *
 * @package App\Models
 */
class AgenceJour extends Model
{
	protected $table = 'agence_jour';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'agence_id' => 'int',
		'jour_id' => 'int',
		'heuredebut' => 'datetime',
		'heurefin' => 'datetime'
	];

	protected $fillable = [
		'heuredebut',
		'heurefin'
	];

	public function agence()
	{
		return $this->belongsTo(Agence::class);
	}

	public function jour()
	{
		return $this->belongsTo(Jour::class);
	}
}
