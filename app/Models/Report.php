<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 *
 * @property int $id
 * @property int $warehouse_staff_ein
 * @property int $item_code
 * @property int $status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property WarehouseStaff $warehouse_staff
 * @property Item $item
 *
 * @package App\Models
 */
class Report extends Model
{
	protected $table = 'reports';

	protected $casts = [
		'warehouse_staff_ein' => 'int',
		'item_code' => 'int',
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
