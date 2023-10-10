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
	const ROLE_REQUESTER = 'requester';
	const ROLE_WAREHOUSE_STAFF = 'warehouse_staff';
	const ROLE_ADMIN = 'admin';

	const ROLES = [
		self::ROLE_REQUESTER,
		self::ROLE_WAREHOUSE_STAFF,
		self::ROLE_ADMIN
	];

	protected $table = 'users';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
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

	public function isPasswordValid(string $password) : bool{
		return Hash::check($password, $this->password);
	}

	public function isRequester() : bool{
		return $this->role === self::ROLE_REQUESTER;
	}

	public function isWarehouseStaff() : bool{
		return $this->role === self::ROLE_WAREHOUSE_STAFF;
	}

	public function isAdmin() : bool{
		return $this->role === self::ROLE_ADMIN;
	}

	public function setPassword(string $password) : string{
		return $this->password = Hash::make($password);
	}

}