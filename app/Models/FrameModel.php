<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameModel extends Model
{
    use HasFactory;
    protected $table = 'frame_models';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'model_name',
        'brand_id',
        'category_id',
        'cost',
        'sell_price',
        'is_active',
        'is_stocked_item',
        'url_link',
        'purchasing_link',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        
    ];
    public function brand()
    {
        return $this->belongsTo('App\Models\FrameBrand','brand_id','id');
    }
}
