@extends('backend.layout.master')
@section('title', 'Create Branch')
@section('p_menu-open', 'menu-open') 
@section('p_active', 'active')  
@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Product</h1>
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm mt-2" style="font-size: 18px;">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add New Category</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="container mt-4">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
    <label for="cost">Cost</label>
    <input type="number" name="cost" id="cost" class="form-control" required>
</div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Branch</label>
            <select name="branch_id" class="form-control" required>
                <option value="">-- Select Branch --</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>

@endsection

@push('scripts')
<script>
    // Reset form fields and file input label
    function resetForm() {
        const form = document.getElementById('branchForm');
        form.reset();
        document.querySelector('.custom-file-label').textContent = 'Choose file';
    }

    // Show selected file name
    document.querySelector('.custom-file-input')?.addEventListener('change', function (e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
        document.querySelector('.custom-file-label').textContent = fileName;
    });
</script>
@endpush
