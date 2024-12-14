<!DOCTYPE html>
<html>

<head>
    <title>Posts Report</title>
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
    <h1 class="text-center">Posts Report</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Writer</th>
                <th>Tags</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td class="text-center">
                        @forelse ($post->tags as $tag)
                            <span class="badge bg-warning my-1">{{ $tag->name }}</span>
                            <br>
                            <br>
                        @empty
                            <span class="badge bg-danger my-1">No Tag!</span>
                        @endforelse
                    </td>
                    {{-- @dd($post->image) --}}
                    <td>
                        <!-- Display Image -->
                        <img src="{{ public_path($post->image) }}" width="150px" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page-break"></div>
</body>

</html>
