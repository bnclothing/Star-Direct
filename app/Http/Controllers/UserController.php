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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $MagazineWithoutResponsable = Magazine::whereNotIn('id_magazine', function ($query) {
            $query->select('id_magazine')->from('responsables');
        })->where('magazine_type', 1)->where('is_active', 1)->get();

        $AllMagazines = Magazine::all();
        $PrimaryMagazines = Magazine::where('magazine_type', 1)->get();
        $SecondaryMagazines = Magazine::where('magazine_type', 2)->get();
        $AllCurrencies = Currency::all();

        return view('addUtilisateurs', compact('MagazineWithoutResponsable', 'AllMagazines', 'PrimaryMagazines', 'SecondaryMagazines', 'AllCurrencies'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'LastName' => 'required|string',
                'FirstName' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|unique:users,phone',
                'type' => 'required|in:1,2,3,4',
            ],
        );

            $newUser = User::create([
                'name' => $request->LastName . ' ' . $request->FirstName,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make('password'),
                'type' => $request->type,
            ]);

            switch ($request->type) {
                case "1":
                    $request->validate(['magazineResponsable' => 'required']);
                    Responsable::create([
                        'user_id' => $newUser->id,
                        'id_magazine' => $request->magazineResponsable,
                    ]);
                    break;
                case "2":
                    $request->validate(['magazinesVendeurs' => 'required|array|min:1']);
                    foreach ($request->magazinesVendeurs as $magazine) {
                        seller_magazine::create([
                            'user_id' => $newUser->id,
                            'id_magazine' => $magazine,
                        ]);
                    }
                    break;
                case "3":
                    $request->validate(['PrimaryMagazines' => 'required']);
                    Client_Magazine::create([
                        'user_id' => $newUser->id,
                        'id_magazine' => $request->PrimaryMagazines,
                    ]);
                    break;
                case "4":
                    $magazinesFournisseur = $request->input('magazinesFournisseur');

                    $request->validate([
                        'currency' => 'required',
                        'magazinesFournisseur' => 'required',
                    ]);

                    supplier::create([
                        'user_id' => $newUser->id,
                        'id_currency' => ($request->nationality === "1") ? 'MAD' : $request->currency,
                        'is_national' => ($request->nationality === "1") ? true : false,
                    ]);

                    if (is_array($magazinesFournisseur)) {
                        foreach ($magazinesFournisseur as $magazine) {
                            supplier_magazine::create([
                                'user_id' => $newUser->id,
                                'id_magazine' => $magazine,
                            ]);
                        }
                    } else {
                        // Handle the case where there's only a single selected value
                        supplier_magazine::create([
                            'user_id' => $newUser->id,
                            'id_magazine' => $magazinesFournisseur,
                        ]);
                    }

                    break;
            }

            return redirect()->route('home')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            // Delete the newly created user if an exception occurs
            if (isset($newUser)) {
                User::where('user_id', $newUser->id)->delete();
            }

            // Redirect back with error message
            return back()->with('error', 'Some fields were not filled.');
        }
    }


    public function showAll()
    {
        $AllUsers = User::paginate(8);

        return view('showAllUsers', compact('AllUsers'));
    }

    public function searchUser(Request $request)
    {
        // Retrieve search parameters from the request
        $searchName = $request->input('name');
        $searchEmail = $request->input('email');
        $searchType = $request->input('type');
        $searchPhone = $request->input('phone');

        // Query to retrieve filtered users based on search parameters
        $query = User::query();

        if ($searchName) {
            $query->where('name', 'like', '%' . $searchName . '%');
        }

        if ($searchEmail) {
            $query->where('email', 'like', '%' . $searchEmail . '%');
        }

        if ($searchType) {
            $query->where('type', '=', $searchType);
        }

        if ($searchPhone) {
            $query->where('phone', 'like', '%' . $searchPhone . '%');
        }

        // Retrieve paginated results
        $AllUsers = $query->paginate(8);

        // Return the view with filtered users
        return view('partials.user_table_rows', compact('AllUsers'))->render();
    }

    public function getUserDetails(Request $request){
        $userData=User::where('user_id',$request->userId)->first();

        return view('partials.editUserMoadal', compact('userData'));
    }

}
