@extends('admin.master')
@section('title', 'Purchase Order Details')
@section('content')
    <div class="pagetitle">
        <h1>Purchase Orders Details</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between pt-3">
                            <div>
                                <strong>Supplier:</strong> {{ $order->supplier->name }}
                            </div>
                            <div>
                                <strong>ORDER NO.</strong> {{ $order->order_no }}
                            </div>
                            <div>
                                <strong>DATE:</strong> {{ date('Y-m-d', strtotime($order->date)) }}
                            </div>
                        </div>

                        <hr>

                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-light">
                                    <th>S/L</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Code</th>
                                    <th>Unit</th>
                                    <th>Pur. Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_qty = 0; @endphp
                                @foreach ($order->CostItems as $cost)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $cost->product->brand->name }}</td>
                                        <td>{{ $cost->product->category->name }}</td>
                                        <td>{{ $cost->product->name }}</td>
                                        <td>5100000001</td>
                                        <td>Pcs</td>
                                        <td>{{ $cost->unit_price }}</td>
                                        <td>{{ $cost->qty }}</td>
                                        <td>{{ floatval($cost->qty) * floatval($cost->unit_price) }}</td>
                                        @php $total_qty += $cost->qty; @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="7" class="text-end"><strong>Total</strong></td>
                                    <td>{{ $total_qty }}</td>
                                    <td>{{ $order->total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="text-end"><strong>Payment</strong></td>
                                    <td>{{ $order->paid == null ? 0.0 : $order->paid }}</td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="text-end"><strong>Due</strong></td>
                                    <td>{{ $order->paid == null ? $order->total : $order->due }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                Warehouse
                            </div>
                            <div>
                                Created By
                            </div>
                            <div>
                                Checked By
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
