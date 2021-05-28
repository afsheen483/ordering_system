<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionModel extends Model
{
    use HasFactory;
    protected $table = 'prescription_type';
    public $timestamps = false;
    protected $fillable = [
    'id',
    'type',
    
    ];
}
