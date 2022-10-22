@extends('layouts.main')
@section ('content')
<div>
    <div>{{ $post->id }}.</div><div>{{ $post->title }}</div>
    <div>{{ $post->content }}</div>
</div>
<div>
    <a href="{{ route ('posts.edit',$post->id) }}" class="btn btn-primary">Edit</a>
</div>
<div>
    <form action="{{ route ('posts.destroy',$post->id) }}" method="post">
        @csrf
        @method('delete')
    <button type="submit" class="btn btn-primary">Delete</button>
    </form>
</div>
<div>
    <a href="{{ route ('posts.index') }}">Back</a>
</div>
@endsection
