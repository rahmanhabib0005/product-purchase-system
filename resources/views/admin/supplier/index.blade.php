@extends('admin.master')
@section('title', 'Supplier')
@section('content')
    <div class="pagetitle">
        <h1>Suppliers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Suppliers</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <h1>Supplier List</h1>
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary">Add Supplier</a>
            </div>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">S/L</th>
                        <th scope="col">Name</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $key => $supplier)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->mobile_no }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>
                                @if ($supplier->status == 1)
                                    <span class="bg-success badge badge-success">Active</span>
                                @else
                                    <span class="badge bg-danger badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.supplier.edit', $supplier) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.supplier.destroy', $supplier) }}" method="POST"
                                    style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@push('js')
    <script>
        let table = new DataTable('.datatable');
    </script>
@endpush
