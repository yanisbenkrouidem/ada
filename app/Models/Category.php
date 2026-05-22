<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $complement
 * @property string|null $exemple
 * @property string|null $description
 * @property float|null $tarifjournee
 * @property float|null $tarifkm
 * @property string|null $photo
 * @property int $genre_id
 * 
 * @property Genre $genre
 * @property Collection|AttributCategorie[] $attribut_categories
 * @property Collection|Vehicule[] $vehicules
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'tarifjournee' => 'float',
		'tarifkm' => 'float',
		'genre_id' => 'int'
	];

	protected $fillable = [
		'libelle',
		'complement',
		'exemple',
		'description',
		'tarifjournee',
		'tarifkm',
		'photo',
		'genre_id'
	];

	public function genre()
	{
		return $this->belongsTo(Genre::class);
	}

	public function attribut_categories()
	{
		return $this->hasMany(AttributCategorie::class, 'categorie_id');
	}

	public function vehicules()
	{
		return $this->hasMany(Vehicule::class, 'categorie_id');
	}
}
