<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Requester
 *
 * @property int $user_ein
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class Requester extends Model
{
	protected $table = 'requester';
	protected $primaryKey = 'user_ein';

	protected $casts = [
		'user_ein' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
