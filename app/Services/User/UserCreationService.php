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

	public function createRequester(string $username, string $email, string $password, ?UploadedFile $image, string $date_of_birth, string $ein, string $gender) : void
	{

		$date_of_birth = \DateTime::createFromFormat('Y-m-d', $date_of_birth);
		if ($date_of_birth !== false) {
			$date_of_birth = $date_of_birth->format('Y-m-d');
		}

		$user = $this->create($username, $password, $email, $image, $date_of_birth, $ein, $gender, User::ROLE_REQUESTER);

		$requester = new Requester();
		$requester->user_id = $user->id;

		if($image !== null){
			$image->move(public_path('images/requester'), $fileName = Str::random(16) . '.' . $image->extension());
			$requester->image = $fileName;
		}

		$requester->save();
	}

	public function createWarehouseStaff(string $username, string $email, string $password, ?UploadedFile $image, string $date_of_birth, string $ein, string $gender) : void
	{

		$date_of_birth = \DateTime::createFromFormat('Y-m-d', $date_of_birth);
		if ($date_of_birth !== false) {
			$date_of_birth = $date_of_birth->format('Y-m-d');
		}

		$user = $this->create($username, $password, $email, $image, $date_of_birth, $ein, $gender, User::ROLE_WAREHOUSE_STAFF);

		$warehouse_staff = new WarehouseStaff();
		$warehouse_staff->user_id = $user->id;

		if($image !== null){
			$image->move(public_path('images/warehouse_staff'), $fileName = Str::random(16) . '.' . $image->extension());
			$warehouse_staff->image = $fileName;
		}

		$warehouse_staff->save();
	}
 
	public function createAdmin(string $username, string $email, string $password, ?string $imagePath = null, string $date_of_birth, string $ein, string $gender) : void
	{

		$date_of_birth = \DateTime::createFromFormat('Y-m-d', $date_of_birth);
        if ($date_of_birth !== false) {
            $date_of_birth = $date_of_birth->format('Y-m-d');
        }

		$user = $this->create($username, $password, $email, $imagePath, $date_of_birth, $ein, $gender, User::ROLE_ADMIN);

		if ($imagePath !== null && file_exists($imagePath)) {
			$image = new UploadedFile($imagePath, basename($imagePath));
			$fileName = Str::random(16) . '.' . $image->extension();
			$image->move(public_path('images/admin'), $fileName);
			$user->image = $fileName;
		} else {
			$user->image = 'default.jpg'; 
		}
		$user->save();
	}

	private function create(string $username, string $password, string $email, string $role, ?string $image = null, string $date_of_birth, string $ein, string $gender) : User
	{
		$user = new User();
		$user->name = $username;
		$user->email = $email;
		$user->setPassword($password);
		$user->role = $role;
		$user->image = 'default.jpg';
		$user->date_of_birth = \DateTime::createFromFormat('Y-m-d', $date_of_birth);
		$user->ein = $ein;
		$user->gender = $gender;

		$user->save();
		return $user;
	}

	public function updateRequester(Requester|int $requester, string $username, string $email, string $password, ?UploadedFile $image, string $date_of_birth, string $ein, string $gender) : void
	{
		$date_of_birth = \DateTime::createFromFormat('Y-m-d', $date_of_birth);
        if ($date_of_birth !== false) {
            $date_of_birth = $date_of_birth->format('Y-m-d');
        }

		$user = $this->update($requester, $username, $email, $password, User::ROLE_REQUESTER, $image, $date_of_birth, $ein, $gender);

		Requester::query()->find($requester instanceof Requester ? $requester->user_id : $requester)
			->update([
				'user_id' => $user->id,
			]);
	}

	public function updateWarehouseStaff(WarehouseStaff|int $warehouse_staff, string $username, string $email, string $password, ?UploadedFile $image, string $date_of_birth, string $ein, string $gender) : void
	{
		$date_of_birth = \DateTime::createFromFormat('Y-m-d', $date_of_birth);
        if ($date_of_birth !== false) {
            $date_of_birth = $date_of_birth->format('Y-m-d');
        }

		$user = $this->update($warehouse_staff, $username, $email, $password, User::ROLE_WAREHOUSE_STAFF, $image, $date_of_birth, $ein, $gender);

		WarehouseStaff::query()->find($warehouse_staff instanceof WarehouseStaff ? $warehouse_staff->user_id : $warehouse_staff)
			->update([
				'user_id' => $user->id
			]);
	}

	private function update(User|int $user, string $username, string $email, string $password, string $role, ?UploadedFile $image, string $date_of_birth, string $ein, string $gender) : User
	{
		$update = [
			'name' => $username,
            'email' => $email,
			'role' => $role,
			'image' => $image, //idk bner gni apa ngga
			'date_of_birth' => $date_of_birth,
			'ein' => $ein,
			'gender' => $gender
		];
		if($password !== "") {
			$update['password'] = Hash::make($password);
		}
		User::query()->find($user instanceof User ? $user->id : $user)->update($update);
		if(!$user instanceof User) {
			/** @var User $ret */
			$ret = User::query()->find($user);
			return $ret;
		}
		return $user;
	}
}
