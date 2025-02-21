<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\CostItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
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
        return view('admin.order.index', [
            'orders' => Order::with('supplier')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.order.purchaseOrder', [
            'products' => Product::get(),
            'suppliers' => Supplier::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            $CartData = [];
            $data['order_no'] = 'PO-000' . Order::count() + 1;
            $total = 0;
            foreach ($request->carts as $key => $cart) {
                $CartData['order_no'] = $data['order_no'];
                $CartData['product_id'] = $cart['product_id'];
                $CartData['supplier_id'] = $request->supplier_id;
                $CartData['qty'] = $cart['qty'];
                $CartData['unit_price'] = $cart['unit_price'];
                $total += $cart['qty'] * $cart['unit_price'];
                (new CostItemService())->create($CartData);
            }

            $data['date'] = now();
            $data['total'] = $total;
            //We can handle status via another table but I make it shortest
            $data['status'] = 1;
            Order::create($data);

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

    public function getPurchaseProduct(Order $order)
    {
        $order->load('costItems.product.brand', 'costItems.product.category', 'supplier');
        return view('admin.order.purchaseOrderView', [
            'order' => $order,
        ]);
    }
}
