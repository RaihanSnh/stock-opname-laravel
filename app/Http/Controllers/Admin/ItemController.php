<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\DetailItem;
use App\Models\Item;
use App\Models\Report;
use App\Services\Admin\ItemService;
use Illuminate\Http\Request;
use function back;

class ItemController{

	// public function create(Request $request) {
	// 	$request->validate([
	// 		'name' => 'required|string',
	// 		'description' => 'required|string',
	// 		'series' => 'required|string',
	// 		'total' => 'required|integer',
	// 		'image' => 'required|mimes:png,jpg',
	// 	]);

	// 	$no = 1;
	// 	$code = 'ABC' . str_pad($no, 3, '0', STR_PAD_LEFT);

	// 	ItemService::getInstance()->create(
	// 		$code,
	// 		$request->post('name'),
	// 		(int) $request->get('warehouse_id'),
	// 		$request->post('description'),
	// 		$request->post('series'),
	// 		$request->post('total'),
	// 		$request->post('image'),
	// 		(int) $request->get('detail_item_id'),
	// 	);
	// 	$request->session()->flash('message', 'Item added');
	// 	return back();
	// }

	public function create(Request $request) {
		$request->validate([
			'name' => 'required',
			'description' => 'required',
			'series' => 'required',
			'total' => 'required',
			'image' => 'required|mimes:png,jpg',
		]);

		$data = [
			'code' => $request->input('code'),
			'name' => $request->input('name'),
			'description' => $request->input('description'),
			'series' => $request->input('series'),
			'total' => $request->input('total'),
			'image' => $request->input('image'),
			'idcategory' => $request->input('idcategory'),
			'idunit' => $request->input('idunit'),
		];

		ItemService::getInstance()->create($data);
		$request->session()->flash('message', 'Item added');
		return back();
	}

	public function update(Item $item, Request $request) {
		$request->validate([
			'name' => 'required',
			'description' => 'required',
			'series' => 'required',
			'total' => 'required',
			'image' => 'required|mimes:png,jpg'
		]);

		ItemService::getInstance()->update(
			$item,
			$request->post('name'),
			(int) $request->get('warehouse_id'),
			$request->post('description'),
			$request->post('series'),
			$request->post('total'),
			$request->post('image'),
			(int) $request->get('detail_item_id')
		);
		$request->session()->flash('message', 'Item added');
		return back();
	}

	public function delete(Item $item, Request $request) {
		$item->delete();

		$request->session()->flash('message', 'Item deleted');
		return back();
	}

	public function give(Item $item, Request $request) {
		ItemService::getInstance()->update(
			$item,
			$item->name,
			(int) $item->warehouse_id,
			$item->description,
			$item->series,
			$item->total,
			$item->image,
			(int) $item->detail_item_id,
			'out'
		);
		$request->session()->flash('message', 'Item given to requester');
		return back();
	}
	
}
