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
 * @property int $warehouse_staff_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $reports_in_id
 * @property int $reports_out_id
 *
 * @property WarehouseStaff $warehouse_staff
 * @property Reportin $reports_in
 * @property ReportOut $reports_out
 *
 * @package App\Models
 */
class Report extends Model
{
	protected $table = 'reports';

	protected $casts = [
		'warehouse_staff_id' => 'int',
		'reports_in_id' => 'int',
		'reports_out_id' => 'int'
	];

	protected $fillable = [
		'warehouse_staff_ein',
		'reports_in_id',
		'reports_out_id'
	];

	public function warehouse_staff()
	{
		return $this->belongsTo(WarehouseStaff::class, 'warehouse_staff_ein', 'user_ein');
	}

	public function reports_in()
	{
		return $this->belongsTo(ReportIn::class);
	}

	public function reports_out()
	{
		return $this->belongsTo(ReportOut::class);
	}
}
