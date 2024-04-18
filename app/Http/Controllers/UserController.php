<?php

namespace App\Http\Controllers;

use App\Models\Client_Magazine;
use App\Models\Currency;
use App\Models\Magazine;
use App\Models\Responsable;
use App\Models\seller_magazine;
use App\Models\supplier;
use App\Models\supplier_magazine;
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
        $AllCurrencies = Currency::all();
        return view('addUtilisateurs', compact('MagazineWithoutResponsable', 'AllMagazines', 'PrimaryMagazines', 'SecondaryMagazines', 'AllCurrencies'));
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

        // Now you can access the user_id of the newly created user
        $newUserId = $newUser->id;


        if ($type == "1") {
            $magazineResponsable = $request->magazineResponsable;

            Responsable::create([
                'user_id' => $newUserId,
                'id_magazine' => $magazineResponsable
            ]);
        } else if ($type == "2") {
            $magazinesVendeurs = $request->input('magazinesVendeurs');
            if (is_array($magazinesVendeurs)) {
                foreach ($magazinesVendeurs as $magazine) {
                    seller_magazine::create([
                        'user_id' => $newUserId,
                        'id_magazine' => $magazine
                    ]);
                }
            } else {
                // Handle the case where there's only a single selected value
                seller_magazine::create([
                    'user_id' => $newUserId,
                    'id_magazine' => $magazinesVendeurs
                ]);
            }

        } else if ($type == "3") {
            $PrimaryMagazines = $request->PrimaryMagazines;

            Client_Magazine::create([
                'user_id' => $newUserId,
                'id_magazine' => $PrimaryMagazines
            ]);
        } else if ($type == "4") {
            $nationality = $request->nationality;
            if ($nationality == "1") {
                $currency = "MAD";
            }
            $currency = $request->currency;

            supplier::created([
                'user_id' => $newUserId,
                'id_currency' => $currency,
                'is_national' => ($nationality == "1") ? true : false
            ]);

            $magazinesFournisseur = $request->magazinesFournisseur;
            foreach ($magazinesFournisseur as $magazine) {
                supplier_magazine::created([
                    'user_id' => $newUserId,
                    'id_magazine' => $magazine
                ]);
            }
        }

       return redirect()->route('home');
    }
}
