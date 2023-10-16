<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Item;
use App\Models\Warehouse;
use App\Models\DetailItem;
use App\Traits\SingletonTrait;

class ItemService{

	use SingletonTrait;

	public function create(string $name, Warehouse|int $warehouse, DetailItem|int $detailItem, string $description, string $series, string $total, string $image) {
		$item = new Item();
		$item->name = $name;
		$item->warehouse_id = $warehouse instanceof Warehouse ? $warehouse->id : $warehouse;
        $item->detail_item_id = $detailItem instanceof DetailItem ? $detailItem->id : $detailItem;
        $item->description= $description;
		$item->series = $series;
        $item->total= $total;
        $item->image= $image;
		$item->save();
	}

	public function update(Item|int $item, string $name, Warehouse|int $warehouse, DetailItem|int $detailItem, string $description, string $series, string $total, string $image) {
		Item::query()->find($item instanceof Item ? $item->id : $item)
			->update([
				'name' => $name,
				'warehouse_id' => $warehouse instanceof Warehouse ? $warehouse->id : $warehouse,
                'detail_item_id' => $detailItem instanceof DetailItem ? $detailItem->id : $detailItem,
                'description' => $description,
                'series' => $series,
                'total' => $total,
                'image' => $image,
			]);
	}

    public function delete(Item|int $item) {
		Item::query()->find($item instanceof Item ? $item->id : $item)->delete();
	}
}
