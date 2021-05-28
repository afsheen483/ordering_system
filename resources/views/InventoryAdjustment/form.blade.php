@extends('layouts.master')

@section('title')
    Inventory Adjustment
@endsection

@section('headername')
   Inventory Adjustment

@endsection

@section('content')
   
<div class="card">
    <div class="card-header">
    <a href = "{{ route('inventory_adjustment.index') }}"  class="btn btn-primary" style="float: right;">Back</a>
      <h5 class="title">Inventory Adjustment</h5>
    </div>
    <div class="card-body">
   @if (request()->id == 0)
   <form method="POST" action="{{route('inventory_adjustment.store')}}">
    @csrf
   @else
   <form method="POST" action="{{ url('inventory_adjustment_update',['id'=>$inventory_adjustment[0]->id])}}">
    @csrf
    @method('PUT')
   @endif
     
      <div class="container" style="margin-left: 10%">
        <div class="row">
          <div class="col-md-6">
            {{-- <div class="form-group">
              <label>Brands</label>
              <select name="brand_id" id="brand_id" class="form-control">
                <option value="">Select</option>
                @foreach ($frame_brand_array as $brand)
                @if ($frame_model[0]->brand_id == $brand->id)
                <option value="{{ $brand->id }}" selected>{{ $brand->brand_name }}{{ " "}}({{ $brand->manufacturer_name}})</option>                          
                @else
                <option value="{{ $brand->id }}">{{ $brand->brand_name }}{{ " "}}({{ $brand->manufacturer_name}})</option>                          

                @endif
                @endforeach
            </select>
            </div> --}}
          </div>
          
          
         
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Frame Model</label>
              <select name="frame_model_id" id="frame_model" class="form-control">
               <option value="">Select Frame Model<option>
                    @foreach ($frame_model_array as $model)
                    @if ($inventory_adjustment[0]->frame_model_id == $model->id)
                        <option value="{{ $model->id }}" selected>{{ $model->model_name }}</option>
                    @endif
                    <option value="{{ $model->id }}">{{ $model->model_name }}</option>

                    @endforeach
            </select>
            </div>
       
        </div>
        </div>
        
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
                    <label for="">Adjustment Type</label>
                    <select name="adjustment_type_id" id="" class="form-control">
                        <option value="">Select</option>
                        @foreach ($adjustment_array as $adjustment)
                        @if ($inventory_adjustment[0]->adjustment_type_id == $adjustment->id)
                        <option value="{{ $adjustment->id }}" selected>{{ $adjustment->type }}</option>

                        @endif
                            <option value="{{ $adjustment->id }}">{{ $adjustment->type }}</option>
                        @endforeach
                    </select>
                </div>
          </div>
          
         
          <div class="col-md-3">
              <div class="form-group">
                <label for="">Quantity</label>
                <input type="number" name="qty" id="qty"  class="form-control" placeholder="Enter Quantity" value="{{ (is_null($inventory_adjustment[0]->qty)) ? '' : $inventory_adjustment[0]->qty}}">
              </div>
          </div>
         
        
        </div>
        
       
          
       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Remarks</label>
            <textarea name="remarks" id="remarks"  class="form-control" rows="5" cols="20">{{ (is_null($inventory_adjustment[0]->remarks)) ? '' : $inventory_adjustment[0]->remarks }}</textarea>
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






    
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script>
         $(document).ready(function(){
                      $("#brand_id").select2({
              tags: true
            });
            $("#frame_model").select2({
              tags: true
            });
           
        //    $("#brand_id").on('change',function(){
        //       var brand_id = $("#brand_id").val();
            
              
        //       var url = "{{url('get_models')}}/"+brand_id;
        //       $.ajax({
        //         url : url,
        //         type : 'GET',
        //         cache: false,
        //         data: {_token:'{{ csrf_token() }}'},
        //         success: function(classesData) {
        //              console.log(classesData);
        //              var select = $("#frame_model");
        //              select.empty();
                    
        //                         $.each(classesData, function (index, itemData) {
        //                             select.append($('<option/>', {
        //                                 value: itemData.id,
        //                                 text: itemData.model_name
        //                             }));
        //                         });
                     
        //              console.log("success");  
        //  },
              
              
        //       });
        //    });
         });
   </script>
@endsection