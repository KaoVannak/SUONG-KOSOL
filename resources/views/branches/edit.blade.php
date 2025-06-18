@section('datatable_plugin_css')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('datatable_plugin_js')
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        $('#branchTable').DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
        });
    });
</script>
@endsection

@extends('backend.layout.master')
@section('title', 'Edit Branch')
@section('m_menu-open', 'menu-open') 
@section('m_active', 'active')  
@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Branch</h1>
                <a href="{{ route('branches.index') }}" class="btn btn-outline-primary btn-sm mt-2" style="font-size: 18px;">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Branch</li>
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

        <form action="{{ route('branches.update', $branch->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Branch Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $branch->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $branch->email) }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $branch->phone) }}">
            </div>

            <div class="form-group">
                <label for="logo">Logo (Image)</label>
                <input type="file" name="logo" class="form-control-file" accept="image/*">
                @if($branch->logo)
                    <div class="mt-2">
                        <img src="{{ asset($branch->logo) }}" alt="Logo" style="max-height: 100px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Branch</button>
            <a href="{{ route('branches.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<script>
    // Show selected file name and preview image
    document.getElementById('logo').addEventListener('change', function (e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
        document.querySelector('.custom-file-label').textContent = fileName;

        if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (event) {
                document.getElementById('logo_preview').src = event.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Reset form and image preview
    function resetForm() {
        const form = document.getElementById('editBranchForm');
        form.reset();
        document.querySelector('.custom-file-label').textContent = 'Choose file';
        document.getElementById('logo_preview').src = "{{ asset($branch->logo) }}";
    }
</script>
@endsection