@extends('admin.master')
@section('content')
    <div class="pagetitle">
        <h1>Purchase Create</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Create Purchase</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.order.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product Information</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="product" class="form-label">Product *</label>
                                    <select class="form-select" name="product" id="product">
                                        <option value="">Search Name of Product</option>
                                        @foreach ($products as $product)
                                            <option data-name="{{ $product->name }}" value="{{ $product->id }}">
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="qty" class="form-label">Qty *</label>
                                    <input type="number" class="form-control" name="qty" id="qty">
                                </div>
                                <div class="col-md-2">
                                    <label for="unit_price" class="form-label">Unit Price *</label>
                                    <input type="number" class="form-control" name="unit_price" id="unit_price">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-primary" id="addProduct">+</button>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/L</th>
                                        <th>Item Details</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="productTable">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Total</strong></td>
                                        <td id="totalAmount">0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Other Information</h5>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date *</label>
                                <input type="date" class="form-control" name="date" id="date">
                            </div>
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Supplier *</label>
                                <select class="form-select @error('supplier_id') is-invalid @enderror" name="supplier_id"
                                    id="supplier">
                                    <option value="">Search Name of Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" rows="2">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-start mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        document.getElementById('addProduct').addEventListener('click', function() {
            let productTable = document.getElementById('productTable');
            let rowCount = productTable.rows.length + 1;
            let product = document.querySelector('#product option:checked').getAttribute('data-name');
            let product_id = document.getElementById('product').value;

            let qty = document.getElementById('qty').value;
            let unitPrice = document.getElementById('unit_price').value;
            let totalPrice = qty * unitPrice;

            if (product && qty && unitPrice) {
                let row = `<tr>
                        <td>${rowCount}</td>
                        <td>
                            <input type="hidden" name="carts[${rowCount}][product_id]" value="${product_id}">
                            ${product}
                        </td>
                        <td>
                            <input type="hidden" name="carts[${rowCount}][qty]" value="${qty}">
                            ${qty}
                        </td>
                        <td>
                            <input type="hidden" name="carts[${rowCount}][unit_price]" value="${unitPrice}">
                            ${unitPrice}
                        </td>
                        <td>
                            <input type="hidden" name="carts[${rowCount}][total_price]" value="${totalPrice}">
                            ${totalPrice}
                        </td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-product">🗑</button></td>
                    </tr>`;
                productTable.insertAdjacentHTML('beforeend', row);
                updateTotal();
            }
        });

        document.getElementById('productTable').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-product')) {
                e.target.closest('tr').remove();
                updateTotal();
            }
        });

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('#productTable tr').forEach(row => {
                let price = parseFloat(row.cells[4].textContent);
                if (!isNaN(price)) total += price;
            });
            document.getElementById('totalAmount').textContent = total.toFixed(2);
        }
    </script>
@endpush
