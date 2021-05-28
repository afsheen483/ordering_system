@extends('layouts.master')

@section('title')
    Clinic
@endsection

@section('headername')
   Clinic

@endsection

@section('content')
    <div class="container">
<div class="card col-8">
    <div class="card-header">
    <a href = "{{ route('clinic.index') }}"  class="btn btn-primary" style="float: right;">Back</a>
      <h5 class="title">Clinic</h5>
    </div>
    <div class="card-body">
   @if (request()->id == 0)
   <form method="POST" action="{{ route('clinic.store')}}">
    @csrf
   @else
   <form method="POST"  action="{{ url('clinic_update',['id'=>$clinic->id])}}">
    @csrf
    @method('PUT')
   @endif
     
      <div class="container" style="margin-left: 10%">
        <div class="row">
            
          <div class="col-md-5">
            <div class="form-group">
              <label>Clinic Name</label>
              <input type="text" name="clinic_name" id="" required placeholder="Enter Clinic Name" class="form-control" value="{{ (is_null($clinic->clinic_name)) ? '' : $clinic->clinic_name}}">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="">Number</label>
              <input type="tel" name="number" id="number"  class="form-control" placeholder="Enter Number" value="{{ (is_null($clinic->number)) ? '' : $clinic->number}}">
            </div>
        </div>
         
        </div>
        
        
        <div class="row">
          <div class="col-md-10">
              <div class="form-group">
                <label for="">Address</label>
                <textarea name="address" id="" class="form-control" placeholder="Enter Address">{{  (is_null($clinic->address)) ? '' : $clinic->address}}</textarea>
              </div>
          </div>
          
          
        
        </div>
        
        
       
        
        
        
      
       
          
         
           
            
       
        
            <div class="form-group col-md-3 p1-5">
                <button type="submit" class="btn btn-primary btn-md">Submit</button>    
              </div>
            </div>
        
          
         
        </div>
    </div>
      </form>
    </div>
  </div>

</div>
</div>





    
@endsection

@section('scripts')
   <script>
         $(document).ready(function(){
           $("#quanity,#unit_cost").on('keyup',function(){
            var quantity = $("#quanity").val();
            console.log(quantity);
            var unit_cost = $("#unit_cost").val();
            console.log(unit_cost);
            var total_amount = parseInt(quantity)*parseInt(unit_cost);
            console.log(total_amount);
             $("#total_amount").val(total_amount);
           });
         });
   </script>
@endsection