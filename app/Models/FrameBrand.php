<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameBrand extends Model
{
    use HasFactory;
    protected $table = 'frame_brands';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'brand_name',
        'manufacturer_id',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        
    ];
}
