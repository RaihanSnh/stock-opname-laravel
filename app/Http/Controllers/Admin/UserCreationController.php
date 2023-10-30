<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\UserCreationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserCreationController extends Controller{

	public function createUser(Request $request) {
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

		UserCreationService::getInstance()->createUser($username, $email, $password, $image, $date_of_birth, $ein, $gender, $role);

		return response()->json(['message' => 'User created.'], Response::HTTP_CREATED);
	}
}
