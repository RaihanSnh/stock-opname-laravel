<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Item;
use App\Models\Report;
use App\Models\ReportIn;
use App\Models\Unit;
use App\Models\Warehouse;
use App\Traits\SingletonTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ItemService{

	use SingletonTrait;

	public function createItem(string $code, string $name, string $description, string $series, string $total, string $vendor, ?UploadedFile $image, int $warehouse, int $category, int $unit): void 
	{
		$item = $this->create($code, $name, $description, $series, $total, $warehouse, $category, $unit);
		$this->processImage($item, $image, 'images/item');

		$item->save();
		
		$reportin = new ReportIn();
		$reportin->item_id = $item->id;
		$reportin->vendor = $vendor;

		$reportin->save();
	}

	private function create($code, $name, $description, $series, $total, $warehouse, $category, $unit): Item
    {
		$item = new Item();
		$item->code = $code;
		$item->name = $name;
		$item->warehouse_id = $warehouse instanceof Warehouse ? $warehouse->id : $warehouse;
		$item->category_id = $category instanceof Category ? $category->id : $category;
		$item->unit_id = $unit instanceof Unit ? $unit->id : $unit;
		$item->description= $description;
		$item->series = $series;
		$item->image = 'default.jpg';
		$item->total= $total;

		return $item;
    }

	public function createVendor($vendor)
	{
		$reportin = new ReportIn();
		$reportin->item_id = $item->id;
		$reportin->vendor = $vendor;

		$reportin->save();

		return $reportin;
	}

	public function createreport($report)
	{
		$report = new Report();
		$report->reports_in_id = $reportin->id;
		$report->warehouse_staff_id = auth()->user()->id;

		$report->save();

		return $report;
	}

	private function processImage(Item $item, ?UploadedFile $image, string $destination): void
	{
		if ($image !== null) {
			
			$fileName = Str::random(16) . '.' . $image->extension();
			$image->move(public_path($destination), $fileName);
			$item->image = $fileName;
		}
	}

	public function update(Item|int $item, string $name, Warehouse|int $warehouse, DetailItem|int $detailItem, string $description, string $series, string $total, string $image, string $status) {
		Item::query()->find($item instanceof Item ? $item->id : $item)
			->update([
				'name' => $name,
				'warehouse_id' => $warehouse instanceof Warehouse ? $warehouse->id : $warehouse,
                'detail_item_id' => $detailItem instanceof DetailItem ? $detailItem->id : $detailItem,
                'description' => $description,
                'series' => $series,
                'total' => $total,
                'image' => $image,
				'status' => $status
			]);
	}

    public function delete(string $id) {
		$item = Item::find($id);

		if ($item instanceof Item) {
        	$fileName = $item->image;

			if ($fileName !== 'default.jpg') {
				$image_path = public_path('images/item/'.$fileName);
				unlink($image_path);
			}
			$item->delete();
		}
	}
}
