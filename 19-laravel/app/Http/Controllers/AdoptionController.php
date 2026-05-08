<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdoptionsExport;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adoptions = Adoption::with(['user', 'pet'])->orderBy('id', 'desc')->paginate(12);
        return view('adoptions.index')->with('adoptions', $adoptions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'Customer')->get();
        $pets = Pet::where('adopted', 0)->get();
        return view('adoptions.create', compact('users', 'pets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'pet_id' => ['required', 'exists:pets,id'],
        ]);

        $countAdoptions = Adoption::where('user_id', $request->user_id)->count();

        if ($countAdoptions >= 3) {
            return redirect('adoptions')->with('error', 'It is not possible, this user already has the maximum limit of 3 adoptions.');
        }

        $adoption = Adoption::create($validation);
        
        $pet = Pet::find($request->pet_id);
        if ($pet) {
            $pet->adopted = 1;
            $pet->save();
        }

        return redirect('adoptions')->with('message','The Adoption was added successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Adoption $adoption)
    {
        return view('adoptions.show')->with('adoption', $adoption);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adoption $adoption)
    {
        $users = User::where('role', 'Customer')->get();
        $pets = Pet::where('adopted', 0)->orWhere('id', $adoption->pet_id)->get();
        return view('adoptions.edit', compact('adoption', 'users', 'pets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adoption $adoption)
    {
        $validation = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'pet_id' => ['required', 'exists:pets,id'],
        ]);

        if ($adoption->user_id != $request->user_id) {
            $countAdoptions = Adoption::where('user_id', $request->user_id)->count();
            if ($countAdoptions >= 3) {
                return redirect('adoptions')->with('error', 'It is not possible, the selected user already has the maximum limit of 3 adoptions.');
            }
        }

        if ($adoption->pet_id != $request->pet_id) {
            $oldPet = Pet::find($adoption->pet_id);
            if ($oldPet) {
                $oldPet->adopted = 0;
                $oldPet->save();
            }

            $newPet = Pet::find($request->pet_id);
            if ($newPet) {
                $newPet->adopted = 1;
                $newPet->save();
            }
        }

        $adoption->update($validation);

        return redirect('adoptions')->with('message','The Adoption was edited successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adoption $adoption)
    {
        $pet = Pet::find($adoption->pet_id);
        if ($pet) {
            $pet->adopted = 0;
            $pet->save();
        }

        $adoption->delete();
        return redirect('adoptions')->with('message','The Adoption was deleted successful!');
    }

    public function pdf() {
        $adoptions = Adoption::with(['user', 'pet'])->get();
        $pdf = Pdf::loadView('adoptions.pdf', compact('adoptions'));
        return $pdf->download('alladoptions.pdf');
    }

    public function excel() {
       return Excel::download(new AdoptionsExport, 'alladoptions.xlsx');
    }

    public function search(Request $request) {
        $adoptions = Adoption::names($request->q)->orderBy('id', 'desc')->paginate(12);
        return view('adoptions.search')->with('adoptions', $adoptions);
    }

    public function myadoptions() {
        $adoptions = Adoption::with(['user', 'pet'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('adoptions.myadoptions')->with('adoptions', $adoptions);
    }
}
