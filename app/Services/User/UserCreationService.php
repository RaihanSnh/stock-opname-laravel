<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\Requester;
use App\Models\WarehouseStaff;
use App\Models\User;
use App\Traits\SingletonTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function public_path;

class UserCreationService
{

	use SingletonTrait;

	public function createRequester(string $username, string $email, string $password, ?UploadedFile $image) : void
	{
		$user = $this->create($username, $password, $email, User::ROLE_REQUESTER);

		$requester = new Requester();
		$requester->user_ein = $user->ein;

		if($image !== null){
			$image->move(public_path('images/requester'), $fileName = Str::random(16) . '.' . $image->extension());
			$requester->image = $fileName;
		}

		$requester->save();
	}

	public function createWarehouseStaff(string $username, string $email, string $password, ?UploadedFile $image) : void
	{
		$user = $this->create($username, $password, $email, User::ROLE_WAREHOUSE_STAFF);

		$warehouse_staff = new WarehouseStaff();
		$warehouse_staff->user_ein = $user->ein;

		if($image !== null){
			$image->move(public_path('images/warehouse_staff'), $fileName = Str::random(16) . '.' . $image->extension());
			$warehouse_staff->image = $fileName;
		}

		$warehouse_staff->save();
	}

	// public function createAdmin(string $username, string $email, string $password, ?UploadedFile $image) : void
	// {
	// 	$this->create($username, $password, $email, User::ROLE_ADMIN);
	// }

	public function createAdmin(string $username, string $email, string $password, ?string $imagePath = null) : void
	{
		$user = $this->create($username, $password, $email, User::ROLE_ADMIN);
	
		if ($imagePath !== null) {
			$image = new UploadedFile($imagePath, basename($imagePath));
			$fileName = Str::random(16) . '.' . $image->extension();
			$image->move(public_path('images/admin'), $fileName);
			$user->image = $fileName;
		} else {
			$user->image = 'default.jpg'; 
		}
		$user->save();
	}
	
	// public function createAdmin(string $username, string $email, string $password, ?UploadedFile $image) : void
	// {
	// 	$user = $this->create($username, $password, $email, User::ROLE_ADMIN);
	
	// 	if($image !== null){
	// 		$image->move(public_path('images/admin'), $fileName = Str::random(16) . '.' . $image->extension());
	// 		$user->image = $fileName;
	// 	}
	
	// 	$user->save();
	// }
	

	private function create(string $username, string $password, string $email, string $role, ?string $image = null) : User
	{
		$user = new User();
		$user->name = $username;
		$user->email = $email;
		$user->setPassword($password);
		$user->role = $role;
		$user->image = 'default.jpg';

		$user->save();
		return $user;
	}

	public function updateRequester(Requester|int $requester, string $username, string $email, string $password, ?UploadedFile $image) : void
	{
		$user = $this->update($requester, $username, $email, $password, User::ROLE_REQUESTER, $image);

		Requester::query()->find($requester instanceof Requester ? $requester->user_ein : $requester)
			->update([
				'user_ein' => $user->ein,
			]);
	}

	public function updateWarehouseStaff(WarehouseStaff|int $warehouse_staff, string $username, string $email, string $password, ?UploadedFile $image) : void
	{
		$user = $this->update($warehouse_staff, $username, $email, $password, User::ROLE_WAREHOUSE_STAFF, $image);

		WarehouseStaff::query()->find($warehouse_staff instanceof WarehouseStaff ? $warehouse_staff->user_ein : $warehouse_staff)
			->update([
				'user_ein' => $user->ein
			]);
	}

	private function update(User|int $user, string $username, string $email, string $password, string $role, $image) : User
	{
		$update = [
			'name' => $username,
            'email' => $email,
			'role' => $role,
			'image' => $image
		];
		if($password !== "") {
			$update['password'] = Hash::make($password);
		}
		User::query()->find($user instanceof User ? $user->ein : $user)->update($update);
		if(!$user instanceof User) {
			/** @var User $ret */
			$ret = User::query()->find($user);
			return $ret;
		}
		return $user;
	}
}
