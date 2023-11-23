<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\DetailItem;
use App\Models\Item;
use App\Models\Items;
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
		$item = Items::where('name', $name)->first();

		if (!$item) {
			$item = new Items();
			$item->name = $name;
			$item->save();
		}

		$detailitem = $this->create($code, $description, $series, $total, $warehouse, $category, $unit, $vendor);
		$this->processImage($detailitem, $image, 'images/item');
		$detailitem->item_id = $item->id;
		$detailitem->save();

		$reportin = new ReportIn();
		$reportin->item_id = $detailitem->id;
		$reportin->total = $total;
		$reportin->save();

		// $report = new Report();
		// $report->reports_in_id = $reportin->id;
		// // $report->warehouse_staff_id = auth()->user()->id;

		// $report->save();
	}

	private function create($code, $description, $series, $total, $warehouse, $category, $unit, $vendor): DetailItem
    {
		$detailitem = new DetailItem();
		$detailitem->code = $code;
		$detailitem->description= $description;
		$detailitem->series = $series;
		$detailitem->total= $total;
		$detailitem->warehouse_id = $warehouse instanceof Warehouse ? $warehouse->id : $warehouse;
		$detailitem->category_id = $category instanceof Category ? $category->id : $category;
		$detailitem->unit_id = $unit instanceof Unit ? $unit->id : $unit;
		$detailitem->image = 'default.jpg';
		$detailitem->vendor= $vendor;

		return $detailitem;
    }

	private function processImage(DetailItem $detailitem, ?UploadedFile $image, string $destination): void
	{
		if ($image !== null) {
			
			$fileName = Str::random(16) . '.' . $image->extension();
			$image->move(public_path($destination), $fileName);
			$detailitem->image = $fileName;
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
