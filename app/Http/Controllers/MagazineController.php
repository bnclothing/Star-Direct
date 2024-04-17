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
        // Récupérer tous les magazines principaux
        $magazinesPrincipaux = "prinsipale"; // Magazine::whereNull('principal_id')->get();

        // Récupérer tous les magazines secondaires
        $magazinesSecondaires = "secandaires"; // Magazine::whereNotNull('principal_id')->get();
        
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
}
