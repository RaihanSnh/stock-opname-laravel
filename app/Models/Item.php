<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @property int $id
 * @property int $warehouse_id
 * @property string $name
 * @property string $description
 * @property string total
 * @property string $series
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $category_id
 * @property int $unit_id
 * @property string code
 *
 * @property Warehouse $warehouse
 * @property Category $category
 * @property Unit $unit
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'items';

	protected $casts = [
		'warehouse_id' => 'int',
		'category_id' => 'int',
		'unit_id' => 'int'
	];

	protected $fillable = [
		'warehouse_id',
		'category_id',
		'unit_id',
		'name',
		'description',
		'series',
		'total',
		'image',
		'code'
	];

	public function warehouse()
	{
		return $this->belongsTo(Warehouse::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function unit()
	{
		return $this->belongsTo(Unit::class);
	}
}
