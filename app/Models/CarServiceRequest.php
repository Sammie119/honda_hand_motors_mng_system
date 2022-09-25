<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarServiceRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'service_id';
    
    protected $guarded = [];

    protected $casts = [
        'item_in_car' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
