<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequests;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.supplier.index', [
            'suppliers' => Supplier::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.addEditSupplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequests $request)
    {
        Supplier::create($request->validated());
        return redirect()->route('admin.supplier.index')->with('success', 'Supplier created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.addEditSupplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequests $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return redirect()->route('admin.supplier.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('admin.supplier.index')->with('success', 'Supplier deleted successfully');
    }
}
