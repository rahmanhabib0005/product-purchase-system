@extends('admin.master')
@section('title', 'product')
@section('content')
    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <h1>Products List</h1>
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary my-2">Add Products</a>
            </div>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">S/L</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>
                                @if ($product->status == 1)
                                    <span class="bg-success badge badge-success">Active</span>
                                @else
                                    <span class="badge bg-danger badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.product.destroy', $product) }}" method="POST"
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
        let table = new DataTable('.datatable', {
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    text: 'Export to Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'csv',
                    text: 'Export to CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Export to PDF',
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print Table',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                }
            ]
        });
    </script>
@endpush
