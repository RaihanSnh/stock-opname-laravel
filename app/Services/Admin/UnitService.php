<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Unit;
use App\Traits\SingletonTrait;

class UnitService{

	use SingletonTrait;

	public function create(string $name) {
		$unit = new Unit();
		$unit->name = $name;
		$unit->save();
	}

	public function update(string $id, string $name) {
		$unit = Unit::find($id);
		$unit->name = $name;
		$unit->save();
	}

	public function delete(string $id) {
		$unit = Unit::find($id);
		$unit->delete();
	}
}
