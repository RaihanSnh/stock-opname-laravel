<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailItem;
use App\Models\Category;
use App\Models\Unit;
use App\Services\Admin\DetailItemService;
use Illuminate\Http\Request;
use function back;

class DetailItemController extends Controller
{
	public function create(Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
			'category_id' => 'required|exists:category,id',
			'unit_id' => 'required|exists:unit,id'
		]);

		DetailItemService::getInstance()->create(
			$request->post('name'),
			(int) $request->get('category_id'),
			(int) $request->get('unit_id')
		);
		$request->session()->flash('message', 'Detail created');
		return back();
	}

	public function update(DetailItem $detail_item, Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
			'category_id' => 'required|exists:category,id',
			'unit_id' => 'required|exists:unit,id'
		]);

		DetailItemService::getInstance()->update(
			$detail_item,
			$request->post('name'),
			(int) $request->post('category_id'),
			(int) $request->post('unit_id')
		);
		$request->session()->flash('message', 'Detail updated');
		return back();
	}

	public function delete(DetailItem $detail_item, Request $request) {
		$detail_item->delete();

		$request->session()->flash('message', 'Detail deleted');
		return back();
	}
}
