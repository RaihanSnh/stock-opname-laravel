<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use function back;

class CategoryController extends Controller{

	public function category() {
		$category = Category::all();

		return response()->json($category);
	}

	public function create(Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		$name = $request->input('name');
	
		CategoryService::getInstance()->create($name);
	
		return response()->json(['message' => 'Category created.'], 201);
	}

	public function view($id) {
		$category = Category::find($id);

		return response()->json(['category' => $category]);
	}

	public function update($id, Request $request) {
		$request->validate([
			'name' => 'required|string|regex:/^[a-zA-Z\s]*$/'
		]);

		$name = $request->input('name');

		CategoryService::getInstance()->update($id, $name);

		return response()->json(['message' => 'Category updated.'], 201);
	}

	public function delete($id) {
		CategoryService::getInstance()->delete($id);

		return response()->json(['message' => 'Category Deleted.'], 201);
	}

}
