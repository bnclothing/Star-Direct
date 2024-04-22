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
use Illuminate\Validation\Rule;

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
        $validatedData = $request->validate([
            'LastName' => 'required|string',
            'FirstName' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'type' => 'required|in:1,2,3,4',
        ], [
            'LastName.required' => 'The last name field is required.',
            'LastName.string' => 'The last name must be a string.',
            'FirstName.required' => 'The first name field is required.',
            'FirstName.string' => 'The first name must be a string.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'phone.required' => 'The phone field is required.',
            'phone.string' => 'The phone number must be a string.',
            'phone.unique' => 'The phone number is already in use.',
            'type.required' => 'The type field is required.',
            'type.in' => 'The selected type is invalid.',
        ]);

        try {
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

                    $Magazin = Magazine::where('id_magazine', $request->magazineResponsable)->get();
                    $Magazin->responsable_id = $request->magazineResponsable;
                    $Magazin->save();

                    Responsable::create([
                        'user_id' => $newUser->user_id,
                        'id_magazine' => $request->magazineResponsable,
                    ]);
                    break;
                case "2":
                    $request->validate(['magazinesVendeurs' => 'required|array|min:1']);
                    foreach ($request->magazinesVendeurs as $magazine) {
                        seller_magazine::create([
                            'user_id' => $newUser->user_id,
                            'id_magazine' => $magazine,
                        ]);
                    }
                    break;
                case "3":
                    $request->validate(['PrimaryMagazines' => 'required']);
                    Client_Magazine::create([
                        'user_id' => $newUser->user_id,
                        'id_magazine' => $request->PrimaryMagazines,
                    ]);
                    break;
                case "4":
                    $request->validate([
                        'magazinesFournisseur' => 'required',
                    ]);

                    $magazinesFournisseur = $request->input('magazinesFournisseur');

                    supplier::create([
                        'user_id' => $newUser->user_id,
                        'id_currency' => ($request->nationality === "1") ? 'MAD' : $request->currency,
                        'is_national' => ($request->nationality === "1") ? true : false,
                    ]);

                    if (is_array($magazinesFournisseur)) {
                        foreach ($magazinesFournisseur as $magazine) {
                            supplier_magazine::create([
                                'user_id' => $newUser->user_id,
                                'id_magazine' => $magazine,
                            ]);
                        }
                    } else {
                        // Handle the case where there's only a single selected value
                        supplier_magazine::create([
                            'user_id' => $newUser->user_id,
                            'id_magazine' => $magazinesFournisseur,
                        ]);
                    }

                    break;
            }

            return redirect()->route('home')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            // Delete the newly created user if an exception occurs
            if (isset($newUser)) {
                User::where('user_id', $newUser->user_id)->delete();
            }
            // Redirect back with error message
            return back()->with('error', $e->getMessage());
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

    public function getUserDetails(Request $request)
    {
        // Retrieve the user details based on the user_id sent in the request
        $userData = User::where('user_id', $request->userId)->first();
        $AllMagazines = Magazine::all();

        //Return Data based on the user type
        if ($request->userType == '1') {
            $responsableMagazin = Magazine::where('responsable_id', $request->userId)->first();
            $magazinName = $responsableMagazin->magazine_name;

            return response()->json(['userData' => $userData, 'magazinName' => $magazinName]);
        } elseif ($request->userType == '2') {
            $magazineNames =
                Magazine::whereIn('id_magazine', function ($query) use ($request) {
                    $query->select('id_magazine')
                        ->from('seller_magazines')
                        ->where('user_id', $request->userId);
                })->get();

            return response()->json(['userData' => $userData, 'magazineNames' => $magazineNames, 'AllMagazines' => $AllMagazines]);
        } elseif ($request->userType == '3') {
            $magazineNames =
                Magazine::whereIn('id_magazine', function ($query) use ($request) {
                    $query->select('id_magazine')
                        ->from('client__magazines')
                        ->where('user_id', $request->userId);
                })->pluck('magazine_name')->toArray();

            $AllPrimaryMagazines = Magazine::where('magazine_type', '1')->get();

            return response()->json(['userData' => $userData, 'magazineNames' => $magazineNames, 'AllPrimaryMagazines' => $AllPrimaryMagazines]);
        } else {
            $CurrentMagazines
                = Magazine::whereIn('id_magazine', function ($query) use ($request) {
                    $query->select('id_magazine')
                        ->from('supplier_magazines')
                        ->where('user_id', $request->userId);
                })->pluck('magazine_name')->toArray();

            $AllCurrencies = Currency::all();
            $selectedCurrency = DB::table('suppliers')->where('user_id', $request->userId)->value('id_currency');
            $IsNational = DB::table('suppliers')->where('user_id', $request->userId)->value('is_national');

            return response()->json([
                'userData' => $userData,
                'CurrentMagazines' => $CurrentMagazines,
                'AllMagazines' => $AllMagazines,
                'AllCurrencies' => $AllCurrencies,
                'selectedCurrency' => $selectedCurrency,
                'IsNational' => $IsNational,
            ]);
        }
    }

    public function editUser(Request $request)
    {
        $validatedData = $request->validate(
            [
                'user_id' => 'required',
                'user_name' => 'required',
                'user_email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($request->user_id, 'user_id'), // Pass the user ID directly
                ],
                'user_phone' => [
                    'required',
                    Rule::unique('users', 'phone')->ignore($request->user_id, 'user_id'), // Pass the user ID directly
                ],
            ],
            [
                'user_id.required' => 'The user ID field is required.',
                'user_name.required' => 'The user name field is required.',
                'user_email.required' => 'The user email field is required.',
                'user_email.email' => 'Please enter a valid email address for the user email.',
                'user_email.unique' => 'The email address provided is already in use.',
                'user_phone.required' => 'The user phone field is required.',
                'user_phone.unique' => 'The phone number provided is already in use.',
            ]
        );

        try {
            // Find the user by user_id
            $user = User::where('user_id', $request->user_id)->first();

            // Check if the user exists
            if ($user) {
                // Update the user's attributes with the new values
                $user->name = $request->input('user_name');
                $user->email = $request->input('user_email');
                $user->phone = $request->input('user_phone');

                // Save the changes to the database
                $user->save();

                //Change other table
                if ($user->type == '1') {
                } elseif ($user->type == '2' && !empty($request->NewMagazin_SellerSelect)) {
                    // Delete old magazines
                    seller_magazine::where('user_id', $request->user_id)->delete();

                    // Store new magazines
                    foreach ($request->NewMagazin_SellerSelect as $magazine) {
                        seller_magazine::create([
                            'user_id' => $request->user_id,
                            'id_magazine' => $magazine,
                        ]);
                    }
                } elseif ($user->type == '3'&& !empty($request->NewMagazin_ClientSelect)) {
                    // Delete old magazines
                    Client_Magazine::where('user_id', $request->user_id)->delete();

                    // Store new magazines
                    foreach ($request->NewMagazin_ClientSelect as $magazine) {
                        Client_Magazine::create([
                            'user_id' => $request->user_id,
                            'id_magazine' => $magazine,
                        ]);
                    }
                } elseif ($user->type == '4') {
                    // Handle Magazines
                    if(!empty($request->NewMagazines_SupplierSelect)){
                        // Delete old magazines
                        supplier_magazine::where('user_id', $request->user_id)->delete();

                        // Store new magazines
                        foreach ($request->NewMagazines_SupplierSelect as $magazine) {
                            supplier_magazine::create([
                                'user_id' => $request->user_id,
                                'id_magazine' => $magazine,
                            ]);
                        }
                    }

                    //Handle Currency Changes
                    if ($request->Nationality_SupplierSelect == '1') {
                        supplier::where('user_id', $request->user_id)->update(['id_currency' => 'MAD']);
                    }
                    else{
                        supplier::where('user_id', $request->user_id)->update(['id_currency' => $request->Currency_SupplierSelect]);
                    }

                    //Handle Nationality Changes
                    supplier::where('user_id', $request->user_id)->update(['is_national' => $request->Nationality_SupplierSelect]);
                }

                return back()->with('success', 'User updated successfully');
            } else {
                return back()->with('error', 'User not found');
            }
        } catch (\Exception $e) {
            // Redirect back with error message

            return back()->with('error', 'Something went wrong, please try again');
        }
    }
    public function deleteUser(Request $request)
    {
        // Delete the user
        $isDeleted = User::where('user_id', $request->userId)->delete();

        // Check if the user was deleted successfully
        if ($isDeleted) {

            //delete data of the user from other tables
            if ($request->userType == '1') {
                Magazine::where('responsable_id', $request->userId)
                    ->update(['responsable_id' => null]);

                Responsable::where('user_id', $request->userId)->delete();
            } elseif ($request->userType == '2') {
                seller_magazine::where('user_id', $request->userId)->delete();
            } elseif ($request->userType == '3') {
                Client_Magazine::where('user_id', $request->userId)->delete();
            } elseif ($request->userType == '4') {
                supplier::where('user_id', $request->userId)->delete();
                supplier_magazine::where('user_id', $request->userId)->delete();
            }

            return response()->json(['IsUserDeleted' => '1']);
        } else {
            // Handle the case where the user was not deleted successfully
            return response()->json(['IsUserDeleted' => '0']);
        }
    }
}
