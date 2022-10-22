@extends('layouts.main')
@section ('content')
    <form action ="{{ route ('posts.store'); }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeHolder="Title">
            <div id="titleHelp" class="form-text">С заглавной буквы.</div>
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content" placeHolder="Content">{{ old('content') }}</textarea>
            <div id="contentHelp" class="form-text">Максимум 255 символов.</div>
            @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="text" name="image" class="form-control" id="image" placeHolder="Image" value="{{ old('image') }}">
            <div id="imageHelp" class="form-text">Начиная с http:\\.</div>
            @error('image')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" aria-label="Category" id="category" name="category_id">
            <option selected>Open this select menu</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if ($category->id==old('category_id'))  selected @endif>{{ $category->title }}</option>
            @endforeach
        </select>
            @error('category_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
