<?php

namespace App\Http\Controllers\Admin;

use App\Models\DetailItem;
use App\Models\Form;
use App\Models\ReportOut;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class FormController
{
    public function store(Request $request) {
		$itemIds 		= $request->post('item_id');
		$requesterId 	= $request->post('requester_id');
		$reasons 		= $request->post('reason');
		$totals 		= $request->post('total');

		foreach ($itemIds as $itemId) {
			DetailItem::findOrFail($itemId);

			$form = Form::create([
				'item_id'	=> $itemId,
				'user_id' 	=> $requesterId,
				'reason' 	=> $reasons[$itemId],
            	'total' 	=> $totals[$itemId]
			]);

			ModelsRequest::create([
				'form_id' 		=> $form->id,
				'requester_id' 	=> $requesterId,
				'status'		=> 'pending'
			]);
		}
				
		return response()->json(['message' => 'Data successfully added to cart'], 200);
	}

	public function action(Request $request, $id) {
		$status = $request->input('status');
		$requestTable = ModelsRequest::find($id);
		$requestTable->status = $status;
		$requestTable->save();

		ReportOut::create([
			'request_id'	=> $requestTable->id
		]);
	}
}
