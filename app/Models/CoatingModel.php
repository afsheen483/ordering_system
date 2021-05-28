<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoatingModel extends Model
{
    use HasFactory;
    protected $table = 'coating';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'coating',
    ];
}
