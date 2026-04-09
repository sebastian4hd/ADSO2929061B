<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
// PDF
use Barryvdh\DomPDF\Facade\Pdf;
// Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PetsExport;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::orderBy('id', 'desc')->paginate(12);
        return view('pets.index')->with('pets', $pets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validation = $request->validate([
            'name' => ['required', 'string'],
            'image' => ['required', 'image'],
            'kind' => ['required', 'string'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'bread' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if($validation) {
            if($request->hasFile('image')) {
                $image = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $image);
            }
        }

        $pet = new Pet;
        $pet->name = $request->name;
        $pet->image = $image ?? 'no-image.png';
        $pet->kind   = $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->bread = $request->bread;
        $pet->location = $request->location;
        $pet->description = $request->description;

        if($pet->save()) {
            return redirect('pets')->with('message','The Pet: '.$pet->name.' was added successful!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        return view('pets.edit')->with('pet', $pet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
         $validation = $request->validate([
            'name' => ['required', 'string'],
            'kind' => ['required', 'string'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'bread' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if($validation) {
            if($request->hasFile('image')) {
                $image = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $image);
                // Delete old image
                if($request->originimage != 'no-image.png' && file_exists(public_path('images/'.$pet->image))) {
                    unlink(public_path('images/'.$pet->image));
                }
            } else {
                $image = $request->originimage ?? $pet->image;
            }
        }

        $pet->name = $request->name;
        $pet->image = $image;
        $pet->kind   = $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->bread = $request->bread;
        $pet->location = $request->location;
        $pet->description = $request->description;

        if($pet->save()) {
            return redirect('pets')->with('message','The Pet: '.$pet->name.' was edited successful!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        // Delete old image
        if($pet->image != 'no-image.png' && file_exists(public_path('images/'.$pet->image))) {
            unlink(public_path('images/'.$pet->image));
        }

        if($pet->delete()) {
            return redirect('pets')->with('message','The Pet: '.$pet->name.' was deleted successful!');
        }
    }

    /**
     * Generate a PDF file
     */
    public function pdf() {
        $pets = Pet::all();
        $pdf = Pdf::loadView('pets.pdf', compact('pets'));
        return $pdf->download('allpets.pdf');
    }

    /**
     * Generate a Excel file
     */
    public function excel() {
       return Excel::download(new PetsExport, 'allpets.xlsx');
    }


    /**
     * Search Pets
     */
    public function search(Request $request) {
        $pets = Pet::names($request->q)->orderBy('id', 'desc')->paginate(12);
        return view('pets.search')->with('pets', $pets);
    }
}
