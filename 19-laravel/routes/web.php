<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\CustomerController;
use App\Models\User;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas protegidas por el AdminMiddleware (Exclusivo para administradores)
    Route::get('myadoptions', [AdoptionController::class, 'myadoptions']);

    // Rutas protegidas por el AdminMiddleware (Exclusivo para administradores)
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
        Route::resources([
            'users' => UserController::class,
            'adoptions' => AdoptionController::class,
        ]);
        Route::resource('pets', PetController::class)->except(['index', 'show']);

        // Exports PDF
        Route::get('export/users/pdf', [UserController::class, 'pdf']);

        // Exports Excel
        Route::get('export/users/excel', [UserController::class, 'excel']);

        // Import Excel
        Route::post('import/users', [UserController::class, 'import']);
        
        // Search Users
        Route::post('search/users', [UserController::class, 'search']);

        //Exports Pets PDF
        Route::get('export/pets/pdf', [PetController::class, 'pdf']);

        // Exports Pets Excel
        Route::get('export/pets/excel', [PetController::class, 'excel']);

        // Exports Adoptions PDF
        Route::get('export/adoptions/pdf', [AdoptionController::class, 'pdf']);

        // Exports Adoptions Excel
        Route::get('export/adoptions/excel', [AdoptionController::class, 'excel']);

        // Search Adoptions
        Route::post('search/adoptions', [AdoptionController::class, 'search']);
    });

    // Solo lectura y búsqueda de mascotas para todos los usuarios autenticados
    Route::resource('pets', PetController::class)->only(['index', 'show']);
    Route::post('search/pets', [PetController::class, 'search']);

    Route::get('myprofile/', [CustomerController::class, 'myprofile']);
    Route::put('myprofile/{id}', [CustomerController::class, 'updateprofile']);

    Route::get('myadoptions/', [CustomerController::class, 'myadoptions']);
    Route::get('myadoption/{id}', [CustomerController::class, 'showadoption']);
    
    Route::get('makeadoption', [CustomerController::class, 'makeadoption']);
    Route::post('makeadoption', [CustomerController::class, 'storeAdoption']);
    Route::post('search/adoptionpets', [CustomerController::class, 'search']);
    Route::post('search/myadoptions', [CustomerController::class, 'searchMyAdoptions']);
    Route::get('showpet/{id}', [CustomerController::class, 'showpet']);
    Route::get('listpets', [CustomerController::class, 'listpets']);

});



require __DIR__.'/auth.php';
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
    // Crear carpeta images si no existe
    if (!file_exists(public_path('images'))) {
        mkdir(public_path('images'), 0777, true);
    }
    
    // Verificar si hay usuarios
    if (User::count() < 20) {
        User::factory()->count(20)->create();
    }
    
    $users = User::take(20)->get();

    foreach ($users as $user) {
        $imagePath = public_path('images/' . $user->photo);
        if (!file_exists($imagePath)) {
            try {
                $gender = ($user->gender == 'Male') ? 'men' : 'women';
                $url = "https://randomuser.me/api/portraits/{$gender}/" . rand(1,99) . ".jpg";
                file_put_contents($imagePath, file_get_contents($url));
            } catch (\Exception $e) {
            }
        }
    }
    
    $output = "<h2>Usuarios Challenge</h2>";
    $output .= "<table>";
    $output .= "<tr bgcolor='#d9534f'>";
    $output .= "<th><font color='#ffffff'>Photo</font></th>";
    $output .= "<th><font color='#ffffff'>Fullname</font></th>";
    $output .= "<th><font color='#ffffff'>Age</font></th>";
    $output .= "<th><font color='#ffffff'>Created At</font></th>";
    $output .= "</tr>";
    
    foreach ($users as $user) {
        $age = Carbon::parse($user->birthdate)->age;
        
        $output .= "<tr>";
        $output .= "<td align='center'>";
        if (file_exists(public_path('images/' . $user->photo))) {
            $output .= "<img src='" . asset('images/' . $user->photo) . "' width='52' height='52' alt='photo'>";
        } else {
            $output .= "🖼️";
        }
        $output .= "</td>";
        $output .= "<td>" . $user->fullname . "</td>";
        $output .= "<td>" . $age . " Years old</td>";
        $output .= "<td>" . $user->created_at . "</td>";
        $output .= "</tr>";
    }
    
    $output .= "</table>";
    
    return $output;
});

Route::get('getall/pets', function(){
    $pets = App\Models\Pet::all();
    return view('getallpets')->with('pets', $pets);
});

Route::get('challenge-pets', function () {
    if (!file_exists(public_path('images'))) {
        mkdir(public_path('images'), 0777, true);
    }
    
    if (\App\Models\Pet::count() < 20) {
        \App\Models\Pet::factory()->count(20 - \App\Models\Pet::count())->create();
    }
    
    return redirect('pets')->with('message', 'Mascotas de prueba (Challenge Pets) con imágenes generadas exitosamente!');
});