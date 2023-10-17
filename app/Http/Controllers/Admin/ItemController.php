<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Services\Admin\ItemService;
use Illuminate\Http\Request;
use function back;

class ItemController{

	public function create(Request $request) {
		$request->validate([
			'name' => 'required',
			'description' => 'required',
			'series' => 'required',
			'total' => 'required',
			'image' => 'required|mimes:png,jpg'
		]);

		ItemService::getInstance()->create(
			$request->post('name'),
			(int) $request->get('warehouse_id'),
			$request->post('description'),
			$request->post('series'),
			$request->post('total'),
			$request->post('image'),
			(int) $request->get('detail_item_id'),
			'in'
		);
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
