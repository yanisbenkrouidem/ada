<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attribut
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $logo
 * 
 * @property Collection|AttributCategorie[] $attribut_categories
 *
 * @package App\Models
 */
class Attribut extends Model
{
	protected $table = 'attributs';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'libelle',
		'logo'
	];

	public function attribut_categories()
	{
		return $this->hasMany(AttributCategorie::class);
	}
}
