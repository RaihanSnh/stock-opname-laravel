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

	public function update(Unit $unit, Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		UnitService::getInstance()->update($unit, $request->post('name'));

		$request->session()->flash('message', 'Unit updated.');
		return back();
	}

	public function delete(Unit $unit, Request $request) {
		UnitService::getInstance()->delete($unit);

		$request->session()->flash('message', 'Unit deleted.');
		return back();
	}

}
