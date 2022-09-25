<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rents_episodes';

    protected $primaryKey = 'rent_id';

    protected $guarded = [];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'master_id');
    }
}
