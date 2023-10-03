<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 *
 * @property int $ein
 * @property string $name
 * @property string $email
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $role
 * @property string $image
 *
 * @property Requester $requester
 * @property WarehouseStaff $warehouse_staff
 *
 * @package App\Models
 */
class User extends Model
{

	protected $table = 'users';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'password',
		'role'
	];

	public function requester()
	{
		return $this->hasOne(Requester::class);
	}

	public function warehouse_staff()
	{
		return $this->hasOne(WarehouseStaff::class);
	}

}