<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentModel extends Model
{
    use HasFactory;
    protected $table = 'adjustment';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'type',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
    ];
}
