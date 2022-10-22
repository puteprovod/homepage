@extends('layouts.main')
@section ('content')
    <form action ="{{ route ('posts.update', $post->id); }}" method="post">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}" placeHolder="Title">
            <div id="titleHelp" class="form-text">С заглавной буквы.</div>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content" placeHolder="Content">{{ $post->content }}</textarea>
            <div id="contentHelp" class="form-text">Максимум 255 символов.</div>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="text" name="image" class="form-control" id="image" value="{{ $post->image }}" placeHolder="Image">
            <div id="imageHelp" class="form-text">Начиная с http:\\.</div>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" aria-label="Category" id="category" name="category_id">
                <option selected>Open this select menu</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id === $post->category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
