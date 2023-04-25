<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Visitor list</title>
    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 10px auto;
            font-family: Arial, Helvetica, sans-serif;
            position: relative;
            top:20px;
        }

        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        td,
        th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div style="width:95%; margin: 0 auto;">
        <div style="width: 10%; float:left; margin-right:20px;">
            <img src="https://dummyimage.com/300x300.c4c4c4/e1e1e8.png&text=logo" width="100%" alt="">
        </div>
        <div style="width: 50% float: left;">
            <h1>Visitor List</h1>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>email</th>
                <th>contact</th>
                <th>Transport</th>
                <th>Check in</th>
                <th>Check out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->id }}</td>
                    <td>{{ $visitor->name }}</td>
                    <td>{{ $visitor->email }}</td>
                    <td>{{ $visitor->contact }}</td>
                    <td>{{ $visitor->transport }}</td>
                    <td>{{ $visitor->datetime_in }}</td>
                    <td>{{ $visitor->datetime_out }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
