<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB;use App\Models\User;
use App\Models\Adoption;
use App\Models\Pet;

class CustomerController extends Controller
{
    public function myprofile()
    {
        $user = User::find(Auth::user()->id);
        return view('customer.myprofile')->with('user', $user);
    }

    public function updateprofile(Request $request)
    {
        $validation = $request->validate([
            'document' => ['required', 'numeric', 'unique:' . User::class . ',document,' . $request->id],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'unique:' . User::class . ',email,' . $request->id],
        ]);

        if ($validation) {
            //dd($request->all());
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
                // Delete old Photo
                if ($request->originphoto != 'no-photo.png' && file_exists(public_path('images/' . $request->originphoto))) {
                    unlink(public_path('images/' . $request->originphoto));
                }
            } else {
                $photo = $request->originphoto;
            }
        }
        $user = User::find(Auth::user()->id);
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($user->save()) {
            return redirect('dashboard')
                ->with('message', 'My profile was edited successful!');
        }
    }

    public function myadoptions()
    {
        $adoptions = Adoption::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('customer.myadoptions')->with('adoptions', $adoptions);
    }

    public function showmyadoption(Request $request)
    {
        $adoption = Adoption::find($request->id);
        return view('customer.showadoption')->with('adopt', $adoption);
    }

    public function showadoption(Request $request)
    {
        $adoption = Adoption::find($request->id);
        return view('customer.showadoption')->with('adopt', $adoption);
    }

    public function search(Request $request)
    {
        $pets = Pet::kind($request->q)->orderBy('id', 'desc')->paginate(12);
        return view('customer.search')->with('pets', $pets);
    }

    public function searchMyAdoptions(Request $request)
    {
        $adoptions = Adoption::with(['user', 'pet'])
            ->where('user_id', Auth::user()->id)
            ->whereHas('pet', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->q}%")
                      ->orWhere('kind', 'LIKE', "%{$request->q}%")
                      ->orWhere('bread', 'LIKE', "%{$request->q}%");
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('customer.myadoptions-search')->with('adoptions', $adoptions);
    }

    public function listpets(Request $request)
    {
        $pets = Pet::doesntHave('adoptions')->orderBy('id', 'desc')->paginate(12);
        return view('customer.listpets')->with('pets', $pets);
    }

    public function showpet(Request $request)
    {
        $pet = Pet::find($request->id);
        return view('customer.showpet')->with('pet', $pet);
    }


    public function makeadoption(Request $request)
    {
        $pets = Pet::doesntHave('adoptions')->orderBy('id', 'desc')->paginate(12);
        return view('customer.makeadoption')->with('pets', $pets);
    }

    public function storeAdoption(Request $request)
    {
        $request->validate([
            'pet_id' => ['required', 'exists:pets,id'],
        ]);

        $countAdoptions = Adoption::where('user_id', Auth::user()->id)->count();
        if ($countAdoptions >= 3) {
            return redirect('dashboard')->with('error', 'Its not possible, more than three adoptions person');
        }

        $pet = Pet::find($request->pet_id);
        if (!$pet || $pet->adoptions) {
            return redirect('makeadoption')->with('error', 'This pet is already adopted or does not exist.');
        }

        DB::transaction(function () use ($pet) {
            $adoption = new Adoption;
            $adoption->user_id = Auth::user()->id;
            $adoption->pet_id = $pet->id;
            $adoption->save();

            $pet->adopted = 1;
            $pet->save();
        });

        return redirect('myadoptions')->with('message', 'Pet adopted successfully!');
    }
}