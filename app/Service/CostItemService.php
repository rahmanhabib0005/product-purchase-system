<?php

namespace App\Service;

use App\Models\CostItem;

class CostItemService
{
    public function create($data)
    {
        $costItem = new CostItem();
        $costItem->product_id = $data['product_id'];
        $costItem->supplier_id = $data['supplier_id'];
        $costItem->qty = $data['qty'];
        $costItem->unit_price = $data['unit_price'];
        $costItem->order_no = $data['order_no'];
        $costItem->save();
        return $costItem;
    }
    public function update($data, $id)
    {
        $costItem = CostItem::find($id);
        $costItem->product_id = $data['product_id'];
        $costItem->supplier_id = $data['supplier_id'];
        $costItem->qty = $data['qty'];
        $costItem->unit_price = $data['unit_price'];
        $costItem->order_no = $data['order_no'];
        $costItem->save();
        return $costItem;
    }
    public function delete($id)
    {
        $costItem = CostItem::find($id);
        $costItem->delete();
        return $costItem;
    }
    public function get($id)
    {
        return CostItem::find($id);
    }
    public function getAll()
    {
        return CostItem::all();
    }
}
