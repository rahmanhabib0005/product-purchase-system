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
}
