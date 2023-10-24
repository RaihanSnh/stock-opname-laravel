<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Services\Admin\UnitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function back;

class UnitController extends Controller{
	public function Unit() {
		$unit = Unit::all();

		return response()->json($unit);
	}
	
	public function create(Request $request) {
		$request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        ]);

		$name = $request->input('name');
	
		UnitService::getInstance()->create($name);
	
		return response()->json(['message' => 'Unit created.'], 201);
	}

	public function view($id) {
		$unit = Unit::find($id);

		return response()->json(['unit' => $unit]);
	}

	public function update($id, Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		$name = $request->input('name');

		UnitService::getInstance()->update($id, $name);

		return response()->json(['message' => 'Unit updated.'], 201);
	}

	public function delete($id) {
		UnitService::getInstance()->delete($id);

		return response()->json(['message' => 'Unit Deleted.'], 201);
	}

}
