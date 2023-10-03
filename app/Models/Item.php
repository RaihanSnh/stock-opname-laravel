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
		'status_id' => 'int'
	];

	protected $fillable = [
		'warehouse_staff_ein',
		'item_code',
		'status_id'
	];

	public function warehouse_staff()
	{
		return $this->belongsTo(WarehouseStaff::class, 'warehouse_staff_ein', 'user_ein');
	}

	public function items()
	{
		return $this->belongsTo(Items::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}
}
