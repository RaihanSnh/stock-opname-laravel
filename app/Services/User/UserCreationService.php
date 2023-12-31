<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use App\Models\Warehouse;
use App\Traits\SingletonTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function public_path;

class UserCreationService
{

	use SingletonTrait;

	public function createUser(string $username, string $email, string $password, $image, string $date_of_birth, string $ein, string $gender, string $role, int $warehouse): void
    {
        $user = $this->create($username, $email, $password, $date_of_birth, $ein, $gender, $role, $warehouse);
		if ($image instanceof UploadedFile) {
			$this->processImage($user, $image, 'images/user');
		} else {
			$user->image = asset('images/user/' .  $image);
		}
        $user->save();
    }

	private function create(string $username, string $email, string $password, string $date_of_birth, string $ein, string $gender, string $role, int $warehouse): User
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
        $user->warehouse_id = $warehouse instanceof Warehouse ? $warehouse->id : $warehouse;

		$user->save();

		return $user;
    }

    private function processImage(User $user, ?UploadedFile $image, string $destination): void
	{
		if ($image !== null) {
			$fileName = Str::random(16) . '.' . $image->extension();
			try {
				$image->move(public_path($destination), $fileName);
				$user->image = $fileName;
			} catch (\Exception $e) {
				$user->image = 'default.png';
			}
		}
	}

	public function update(string $id, string $name, string $email, string $password, ?UploadedFile $image, string $date_of_birth, string $ein, string $gender, string $role) 
	{
		$user = User::find($id);
	
		if ($user instanceof User) {
			
			$user->name = $name;
			$user->email = $email;
			$user->ein = $ein;
			$user->gender = $gender;
			$user->date_of_birth = $date_of_birth;
			$user->role = $role;

			if ($password !== "") {
				$user->password = Hash::make($password);
			}
			
			if ($image !== null) {
				$fileName = $this->processImage($user, $image, 'images/user');
				if ($fileName !== null) {
					$user->image = $fileName;
				}
			}

			$user->save();
		}
	}

	public function delete(string $id) 
	{
		$user = User::find($id);

		if ($user instanceof User) {
        	$fileName = $user->image;

			if ($fileName !== 'default.jpg') {
				$image_path = public_path('images/user/'.$fileName);
				unlink($image_path);
			}
			$user->delete();
		}
	}
}