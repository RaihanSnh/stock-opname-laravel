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
 * @property int $code
 * @property int $warehouse_id
 * @property int $detail_item_id
 * @property string $name
 * @property string $description
 * @property int $total
 * @property string $series
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Warehouse $warehouse
 * @property DetailItem $detail_item
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'items';

	protected $casts = [
		'warehouse_id' => 'int',
		'detail_item_id' => 'int',
	];

	protected $fillable = [
		'warehouse_id',
		'detail_item_id',
		'name',
		'description',
		'series',
		'total',
		'image',
	];

	public function warehouse()
	{
		return $this->belongsTo(Warehouse::class);
	}

	public function detail_item()
	{
		return $this->belongsTo(DetailItem::class);
	}

}
