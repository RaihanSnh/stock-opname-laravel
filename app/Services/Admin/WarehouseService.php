<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Warehouse;
use App\Traits\SingletonTrait;

class WarehouseService{

	use SingletonTrait;

	public function create(string $name) {
		$major = new Warehouse();
		$major->name = $name;
		$major->save();
	}

	public function delete(Warehouse|int $warehouse) {
		Warehouse::query()->find($warehouse instanceof Warehouse ? $warehouse->id : $warehouse)->delete();
	}

	public function update(Warehouse|int $warehouse, string $name) {
		Warehouse::query()->find($warehouse instanceof Warehouse ? $warehouse->id : $warehouse)->update(['name' => $name]);
	}
}
