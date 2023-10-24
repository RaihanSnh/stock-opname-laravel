<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Category;
use App\Traits\SingletonTrait;

class CategoryService{

	use SingletonTrait;

	public function create(string $name) {
		$category = new Category();
		$category->name = $name;
		$category->save();
	}

	public function update(string $id, string $name) {
		$category = Category::find($id);
		$category->name = $name;
		$category->save();
	}

	public function delete(string $id) {
		$category = Category::find($id);
		$category->delete();
	}
}
