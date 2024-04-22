<?php

namespace App\Http\Controllers;

use App\Models\charge;
use App\Models\check;
use App\Models\Cofre;
use App\Models\especes;
use App\Models\Magazine;
use App\Models\User;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index()
    {
        // Récupérer tous les magazines principaux
        $magazinesPrincipaux = Magazine::where('magazine_type', 1)->get();
        // Récupérer tous les magazines secondaires
        $magazinesSecondaires = Magazine::where('magazine_type', 2)->get();

        $usersNotResponsables = User::whereNotIn('user_id', function ($query) {
            $query->select('user_id')
                ->from('responsables');
        })->where('type', 1)->get();

        return view('addMagazines', compact('magazinesPrincipaux', 'magazinesSecondaires', 'usersNotResponsables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Add validation rules for each field here
            'MagazineName' => 'required',
            'MagazineCode' => 'required',
            'MagazineAdress' => 'required',
            // Add more fields as needed
        ]);

        // Check if the request has the necessary data
        if (!$request->has('coffreType') || empty($request->coffreType)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in the required fields.');
        }

        if (Magazine::where('code_magazine', $request->MagazineCode)->exists()) {
            return redirect()->back()->withInput()->with('code_exists', 'Magazine code already exists.');
        }
        $MagazineName = $request->MagazineName;
        $MagazineCode = $request->MagazineCode;
        $MagazineAdress = $request->MagazineAdress;
        $MagazineType = $request->MagazineType;
        $MagazineResponsable = $request->MagazineResponsable;

        $newMagazine = Magazine::create([
            'code_magazine' => $MagazineCode,
            'magazine_name' => $MagazineName,
            'magazine_adresse' => $MagazineAdress,
            'magazine_type' => $MagazineType,
            'responsable_id' => $MagazineResponsable
        ]);

        if ($MagazineType == 1) { // Check if magazine type is secondary
            if ($request->has('charges')) {
                foreach ($request->charges as $chargeData) {
                    $charge = new charge();
                    $charge->charge_name = $chargeData['charge_name'];
                    $charge->charge_amount = $chargeData['charge_amount'];
                    // Associate charge with the newly created magazine
                    $charge->id_magazine = $newMagazine->id;
                    $charge->save();
                }
            }
        } else if ($MagazineType == 2) {
            if ($request->has('selectedCharges')) {
                $selectedCharges = json_decode($request->selectedCharges, true);

                foreach ($selectedCharges as $chargeId) {
                    $charge = Charge::find($chargeId);

                    // Duplicate the charge
                    $newCharge = $charge->replicate();
                    $newCharge->save();

                    // Associate the duplicated charge with the newly created magazine
                    $newMagazine->charges()->save($newCharge);
                }
            }
        }

        if ($request->has('coffreType')) {
            $coffreType = $request->coffreType;

            // Create coffre record based on the selected type
            if ($coffreType === 'espèce') {
                $coffre = new Cofre();
                $coffre->type = 'espèce';
                $coffre->montant_espece = $request->montantEspèce;
                $coffre->id_magazine = $newMagazine->id;

                $coffre->save();

                // Retrieve the id of the saved Cofre model
                $coffreId = $coffre->id;
                
                $espec = new especes();
                $espec->amount = $request->montantEspèce;
                $espec->coffre_id = $coffreId; // Assign the id of the Cofre model
                $espec->save();
            } elseif ($coffreType === 'check') {
                // Loop through the submitted check details
                $coffre = new Cofre();
                $coffre->type = 'check';
                $coffre->id_magazine = $newMagazine->id;
                for ($i = 0; $i < count($request->numeroChecks); $i++) {

                    $check = new check();

                    $check->num_check = $request->numeroChecks[$i];
                    $check->user_name = $request->nomUtilisateur[$i];
                    $check->montant_check = $request->montantCheck[$i];
                    $check->id_magazine = $newMagazine->id;

                    $check->save();
                    $coffre->montant_espece +=  $request->montantCheck[$i];
                }
                $coffre->save();
            } elseif ($coffreType === 'both') {
                // Create coffre record for espèce
                $coffre = new Cofre();
                $espec = new especes();
                $coffre->type = 'both';
                $coffre->id_magazine = $newMagazine->id;
                $coffreId = $coffre->id;

                $espec->coffre_id = $coffreId;
                $espec->amount = $request->montantEspèce;
                $coffre->montant_espece = $request->montantEspèce;
                $coffre->id_magazine = $newMagazine->id;


                // Loop through the submitted check details
                for ($i = 0; $i < count($request->numeroChecks); $i++) {
                    $coffreCheck = new check();
                    $coffreCheck->num_check = $request->numeroChecks[$i];
                    $coffreCheck->user_name = $request->nomUtilisateur[$i];
                    $coffreCheck->montant_check = $request->montantCheck[$i];
                    $coffreCheck->id_magazine = $newMagazine->id;
                    $coffreCheck->save();
                    $coffre->montant_espece += $request->montantCheck[$i];
                }
                $coffre->save();
            }
        }
        return redirect()->route('home')->with('success', 'Magazine added successfully!');
    }
    public function showAll()
    {
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

    public function getCharges($magazineId)
    {
        $charges = charge::where('id_magazine', $magazineId)->get();
        return response()->json($charges);
    }
}
