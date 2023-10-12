<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\CreateUserService;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function createRequester(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'name' => 'required'
        ]);

        
        CreateUserService::getInstance()->createRequester(
            $request->post('email'),
            $request->post('password'),
            $request->post('name')
        );
        
        $request->session()->flash('message', 'Requester created');
        return back();
    }
}
