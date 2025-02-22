<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostItem extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'supplier_id',
        'qty',
        'unit_price',
        'order_no',
        'unit'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
