<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
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
        'coating_1_id',
        'coating_2_id',
        'coating_3_id',
        'coating_4_id',
        'lens_type_id',
        'order_head_id',
        
    ];
    public function coating()
   {
       return $this->belongsTo('App\Models\CoatingModel','coating_1_id','id');
   }
   
   public function coating2()
   {
       return $this->belongsTo('App\Models\CoatingModel','coating_2_id','id');
   }
   public function coating3()
   {
       return $this->belongsTo('App\Models\CoatingModel','coating_3_id','id');
   }
   public function coating4()
   {
       return $this->belongsTo('App\Models\CoatingModel','coating_4_id','id');
   }
   public function lens_type()
   {
       return $this->belongsTo('App\Models\LensModel','lens_type_id','id');
   }
  
   public function getPrice()
   {
       return $this->belongsTo('App\Models\VendorNumberModel','order_head_id','id');
   }
  
  
  
}
