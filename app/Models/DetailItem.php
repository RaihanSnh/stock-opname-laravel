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
 * @property string $total
 * @property string $series
 * @property string $image
 * @property string $vendor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $category_id
 * @property int $unit_id
 * @property int $item_id
 * @property string $code
 *
 * @property Warehouse $warehouse
 * @property Category $category
 * @property Unit $unit
 * @property Items $items
 *
 * @package App\Models
 */
	class DetailItem extends Model
	{
		protected $table = 'detail_items';

		protected $casts = [
			'warehouse_id' => 'int',
			'category_id' => 'int',
			'unit_id' => 'int',
			'item_id' => 'int'
		];

		protected $fillable = [
			'warehouse_id',
			'category_id',
			'unit_id',
			'item_id',
			'description',
			'series',
			'total',
			'image',
			'code',
			'vendor'
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

		public function items()
		{
			return $this->belongsTo(Items::class, 'item_id');
		}
	}
