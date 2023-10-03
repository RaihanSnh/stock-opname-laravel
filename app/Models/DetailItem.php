<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailItem
 *
 * @property int $id
 * @property int $category_id
 * @property int $unit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Category $category
 * @property Unit $unit
 *
 * @package App\Models
 */
class DetailItem extends Model
{
	protected $table = 'detail_item';

	protected $casts = [
		'category_id' => 'int',
		'unit_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'unit_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function unit()
	{
		return $this->belongsTo(Unit::class);
	}
}
