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

	public function delete(Unit|int $unit) {
		Unit::query()->find($unit instanceof Unit ? $unit->id : $unit)->delete();
	}

	public function update(Unit|int $unit, string $name) {
		Unit::query()->find($unit instanceof Unit ? $unit->id : $unit)->update(['name' => $name]);
	}
}
