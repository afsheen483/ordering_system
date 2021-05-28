<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeadModel extends Model
{
    use HasFactory;
    protected $table = 'patients';
    public $timestamps = false;
    protected $fillable = [
     'id',
     'patient_name',
     'date_of_service',
     'tray_number',
    ];
}
