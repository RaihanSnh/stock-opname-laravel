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

	public function delete(Category|int $category) {
		Category::query()->find($category instanceof Category ? $category->id : $category)->delete();
	}

	public function update(Category|int $category, string $name) {
		Category::query()->find($category instanceof Category ? $category->id : $category)->update(['name' => $name]);
	}
}
