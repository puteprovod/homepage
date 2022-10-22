@extends('layouts.main')
@section ('content')
    <div>
        <a href="{{ route ('posts.create') }}" class="btn btn-primary">Add new post</a>
    </div>
    <div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Image</th>
            <th scope="col">Likes</th>
        </tr>
        </thead>
        <tbody>
@foreach($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td><a href="{{ route ('posts.show',$post->id) }}">{{ $post->title }}</a></td>
            <td>{{ $post->content }}</td>
            <td>{{ $post->image }}</td>
            <td>{{ $post->likes }}</td>
        </tr>
    @endforeach
        </tbody>
    </table>
    </div>
    <div>
        {{ $posts->withQueryString()->links() }}
    </div>

@endsection

