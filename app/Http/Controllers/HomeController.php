<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin() {
        Item::all();
        return response()->json(['message' => 'Atmin']);
    }
}
