<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReportIn
 *
 * @property int $id
 * @property int $item_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Item $items
 *
 * @package App\Models
 */
class ReportIn extends Model
{
	protected $table = 'reports_in';

	protected $casts = [
		'item_id' => 'int'
	];

	protected $fillable = [
		'item_id'
	];

	public function items()
	{
		return $this->belongsTo(DetailItem::class, 'item_id');
	}
}
