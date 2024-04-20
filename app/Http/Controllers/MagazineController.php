<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use App\Models\Responsable;
use App\Models\User;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index()
    {
        
        
        $usersNotResponsables = User::whereNotIn('user_id', function ($query) {
            $query->select('user_id')
            ->from('responsables');
        })->where('type', 1)->get();

        return view('addMagazines', compact('magazinesPrincipaux', 'magazinesSecondaires', 'usersNotResponsables'));
    }

    public function store(Request $request)
    {
        $MagazineName = $request->MagazineName;
        $MagazineCode = $request->MagazineCode;
        $MagazineAdress = $request->MagazineAdress;
        $MagazineType = $request->MagazineType;
        $MagazineResponsable = $request->MagazineResponsable;


        $newMagazine= Magazine::create([
            'code_magazine' => $MagazineCode,
            'magazine_name' => $MagazineName,
            'magazine_adresse' => $MagazineAdress,
            'magazine_type' => $MagazineType,
            'responsable_id' => $MagazineResponsable
        ]);

        Responsable::create([
            'user_id' => $MagazineResponsable,
            'id_magazine' => $newMagazine->id,
            
        ]);

        return redirect()->route('home');
    }

    public function showAll(){
        $AllMagazines = Magazine::paginate(8);

        return view('showAllMagazines', compact('AllMagazines'));
    }

    public function searchMagazine(Request $request)
    {
        // Retrieve search parameters from the request
        $searchCode = $request->input('code');
        $searchName = $request->input('name');
        $searchAdresse = $request->input('adresse');
        $searchType = $request->input('type');
        $searchStatus = $request->input('status');
        $searchMagazinePrimaire = $request->input('magazinePrimaire');
        $searchResponsable = $request->input('responsable');

        // Query to retrieve filtered magazines based on search parameters
        $query = Magazine::query();

        // Join the responsible table to get user information
        $query->join('responsables', 'magazines.responsable_id', '=', 'responsables.user_id')
            ->join('users', 'responsables.user_id', '=', 'users.user_id');

        if ($searchCode) {
            $query->where('magazines.code_magazine', 'like', '%' . $searchCode . '%');
        }

        if ($searchName) {
            $query->where('magazines.magazine_name', 'like', '%' . $searchName . '%');
        }

        if ($searchAdresse) {
            $query->where('magazines.magazine_adresse', 'like', '%' . $searchAdresse . '%');
        }

        if ($searchType) {
            $query->where('magazines.magazine_type', '=', $searchType);
        }

        if ($searchStatus !== null) {
            $query->where('magazines.is_active', '=', $searchStatus);
        }

        if ($searchMagazinePrimaire) {
            $query->where('magazines.id_primary_magazine', '=', $searchMagazinePrimaire);
            //select magazine_name from magazines where type='1' and magazine_name like '$searchMagazinePrimaire
        }

        if ($searchResponsable) {
            $query->where('users.name', 'like', '%' . $searchResponsable . '%');
        }

        // Retrieve paginated results
        $AllMagazines = $query->paginate(8);

        // Return the view with filtered magazines
        return view('partials.magazine_table_rows', compact('AllMagazines'))->render();
    }


}
