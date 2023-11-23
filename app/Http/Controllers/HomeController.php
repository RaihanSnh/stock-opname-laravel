<?php

namespace App\Http\Controllers;

use App\Models\DetailItem;
use App\Models\Items;
use App\Models\ReportIn;
use App\Models\ReportOut;
use App\Models\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function user() {
        $user = User::all(); 
        return response()->json($user);
    }

    public function itemSelection() {
        $items = Items::all(); 
        return response()->json($items);
    }

    public function itemAll() {
        $items = DetailItem::with(['items', 'warehouse'])
            ->get();
        
        $items->map(function ($item) {
            $item->image = asset('images/item/' . ($item->image ? $item->image : 'default.jpg'));
            return $item;
        });
    
        return response()->json($items);
    }

    public function item() {
        $items = DetailItem::with(['items', 'warehouse'])
            ->groupBy('item_id')
            ->get();
    
        $items->map(function ($item) {
            $item->image = asset('images/item/' . ($item->image ? $item->image : 'default.jpg'));
            return $item;
        });
    
        return response()->json($items);
    }

    public function itemRequest($warehouse_id) {
        $items = DetailItem::with('warehouse', 'items')
            ->where('detail_items.warehouse_id', $warehouse_id)
            ->get();

        $items->map(function ($item) {
            $item->image = asset('images/item/' . ($item->image ? $item->image : 'default.jpg'));
            return $item;
        });

        return response()->json($items);
    }

    public function request() {
        $request = Request::with(['form.items', 'form.user'])->get();

        // $request->each(function ($item) {
        //     $img = 'images/item/' . $item->form->items->image;
        //     $item->form->items->image = $img;
        // });

        for($i = 0; $i < 1; $i++) {
            $img = $request[$i]->form->items->image;
            $request[$i]->form->items->image = asset('images/item/' . $img);
        }
        
        return response()->json($request);
    }

    public function reportin() {
        $reportin = ReportIn::with('items.items')->get(); 
        return response()->json($reportin);
    }

    public function reportout() {
        $reportout = ReportOut::with('request.form.items.items')->get(); 
        return response()->json($reportout);
    }
}
