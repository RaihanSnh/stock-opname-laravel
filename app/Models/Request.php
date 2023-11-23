<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Request Form
 *
 * @property int $id
 * @property int $requester_id
 * @property int $item_id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Item $items
 * @property Requester $requester
 *
 * @package App\Models
 */
class Request extends Model
{
	protected $table = 'request';

	protected $casts = [
		'form_id' 		=> 'int',
		'requester_id' 	=> 'int'
	];

	protected $fillable = [
		'requester_id',
		'form_id',
		'status'
	];

	public function form()
	{
		return $this->belongsTo(Form::class);
	}

	public function requester()
	{
		return $this->belongsTo(Requester::class, 'requester_id', 'user_id');
	}
}
