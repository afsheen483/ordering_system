<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
    use HasFactory;
    protected $table = 'frame_order_status';
    public $timestamps = false;
    protected $fillable = [
    'id',
    'status_title',
    ];
}
