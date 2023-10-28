<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin() {
        Item::all();
        return response()->json(['message' => 'Atmin']);
    }

    public function user() {
        $user = User::all();
        return response()->json($user);
    }
}
