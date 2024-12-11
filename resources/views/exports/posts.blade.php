
<table style="width: 150%">
    <thead >
        <tr>

            <th>Title</th>
            <th>Body</th>
            <th>User</th>
            <th>Tags</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->user->name }}</td>
                <td>
                    @foreach ($post->tags as $tag)
                        <h3>{{ $tag->name }}</h3>
                    @endforeach
                </td>
                <td>{{ $post->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
