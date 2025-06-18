@extends('backend.layout.master')
@section('title', 'Edit Category')
@section('c_menu-open', 'menu-open') 
@section('c_active', 'active') 

@section('content')
<div class="container mt-4">
    <h2>Edit Category</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>
@endsection
