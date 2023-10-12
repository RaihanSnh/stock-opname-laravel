<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use function back;

class CategoryController extends Controller{

	public function create(Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		CategoryService::getInstance()->create($request->post('name'));
		$request->session()->flash('message', 'Category created.');
		return back();
	}

	public function update(Category $category, Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		CategoryService::getInstance()->update($category, $request->post('name'));

		$request->session()->flash('message', 'Category updated.');
		return back();
	}

	public function delete(Category $category, Request $request) {
		CategoryService::getInstance()->delete($category);

		$request->session()->flash('message', 'Category deleted.');
		return back();
	}

}
