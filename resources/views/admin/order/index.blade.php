@extends('admin.master')
@section('title', 'product')
@section('content')
    <div class="pagetitle">
        <h1>Perchase Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Perchase Orders</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <h1>Perchase Orders List</h1>
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.order.create') }}" class="btn btn-primary">Add Perchase Order</a>
            </div>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Order No</th>
                        <th scope="col">Date</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Total</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Due</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <th scope="row">{{ $order->order_no }}</th>
                            <td>{{ date('Y-m-d', strtotime($order->date)) }}</td>
                            <td>{{ $order->supplier->name }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->paid == null ? 0.0 : $order->paid }}</td>
                            <td>{{ $order->paid == null ? $order->total : $order->due }}</td>
                            <td>
                                @if ($order->status == 1)
                                    <span class="bg-success badge badge-success">Pending</span>
                                @else
                                    <span class="badge bg-danger badge-danger">Success</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.getPurchaseProducts', $order) }}" class="btn btn-primary btn-sm">View</a>
                                {{-- <form action="{{ route('admin.order.destroy', $order) }}" method="POST"
                                    style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form> --}}
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
