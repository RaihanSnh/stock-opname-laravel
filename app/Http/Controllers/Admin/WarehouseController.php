<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Services\Admin\WarehouseService;
use Illuminate\Http\Request;
use function back;

class WarehouseController extends Controller{

	public function create(Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		WarehouseService::getInstance()->create($request->post('name'));
		$request->session()->flash('message', 'Warehouse created.');
		return back();
	}

	public function update(Warehouse $warehouse, Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		WarehouseService::getInstance()->update($warehouse, $request->post('name'));

		$request->session()->flash('message', 'Warehouse updated.');
		return back();
	}

	public function delete(Warehouse $warehouse, Request $request) {
		WarehouseService::getInstance()->delete($warehouse);

		$request->session()->flash('message', 'Warehouse deleted.');
		return back();
	}

}
