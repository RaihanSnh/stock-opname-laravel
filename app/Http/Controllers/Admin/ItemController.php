<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\DetailItem;
use App\Models\Item;
use App\Services\Admin\ItemService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use function back;

class ItemController{

	public function create(Request $request) {
		
		$code = $request->post('code');
		$name = $request->post('name');
		$description = $request->post('description');
		$series = $request->post('series');
		$total = $request->post('total');
		$image = $request->file('image');
		$category_id = $request->post('category_id');
		$unit_id = $request->post('unit_id');
		$warehouse_id = $request->post('warehouse_id');
		$vendor = $request->post('vendor');

		ItemService::getInstance()->createItem($code, $name, $description, $series, $total, $vendor, $image, (int) $warehouse_id, (int) $category_id, (int) $unit_id);

		return response()->json(['message' => 'Item created.', 'request' => $request->all()], Response::HTTP_CREATED);
	}

	public function view($id) {
		$item = DetailItem::with('items')->find($id);
		$item->image = asset('images/'.'item/' . $item->image);

		return response()->json(['item' => $item]);
	}

	public function update(DetailItem $item, Request $request) {
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

	public function delete($id) {
	
		ItemService::getInstance()->delete($id);
	
		return response()->json(['message' => 'User deleted.'], Response::HTTP_OK);
	}
	
}
