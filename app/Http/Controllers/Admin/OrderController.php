<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Service\CostItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $data['order_id'] = 'PO-000' . Order::get()->last()->value('id');
            $data['date'] = now();
            $data['total'] = $request->qty * $request->unit_price;
            //We can handle status via another table but I make it shortest
            $data['status'] = 'Pending';
            Order::create($data);

            $costItemData = [
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'qty' => $request->qty,
                'unit_price' => $request->unit_price,
                'order_no' => $data['order_id']
            ];
            (new CostItemService())->create($costItemData);
            
            DB::commit();
            return redirect()->route('admin.order.index')->with('success', 'Order created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
