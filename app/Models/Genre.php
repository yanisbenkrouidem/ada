<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Genre
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $titre
 * @property string|null $description
 * @property string|null $logo
 * 
 * @property Collection|Category[] $categories
 *
 * @package App\Models
 */
class Genre extends Model
{
	protected $table = 'genres';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'libelle',
		'titre',
		'description',
		'logo'
	];

	public function categories()
	{
		return $this->hasMany(Category::class);
	}
}
