<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Services\Admin\UnitService;
use Illuminate\Http\Request;
use function back;

class UnitController extends Controller{

	public function create(Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		UnitService::getInstance()->create($request->post('name'));
		$request->session()->flash('message', 'Unit created.');
		return back();
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
