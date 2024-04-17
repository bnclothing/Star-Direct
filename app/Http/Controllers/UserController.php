<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('addUtilisateurs');
    }

    public function store(Request $request){
        $LastName = $request->LastName;
        $FirstName = $request->FirstName;
        $email = $request->email;
        $phone = $request->phone;
        $type = $request->type;


        $newUser = User::create([
            'name' => $LastName . ' ' . $FirstName,
            'email' => $email,
            'phone' => $phone,
            'password' => Hash::make('password'),
            'type' => $type
        ]);

        return redirect()->route('home');
    }
}
