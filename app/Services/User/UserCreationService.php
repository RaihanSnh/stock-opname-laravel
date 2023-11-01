<?php

declare(strict_types=1);

namespace App\Services\User;

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

	public function update(string $id, string $name, string $email, string $password, ?UploadedFile $image, string $date_of_birth, string $ein, string $gender, string $role) {
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

	public function delete(string $id) {
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