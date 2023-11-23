<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Form;
use App\Traits\SingletonTrait;

class TransactionService{

	use SingletonTrait;

	public function create(string $name) {
		$form = new Form();
        
		$form->save();

        return $form;
	}

	public function request(string $id, string $name) {
		$category = Category::find($id);
		$category->name = $name;
		$category->save();
	}

	public function delete(string $id) {
		$category = Category::find($id);
		$category->delete();
	}
}
