<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-emerald-700 min-h-dvh flex items-center justify-center">

    <div class="bg-emerald-200 p-10 rounded-xl shadow-xl w-96">

        <div class="flex justify-center mb-6 border-b-2 pb-4">
            <img src="{{ asset('images/pet-banner.png') }}" 
                 alt="Pet Detail"
                 class="h-20 object-contain drop-shadow-lg">
        </div>

        <div class="space-y-3 text-emerald-900">

            <p><strong>ID:</strong> {{ $pet->id }}</p>
            <p><strong>Name:</strong> {{ $pet->name }}</p>
            <p><strong>Kind:</strong> {{ $pet->kind }}</p>
            <p><strong>Breed:</strong> {{ $pet->breed }}</p>
            <p><strong>Weight:</strong> {{ $pet->weight }} kg</p>
            <p><strong>Age:</strong> {{ $pet->age }} years</p>
            <p><strong>Location:</strong> {{ $pet->location }}</p>
            <p><strong>Description:</strong> {{ $pet->description }}</p>
            <p><strong>Created:</strong> {{ $pet->created_at->format('d/m/Y') }}</p>
            <p><strong>Updated:</strong> {{ $pet->updated_at->format('d/m/Y') }}</p>

        </div>

        <div class="mt-6 text-center">
            <a href="{{ url('getall/pets') }}" 
               class="bg-emerald-800 text-emerald-200 px-4 py-2 rounded hover:bg-emerald-900 transition">
               Back
            </a>
        </div>

    </div>

</body>
</html>