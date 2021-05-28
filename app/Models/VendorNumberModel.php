<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorNumberModel extends Model
{
    use HasFactory;
    protected $table = 'order_head';
    public $timestamps = false;
    protected $fillable = [
     'id',
     'tracking_numbers',
     'patient_id',
     'price',
     'paid',
     'vendor_id',
     'lens_order_number',
     'frame_order_number',
     'staff_notes',
     'clinic_id',
     'lab_status_id',
     'frame_status',
     'frame_model_id',
     'frame_id',
     'prescription_id',
     'order_status',
     'date',
    ];
    public function patient()
   {
       return $this->belongsTo('App\Models\OrderHeadModel','patient_id','id');
   }
   public function frame()
   {
       return $this->belongsTo('App\Models\FrameModel','frame_id','id');
   }
   public function type()
   {
       return $this->belongsTo('App\Models\PrescriptionModel','prescription_id','id');
   }
   public function user()
   {
    return $this->belongsTo('App\Models\User','vendor_id','id');

   }
}
