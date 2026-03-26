<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
        margin: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    thead {
        background-color: #007bff;
        color: white;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
    }

    th {
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.05em;
    }

    tbody tr {
        border-bottom: 1px solid #ddd;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    td {
        font-size: 14px;
        color: #333;
    }
</style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>FullName</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Photo</th>
                <th>Phone</th>
                <th>Email</th>
                <th>role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->birthdate}}</td>
                    <td>{{$user->photo}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>