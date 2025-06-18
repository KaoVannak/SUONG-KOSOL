@extends('backend.layout.master')
@section('title', 'Create Branch')
@section('m_menu-open', 'menu-open') 
@section('m_active', 'active')  
@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Branch</h1>
                <a href="{{ route('branches.index') }}" class="btn btn-outline-primary btn-sm mt-2" style="font-size: 18px;">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create Branch</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('branches.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Branch Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label for="logo">Logo (Image)</label>
                <input type="file" name="logo" class="form-control-file" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Create Branch</button>
            <a href="{{ route('branches.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<script>
    // Reset form fields and file input label
    function resetForm() {
        const form = document.getElementById('branchForm');
        form.reset();
        document.querySelector('.custom-file-label').textContent = 'Choose file';
    }

    // Show selected file name
    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
        document.querySelector('.custom-file-label').textContent = fileName;
    });
</script>

@endsection