<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameOrderModel extends Model
{
    use HasFactory;
    protected $table = 'frame_order';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'frame_model_id',
        'quantity',
        'unit_cost',
        'status_id',
        'user_id',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        
    ];
    public function model()
    {
        return $this->belongsTo('App\Models\FrameModel','frame_model_id','id');
    }
   
}
