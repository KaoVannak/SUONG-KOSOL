@extends('backend.layout.master')
@section('title', 'Products')
@section('p_menu-open', 'menu-open') 
@section('p_active', 'active')  

@section('datatable_plugin_css')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>All Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>

    <table class="table table-bordered" id="productTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Cost</th>
                <th>Price</th>
                <th>Category</th>
                <th>Branch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>${{ $product->cost }}</td>
                <td>${{ $product->price }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ $product->branch->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash-alt"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('datatable_plugin_js')
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        $('#productTable').DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
        });

        // SweetAlert2 success popup
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        // Delete confirmation
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const form = $(this).closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "This product will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
