<?php

declare(strict_types=1);

namespace App\Services\User;

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

	public function createUser(string $username, string $email, string $password, ?UploadedFile $image, string $date_of_birth, string $ein, string $gender, string $role): void
    {
        $user = $this->create($username, $email, $password, $date_of_birth, $ein, $gender, $role);

        $this->processImage($user, $image, 'images/user');

        $user->save();
    }

	private function create(string $username, string $email, string $password, string $date_of_birth, string $ein, string $gender, string $role): User
    {
        $user = new User();
        $user->ein = $ein;
        $user->name = $username;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->gender = $gender;
        $user->date_of_birth = $date_of_birth;
        $user->role = $role;
        $user->image = 'default.jpg';

		$user->save();
	
		return $user;
    }

    private function processImage(User $user, ?UploadedFile $image, string $destination): void
    {
        if ($image !== null) {
            $fileName = Str::random(16) . '.' . $image->extension();
            $image->move(public_path($destination), $fileName);
            $user->image = $fileName;
        }
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
