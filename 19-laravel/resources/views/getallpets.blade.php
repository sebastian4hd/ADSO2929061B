<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Get All Pet (View)</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-emerald-700 min-h-dvh p-14">
    <h1 class="text-emerald-200 text-4xl text-center border-b-2 pb-4">Get All Pets (View)</h1>
    <table class="table table-border mt-5 bg-emerald-200">
        <thead>
            <tr class="bg-emerald-800 text-emerald-200">
                <th >ID</th>
                <th>NAME</th>
                <th>KIND</th>
                <th>BREED</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
                <tr class=" even:bg-emerald-300">
                    <td>{{ $pet->id }}</td>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->kind }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td><a href="{{url('show/pet/'.$pet->id)}}" class="bg-emerald-800 flex p-2 text-emerald-200 w-10 rounded justify-center scale-90 hover:scale-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M152,112a8,8,0,0,1-8,8H120v24a8,8,0,0,1-16,0V120H80a8,8,0,0,1,0-16h24V80a8,8,0,0,1,16,0v24h24A8,8,0,0,1,152,112Zm77.66,117.66a8,8,0,0,1-11.32,0l-50.06-50.07a88.11,88.11,0,1,1,11.31-11.31l50.07,50.06A8,8,0,0,1,229.66,229.66ZM112,184a72,72,0,1,0-72-72A72.08,72.08,0,0,0,112,184Z"></path></svg>
                    </a>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>