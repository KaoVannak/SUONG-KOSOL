@extends('backend.layout.master')

@section('title', 'Branch')
@section('m_menu-open', 'menu-open') 
@section('m_active', 'active')  

@section('datatable_plugin_css')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h1 class="m-0">Branch List</h1>
        <a href="{{ route('branches.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-2"></i> Add New Branch
        </a>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Branch Table</h3>
            </div>
            <div class="card-body">
                <table id="branchTable" class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Branch Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($branches as $index => $branch)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $branch->name }}</td>
                                <td>{{ $branch->email }}</td>
                                <td>{{ $branch->phone }}</td>
                                <td>
                                    @if($branch->logo)
                                        <img src="{{ asset($branch->logo) }}" alt="Logo" style="max-height: 50px;">
                                    @else
                                        <span class="text-muted">No Logo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form id="delete-form-{{ $branch->id }}" action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $branch->id }})">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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

    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This branch will be deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
@endif
@endsection

@section('custom_scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
