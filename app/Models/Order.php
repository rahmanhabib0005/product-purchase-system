<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'supplier_id',
        'order_no',
        'date',
        'total',
        'paid',
        'due',
        'status',
        'notes'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function costItems()
    {
        return $this->hasMany(CostItem::class, 'order_no', 'order_no');
    }
}
