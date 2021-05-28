<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingHeadModel extends Model
{
    use HasFactory;
    protected $table = 'tracking_head';
    public $timestamps = false;
    protected $fillable = [
    'id',
    'tracking_number',
    'date',
    'freight_cost',
    ];
}
