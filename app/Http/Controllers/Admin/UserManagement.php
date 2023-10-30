<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserCreationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserManagement extends Controller{

	public function create(Request $request) {
		$request->validate([
			'ein' => 'required',
			'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'string',
			'password' => 'required',
			'dob' => 'required',
			'gender' => 'required',
			'role' => 'required',
			'image' => 'nullable|mimes:png,jpg'
		]);

		$ein = $request->post('ein');
        $username = $request->post('name');
        $email = $request->post('email');
        $password = $request->post('password');
        $date_of_birth = $request->post('dob');
        $gender = $request->post('gender');
        $image = $request->file('image');
        $role = $request->post('role');

		UserCreationService::getInstance()->create($username, $email, $password, $image, $date_of_birth, $ein, $gender, $role);

		return response()->json(['message' => 'User created.'], Response::HTTP_CREATED);
	}

	public function view($id) {
		$user = User::find($id);

		return response()->json(['user' => $user]);
	}

	public function update($id, Request $request) {
		$request->validate([
			'ein' => 'required',
			'name' => 'required|regex:/^[a-zA-Z\s]*$/',
			'email' => 'string',
			'password' => 'required',
			'dob' => 'required',
			'gender' => 'required',
			'role' => 'required',
			'image' => 'nullable'
		]);
	
		$ein = $request->post('ein');
		$username = $request->post('name');
		$email = $request->post('email');
		$password = $request->post('password');
		$date_of_birth = $request->post('dob');
		$gender = $request->post('gender');
		$image = $request->file('image');
		$role = $request->post('role');
	
		UserCreationService::getInstance()->update($id, $username, $email, $password, $image, $date_of_birth, $ein, $gender, $role);
	
		return response()->json(['message' => 'User updated.'], Response::HTTP_OK);
	}

	public function delete($id) {
	
		UserCreationService::getInstance()->delete($id);
	
		return response()->json(['message' => 'User deleted.'], Response::HTTP_OK);
	}
}
