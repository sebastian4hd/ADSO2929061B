<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Adoptions</title>
    <style>
        table {
            border: 2px solid #aaa;
            border-collapse: collapse;
            width: 100%;
        }
        table th, table td {
            font-family: sans-serif;
            font-size: 10px;
            border: 2px solid #ccc;
            padding: 4px;
        }
        table tr:nth-child(odd) {
            background-color: #eee;
        }
        table th {
            background-color: #666;
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 style="font-family: sans-serif; text-align:center;">Adoptions Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User Photo</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Pet Image</th>
                <th>Pet Name</th>
                <th>Pet Kind</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adoptions as $adoption)
            <tr>
                <td style="text-align:center;">{{ $adoption->id }}</td>
                <td style="text-align:center;">
                    @php
                        $user_ext = substr($adoption->user->photo, -4);
                    @endphp
                    @if ($user_ext != 'webp' && $user_ext != '.svg')
                        <img src="{{ public_path().'/images/'.$adoption->user->photo }}" width="48px">
                    @endif
                </td>
                <td>{{ $adoption->user->fullname }}</td>
                <td>{{ $adoption->user->email }}</td>
                <td style="text-align:center;">
                    @php
                        $pet_ext = substr($adoption->pet->image, -4);
                    @endphp
                    @if ($pet_ext != 'webp' && $pet_ext != '.svg')
                        <img src="{{ public_path().'/images/'.$adoption->pet->image }}" width="48px">
                    @endif
                </td>
                <td>{{ $adoption->pet->name }}</td>
                <td>{{ $adoption->pet->kind }}</td>
                <td>{{ $adoption->created_at->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
