@extends('backend.layout.master')
@section('title', 'Create Category')
@section('c_menu-open', 'menu-open') 
@section('c_active', 'active') 

@section('content')
<div class="container mt-4">
    <h2>Create Category</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
