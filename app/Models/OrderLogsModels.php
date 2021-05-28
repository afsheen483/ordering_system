<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLogsModels extends Model
{
    use HasFactory;
    protected $table = 'order_logs';
    public $timestamps = false;
    protected $fillable = [
     'id',
     'action',
     'order_head_id',
     'created_at',
     'created_by',
    ];
}
