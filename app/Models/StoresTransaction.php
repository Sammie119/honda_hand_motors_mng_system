<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoresTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'transaction_id';
    
    protected $guarded = [];

    protected $casts = [
        'items' => 'array',
        'quantity' => 'array',
        'unit_price' => 'array',
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
