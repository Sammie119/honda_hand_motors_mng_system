<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplyReceived extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'supply_id';

    protected $table = 'supplies_received';
    
    protected $guarded = [];

    protected $casts = [
        'item_id' => 'array',
        'old_stock' => 'array',
        'new_stock' => 'array',
        'amount' => 'array',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function item_name()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
