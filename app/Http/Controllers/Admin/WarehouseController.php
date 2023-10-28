<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Services\Admin\WarehouseService;
use Illuminate\Http\Request;
use function back;

class WarehouseController extends Controller{
	public function warehouse() {
		$warehouse = Warehouse::all();

		return response()->json($warehouse);
	}

	public function create(Request $request) {
		$request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        ]);

		$name = $request->input('name');
	
		WarehouseService::getInstance()->create($name);
	
		return response()->json(['message' => 'Warehouse created.'], 201);
	}

	public function view($id) {
		$warehouse = Warehouse::find($id);

		return response()->json(['warehouse' => $warehouse]);
	}

	public function update($id, Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		$name = $request->input('name');

		WarehouseService::getInstance()->update($id, $name);

		return response()->json(['message' => 'Warehouse updated.'], 201);
	}

	public function delete($id) {
		WarehouseService::getInstance()->delete($id);

		return response()->json(['message' => 'Warehouse Deleted.'], 201);
	}

}
