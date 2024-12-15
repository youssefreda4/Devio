<!DOCTYPE html>
<html>

<head>
    <title>Users Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-bordered th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 0.4em 0.8em;
            font-size: 10px;
            color: #fff;
            border-radius: 4px;
        }

        .bg-warning {
            background-color: #ffc107;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        .page-break {
            page-break-after: auto;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <h1 class="text-center">Users Report</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Writer</th>
                <th>Count of Posts</th>
                <th>Total Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td class="text-center">{{ $user->total_posts }}</td>
                    <td class="text-center">{{ $user->total_comments }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="page-break"></div>
</body>

</html>
