<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributCategorie
 * 
 * @property int $categorie_id
 * @property int $attribut_id
 * @property string|null $valeur
 * 
 * @property Attribut $attribut
 * @property Category $category
 *
 * @package App\Models
 */
class AttributCategorie extends Model
{
	protected $table = 'attribut_categorie';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'categorie_id' => 'int',
		'attribut_id' => 'int'
	];

	protected $fillable = [
		'valeur'
	];

	public function attribut()
	{
		return $this->belongsTo(Attribut::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'categorie_id');
	}
}
