<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function () {
    return "<h1>Hello Laravel 🚀</h1>";
});

Route::get('sayhello/{name}', function () {
    return "<h1>Hello: ".request()->name."</h1>";
});

Route::get('getall/pets', function(){
    $pets = App\Models\Pet::all();
    dd($pets->toArray()); 
});

Route::get('show/pet/{id}', function(){
    $pet = App\Models\Pet::find(request()->id);
    dd($pet->toArray()); 
});

Route::get('challenge', function () { 
    if (User::count() < 20) {
        User::factory()->count(20)->create();
    }
    
    $users = User::take(20)->get();

    $output = "<style>
        body {
            font-family: Arial;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: auto;
        }
        th {
            background: #3715cc;
            color: white;
            padding: 4px;
        }
        td {
            padding: 4px;
            border: 1px solid #000000;
        }
    </style>";
    
    $output .= "<table>";
    $output .= "<tr><th>ID</th><th>Fullname</th><th>Age</th><th>Gender</th><th>Created At</th><th>Updated At</th></tr>";
    
    foreach ($users as $user) {
        $age = Carbon::parse($user->birthdate)->age;
        
        $output .= "<tr>";
        $output .= "<td>" . $user->id . "</td>";
        $output .= "<td>" . $user->fullname . "</td>";
        $output .= "<td>" . $age . " años</td>";
        $output .= "<td>" . $user->gender . "</td>";
        $output .= "<td>" . $user->created_at->format('d/m/Y') . "</td>";
        $output .= "<td>" . $user->updated_at->format('d/m/Y') . "</td>";
        $output .= "</tr>";
    }
    
    $output .= "</table>";
    
    return $output;
});

Route::get('getall/pets', function() {
    $pets = App\Models\Pet::all();
    return view('getallpets')->with('pets', $pets);
});

Route::get('show/pet/{id}', function($id) {
    $pet = App\Models\Pet::findOrFail($id);
    return view('showPet', compact('pet'));
});