<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\DetailItem;
use app\Models\Category;
use App\Models\Unit;
use App\Traits\SingletonTrait;

class DetailItemService{

	use SingletonTrait;

	public function create(string $name, Category|int $category, Unit|int $unit) : DetailItem{
		$detail_item = new DetailItem();
		$detail_item->name = $name;
		$detail_item->category_id = $category instanceof Category ? $category->id : $category;
		$detail_item->unit_id = $unit instanceof Unit ? $unit->id : $unit;
		$detail_item->save();
		return $detail_item;
	}

	public function update(DetailItem|int $detail_item, string $name, Category|int $category, Unit|int $unit) {
		DetailItem::query()->find($detail_item instanceof DetailItem ? $detail_item->id : $detail_item)
			->update([
				'name' => $name,
				'category_id' => $category instanceof Category ? $category->id : $category,
				'unit_id' => $unit instanceof Unit ? $unit->id : $unit,
			]);
	}

    public function delete(DetailItem|int $detail_item) {
		DetailItem::query()->find($detail_item instanceof DetailItem ? $detail_item->id : $detail_item)->delete();
	}
}
