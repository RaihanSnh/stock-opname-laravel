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
 * @property int $requester_id
 * @property int $item_id
 * @property string $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Item $items
 * @property Requester $requester
 *
 * @package App\Models
 */
class Form extends Model
{
	protected $table = 'form';

	protected $casts = [
		'requester_id' => 'int',
		'item_id' => 'int'
	];

	protected $fillable = [
		'requester_id',
		'item_id',
		'reason'
	];

	public function items()
	{
		return $this->belongsTo(Item::class);
	}

	public function requester()
	{
		return $this->belongsTo(Requester::class, 'requester_id', 'user_id');
	}
}
