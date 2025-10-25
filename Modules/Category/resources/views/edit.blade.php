@extends('dashboard::layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" placeholder="Enter category name" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Category Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($category->image)
                <img src="{{ asset('uploads/categories/'.$category->image) }}" width="80" height="80" class="mt-2">
            @endif
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
