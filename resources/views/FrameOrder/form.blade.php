@extends('layouts.master')

@section('title')
    Frame Order
@endsection

@section('headername')
   Frame Order

@endsection

@section('content')
  
<div class="card">
    <div class="card-header">
    <a href = "{{ route('frame_order.index') }}"  class="btn btn-primary" style="float: right;">Back</a>
      <h5 class="title">Frames</h5>
    </div>
    <div class="card-body">
   @if (request()->id == 0)
   <form method="POST" action="{{ route('frame_order.store')}}">
    @csrf
   @else
   <form method="POST" action="{{ url('frameorder_update',['id'=>$frame_order[0]->id])}}">
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
                @if ($frame_model[0]->brand_id  == $brand->id)
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
                    @if ($frame_order[0]->frame_model_id == $model->id)
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
              <label for="">Quantity</label>
              <input type="number" name="quantity" id="quanity"  class="form-control" placeholder="Enter Quantity" value="{{ (is_null($frame_order[0]->quantity)) ? '' : $frame_order[0]->quantity}}">
            </div>
        </div>
        
        <div class="col-md-3">
          <div class="form-group">
            <label for="">Unit Cost</label>
            <input type="number" name="unit_cost" id="unit_cost" placeholder="Enter Unit Cost" class="form-control" value="{{ (is_null($frame_order[0]->unit_cost)) ? '' : $frame_order[0]->unit_cost }}">
          </div>
      </div>
      
          <div class="col-md-2">
              <div class="form-group">
                
                <span id="total_amount"></span>
                {{-- <input type="number" name="total_amount" id="total_amount" class="form-control"  value="{{ (is_null($frame_order->total_amount)) ? '' : $frame_order->total_amount }}" disabled> --}}
              </div>
          </div>
          
        
        
        </div>
        <div class="row">
          <div class="col-md-3">
              <div class="form-group">
                <label for="">Vendor</label>
                <select name="user_id" id="user_id" class="form-control">
                <option value="">Select</option>
                @foreach ($user_array as $user)
                @if ($frame_order[0]->user_id == $user->id)
                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>

                @endif
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
                  
                </select>
              </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Status</label>
              <select name="status_id" id="status_id" class="form-control">
              @foreach ($status_array as $status)
              @if ($frame_order[0]->status_id == $status->id)
              <option value="{{ $status->id }}" selected>{{ $status->status_title }}</option>

              @endif
                  <option value="{{ $status->id }}" >{{ $status->status_title }}</option>
              @endforeach
                
              </select>
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
         
           $("#quanity,#unit_cost").on('keyup',function(){
            var quantity = $("#quanity").val();
            console.log(quantity);
            var unit_cost = $("#unit_cost").val();
            console.log(unit_cost);
            var total_amount = parseInt(quantity)*parseInt(unit_cost);
            console.log(total_amount);
             $("#total_amount").html("Total Amount: <br><br>"+total_amount);
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
           });
           
        // });
   </script>
@endsection