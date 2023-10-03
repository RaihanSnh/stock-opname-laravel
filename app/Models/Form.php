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
 * @property int $requester_ein
 * @property int $item_code
 * @property string $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Items $items
 * @property Requester $requester
 *
 * @package App\Models
 */
class Form extends Model
{
	protected $table = 'form';

	protected $casts = [
		'requester_ein' => 'int',
		'item_code' => 'int'
	];

	protected $fillable = [
		'requester_ein',
		'item_code',
		'reason'
	];

	public function items()
	{
		return $this->belongsTo(Items::class);
	}

	public function requester()
	{
		return $this->belongsTo(Requester::class, 'requester_ein', 'user_ein');
	}
}
