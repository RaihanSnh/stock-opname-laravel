<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Form
 *
 * @property int $id
 * @property int $request_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Request $request
 *
 * @package App\Models
 */
class ReportOut extends Model
{
	protected $table = 'reports_out';

	protected $casts = [
		'request_id' => 'int'
	];

	protected $fillable = [
		'request_id'
	];

	public function request()
	{
		return $this->belongsTo(Request::class);
	}
}
