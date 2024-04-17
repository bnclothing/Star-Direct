<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $MagazineWithoutResponsable = Magazine::whereNotIn('id_magazine', function ($query) {
            $query->select('id_magazine')
                ->from('responsables');
        })->where('magazine_type', 1)->where('is_active', 1)->get();

        $AllMagazines = Magazine::all();

        $PrimaryMagazines = Magazine::where('magazine_type', 1)->get();
        $SecondaryMagazines = Magazine::where('magazine_type', 2)->get();
        
        return view('addUtilisateurs', compact('MagazineWithoutResponsable', 'AllMagazines', 'PrimaryMagazines', 'SecondaryMagazines'));
    }

    public function store(Request $request)
    {
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
