<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Warehouse;
use App\Traits\SingletonTrait;

class WarehouseService{

	use SingletonTrait;

	public function create(string $name) {
		$warehouse = new Warehouse();
		$warehouse->name = $name;
		$warehouse->save();
	}

	public function update(string $id, string $name) {
		$warehouse = Warehouse::find($id);
		$warehouse->name = $name;
		$warehouse->save();
	}

	public function delete(string $id) {
		$warehouse = Warehouse::find($id);
		$warehouse->delete();
	}
}
