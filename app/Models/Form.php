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
 * @property int $user_id
 * @property int $item_id
 * @property string $reason
 * @property string $total
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Item $items
 * @property User $User
 *
 * @package App\Models
 */
class Form extends Model
{
	protected $table = 'form';

	protected $casts = [
		'user_id' => 'int',
		'item_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'item_id',
		'reason',
		'total'
	];

	public function items()
	{
		return $this->belongsTo(DetailItem::class, 'item_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
