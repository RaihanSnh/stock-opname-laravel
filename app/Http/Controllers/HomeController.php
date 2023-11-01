<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function user() {
        $user = User::all(); 
        return response()->json($user);
    }

    public function item() {
        $item = Item::all(); 
        foreach($item as $i) {
            $i->image = asset('images/'.'item/' . $i->image);
        }
        return response()->json($item);
    }
}
