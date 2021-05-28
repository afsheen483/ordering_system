<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAdjustmentModel extends Model
{
    use HasFactory;
    protected $table = 'inventory_adjustment';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'adjustment_type_id',
        'frame_model_id',
        'qty',
        'remarks',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
    ];
}
