<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriorityOdersModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'eye',
        'sph',
        'cyl',
        'axis',
        'add',
        'pd',
        'ph',
        'a',
        'b',
        'dbl',
        'ed',
        'patient_id',
        'date_id',
        'order_status',
        'prescription_id',
        'shippment_status',
        'coating_1_id',
        'coating_2_id',
        'lens_type_id',
        
    ];
    public function coating()
   {
       return $this->belongsTo('App\Models\CoatingModel','coating_1_id','id');
   }
   public function coating2()
   {
       return $this->belongsTo('App\Models\CoatingModel','coating_2_id','id');
   }
   public function lens_type()
   {
       return $this->belongsTo('App\Models\LensModel','lens_type_id','id');
   }
   public function order_head()
   {
       return $this->belongsTo('App\Models\OrderHeadModel','patient_id','id');
   }
   public function order_head_date()
   {
       return $this->belongsTo('App\Models\OrderHeadModel','date_id','id');
   }
}
