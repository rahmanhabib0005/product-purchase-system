@extends('admin.master')
@section('content')
    <div class="pagetitle">
        <h1>Create Products</h1>
        <nav>
            <ol class="breadcrumb">
                <ol class="breadcrumb-item">Products List</ol>
                <li class="breadcrumb-item active">Create Product</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-6">
                <form class="row g-3"
                    action="{{ Route::is('admin.product.create') ? route('admin.product.store') : route('admin.product.update', $product) }}"
                    method="POST">
                    @csrf
                    @if (Route::is('admin.product.edit'))
                        @method('PUT')
                    @endif
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" value="{{ old('name', isset($product) ? $product->name : '') }}"
                            class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror form-select-md" name="status"
                            id="status">
                            <option disabled {{ old('status', $product->status ?? '') == '' ? 'selected' : '' }}>Select one
                            </option>
                            <option value="1" {{ old('status', $product->status ?? '') == '1' ? 'selected' : '' }}>
                                Active</option>
                            <option value="0" {{ old('status', $product->status ?? '') == '0' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>


                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-start">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
