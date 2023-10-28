<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\UserCreationService;
use Illuminate\Http\Request;
use function back;

class UserCreationController extends Controller{

	public function createAdmin(Request $request) {
		$request->validate([
			'username' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|regex:/^[a-zA-Z\s]*$/',
			'password' => 'required',
			'image' => 'nullable|mimes:png,jpg',
			'date_of_birth' => 'required',//ganti lg nnti
			'ein' => 'required'//TODO : pikirin ein d-o-b sama gender
		]);

		$username = $request->post('username');
        $email = $request->post('email');
		$password = $request->post('password');
		$image = $request->post('image');
		$date_of_birth = $request->post('date_of_birth');
		$ein = $request->post('ein');

		UserCreationService::getInstance()->createAdmin($username, $email, $password, $image, $date_of_birth, $ein);

		$request->session()->flash('message', 'Admin created.');
		return back();
	}

	public function createWarehouseStaff(Request $request) {
		$request->validate([
			'username' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|regex:/^[a-zA-Z\s]*$/',
			'password' => 'required',
			'image' => 'nullable|mimes:png,jpg'
		]);

		UserCreationService::getInstance()->createWarehouseStaff(
			$request->post('username'),
            $request->post('email'),
			$request->post('password'),
			$request->file('image'),

		);

		$request->session()->flash('message', 'Warehouse Staff created.');
		return back();
	}

	public function createRequester(Request $request) {
		$request->validate([
			'username' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|regex:/^[a-zA-Z\s]*$/',
			'password' => 'required',
			'image' => 'nullable|mimes:png,jpg'
		]);

		UserCreationService::getInstance()->createRequester(
			$request->post('username'),
            $request->post('email'),
			$request->post('password'),
			$request->file('image')
		);

		$request->session()->flash('message', 'Requester created.');
		return back();
	}
}
