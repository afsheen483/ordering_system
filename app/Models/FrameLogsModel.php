<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameLogsModel extends Model
{
    use HasFactory;
    protected $table = 'frame_logs';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'action',
        'frame_order_id',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        
    ];
}
