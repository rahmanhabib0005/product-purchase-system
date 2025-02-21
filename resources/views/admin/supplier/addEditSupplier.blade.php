@extends('admin.master')
@section('content')
    <div class="pagetitle">
        <h1>Create Supplier</h1>
        <nav>
            <ol class="breadcrumb">
                <ol class="breadcrumb-item">Supplier List</ol>
                <li class="breadcrumb-item active">Create Supplier</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-6">
                <form class="row g-3"
                    action="{{ Route::is('admin.supplier.create') ? route('admin.supplier.store') : route('admin.supplier.update', $supplier) }}"
                    method="POST">
                    @csrf
                    @if (Route::is('admin.supplier.edit'))
                        @method('PUT')
                    @endif
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" value="{{ old('name', isset($supplier) ? $supplier->name : '') }}"
                            class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="mobile_no" class="form-label">Mobile No.</label>
                        <input type="text" class="form-control @error('mobile_no') is-invalid @enderror"
                            value="{{ old('mobile_no', isset($supplier) ? $supplier->mobile_no : '') }}" name="mobile_no"
                            id="mobile_no">
                        @error('mobile_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', isset($supplier) ? $supplier->email : '') }}" name="email"
                            id="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address">{{ old('address', isset($supplier) ? $supplier->address : '') }}
                        </textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror form-select-md" name="status"
                            id="status">
                            <option disabled {{ old('status', $supplier->status ?? '') == '' ? 'selected' : '' }}>Select one
                            </option>
                            <option value="1" {{ old('status', $supplier->status ?? '') == '1' ? 'selected' : '' }}>
                                Active</option>
                            <option value="0" {{ old('status', $supplier->status ?? '') == '0' ? 'selected' : '' }}>
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
