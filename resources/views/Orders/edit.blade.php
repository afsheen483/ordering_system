@extends('layouts.master')

@section('title')
Order Entry
@endsection

@section('headername')
Order Entry
@endsection

@section('content')
    
<div class="card">
  {{-- <label >{{ $errMsg }}</label> --}}
      <div class="card-header">
        <h5 class="title">Order Entry</h5>
        <a href="/orders-list/all" class="btn btn-primary rounded" style="float: right; margin-top:-2.5%" >Back</a>
      
      <div class="card-body">
        <form method="POST" action="/shippment_orders_update/{{ $edit_order_head[0]->id }}">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="form-group col-md-3  pr-1" style="margin-left:2%">
            <label for="">RevolutionEHR Invoice Number</label>
          <input type="text" name="order_number" class="form-control" required placeholder="Enter Invoice Number" value="{{ $edit_order_head[0]->lens_order_number }}">
          </div>
          <div class="form-group col-md-3 px-1" >
            <label for="">Tray Number</label>
          <input type="text" name="tray_number" class="form-control"  placeholder="Enter Tray Number" value="{{ $patient_data[0]->tray_number }}">
          </div>
          <div class="form-group col-md-3 pl-1" >
            <label for="">Clinic</label>
              <select name="clinic_id" id="clinic_id" class="form-control">
                @foreach ($clinic_array as $clinic)
                @if ($edit_order_head[0]->clinic_id == $clinic->id)
                <option value="{{ $clinic->id }}" selected>{{ $clinic->clinic_name }}</option>

                @endif
                    <option value="{{ $clinic->id }}">{{ $clinic->clinic_name }}</option>
                @endforeach
              </select>
          </div>
        </div>
            <div class="container">
              <div class="row">
                <div class="col-md-3 pr-1">
                  <div class="form-group">
                    <input type="hidden" name="r_eye" value=>
                    <label>Date of Invoice</label>
                    <input type="date" class="form-control" value='<?php echo date('Y-m-d');?>' name="date_of_service" id="date">
                  </div>
                </div>
                <div class="col-md-3 px-1">
                  <div class="form-group">
                    <label>Patient Name</label>
                    <input type="text" class="form-control" placeholder="Patient Name" name="patient_name"  value="{{ $patient_data[0]->patient_name }}" required>
                  </div>
                </div>
                <div class="col-md-3 pl-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Prescription Type</label>
                    <select name="prescription_id" class="form-control" required>
                    @foreach ($prescription_array as $prescription)
                    @if($prescription->id == $get_prescription[0]->prescription_id)
                       <option value="{{ $prescription->id }}" selected>{{ $prescription->type }}</option>
                       @endif
                      <option value="{{ $prescription->id }}">{{ $prescription->type }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
             
              <div class="col-md-3 pl-1">
                <div class="form-group">
                  <label>Vendor</label>
                  <select name="vendor_name" class="form-control" required>
                  @foreach ($user_array as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
            </div>
              <hr>
            </div>
            <div class="container" style="margin-left:20.5cm;">
              <div class="form-group col-md-4">
                <label for="">Order Number For Frame</label>
                <input type="text" name="frame_order_number" class="form-control" value="{{ $edit_order_head[0]->frame_order_number }}" >
            </div>
            {{-- <div class="form-group col-lg-4">
              <label>Brands</label>
              <select name="brand_id" id="brand_id" class="form-control">
                <option value="">Select</option>
                @foreach ($frame_brand_array as $brand)
                @if ($brand->id == $edit_order_head[0]->brand_id)
                <option value="{{ $brand->id }}" selected>{{ $brand->brand_name }}{{ " "}}({{ $brand->manufacturer_name}})</option>                          

                @else
                <option value="{{ $brand->id }}">{{ $brand->brand_name }}{{ " "}}({{ $brand->manufacturer_name}})</option>                          

                @endif
                @endforeach
            </select>
           
          </div> --}}
          <div class="form-group col-lg-4">
            <label for="">Frame Model</label>
            <select name="frame_model_id" id="frame_model" class="form-control" onchange="getStockItem()">
              <option value="1">Select Frame Model<option>
                @foreach ($frame_model_array as $frame) 
                @if($frame->id == $edit_order_head[0]->frame_model_id)
                 <option value="{{ $frame->id }}" selected>{{ $frame->model_name }}</option>
                 @endif 
                 <option value="{{ $frame->id }}">{{ $frame->model_name }}</option>

                @endforeach
           </select>
          </div>
            
            
            <div class="col-md-4" id="msg">
              
            </div>
            <br>
            <div class="form-group col-md-4">
              <label for="">Staff Notes</label>
                <textarea name="staff_notes" id="" cols="15" rows="10" class="form-control" value="">{{ $edit_order_head[0]->staff_notes }}</textarea>
            </div>
            </div>
              {{-- table --}}
              <div class="container"  style="margin-left:5%;margin-top:-13.2cm">
                  
              <table>
                <thead>
                <tr>
                <th></th>
                <th></th>
                <th></th>
                  <th colspan="4">Right Eye</th>
                  <th colspan="4">Left Eye</th>
                </tr>
                </thead>
                <tbody>
                    
                        {{-- {{ var_dump($edit_order) }} --}}
                   @php
                      //  return;
                   @endphp
                  <tr>
                   <td>Sph</td>
                    <td colspan="4">
                      <div class="col-12">
                        <input type="text" class="form-control" placeholder="Sphere" name="r_sph" value="{{ $order_data[0]->sph }}">
                      </div>
                    </td>
                    <td colspan="4">
                      <div class="col-12">
                        <input type="text" class="form-control" placeholder="Sphere" name="l_sph" value="{{ $order_data[1]->sph }}">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Cyl</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="CYL" name="r_cyl"  value="{{ $order_data[0]->cyl }}">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                        <input type="text" class="form-control" placeholder="Sphere" name="l_cyl"  value="{{ $order_data[1]->cyl }}">
                      </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>Axis</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="Axis" name="r_axis" value="{{ $order_data[0]->axis }}">
                      </div>
                     </td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="Axis" name="l_axis" value="{{ $order_data[1]->axis }}">
                      </div>
                     </td>
                   </tr>
                   <tr>
                    <td>Add</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="Add" name="r_add" value="{{ $order_data[0]->add }}">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control" placeholder="Add" name="l_add" value="{{ $order_data[1]->add }}">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>Pd</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="PD" name="r_pd" value="{{ $order_data[0]->pd }}">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control" placeholder="PD" name="l_pd" value="{{ $order_data[1]->pd }}">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>Type</td>
                     <td colspan="4">
                       <div class="col-12">
                        <select name="r_lens_type_id"  class="form-control" required>
                          @foreach ($lens_type_array as $lens)
                            @if($order_data[0]->lens_type_id ==  $lens->id)
                          <option value="{{ $lens->id }}" selected>{{ $lens->lenses }}</option>
                          @endif
                           <option value="{{ $lens->id }}">{{ $lens->lenses }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_lens_type_id"  class="form-control" required>
                         @foreach ($lens_type_array as $lens)
                        @if($order_data[1]->lens_type_id ==  $lens->id)
                          <option value="{{ $lens->id }}" selected>{{ $lens->lenses }}</option>
                          @endif
                           <option value="{{ $lens->id }}">{{ $lens->lenses }}</option>
                          
                         @endforeach
                       </select> 
                       </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>Coating1</td>
                     <td colspan="4">
                       <div class="col-12">
                        <select name="r_coating_1_id"  class="form-control">
                       
                          @foreach ($coating_array as $coating)
                         
                          @if($order_data[0]->coating_1_id ==  $coating->id)
                          <option value="{{ $coating->id }}" selected>{{ $coating->coating }}</option>
                          @endif
                          <option value="{{ $coating->id }}">{{ $coating->coating }}</option>

                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_coating_1_id"  class="form-control">
                         <option value="1">Select</option>
                         @foreach ($coating_array as $coating)
                         
                         @if($order_data[1]->coating_1_id ==  $coating->id)
                          <option value="{{ $coating->id }}" selected>{{ $coating->coating }}</option>
                          @endif
                          <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                         @endforeach
                       </select> 
                       </div>
                    </td>
                   </tr>
                   
                   
                   <tr>
                    <td>Coating2</td>
                     <td colspan="4">
                       <div class="col-12">
                        <select name="r_coating_2_id"  class="form-control">
                          @foreach ($coating_array as $coating)
                           
                           @if($order_data[0]->coating_2_id ==  $coating->id)
                          <option value="{{ $coating->id }}" selected >{{ $coating->coating }}</option>
                          @endif
                           <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_coating_2_id"  class="form-control">
                       
                         @foreach ($coating_array as $coating)
                          
                          @if($order_data[1]->coating_2_id ==  $coating->id)
                         <option value="{{ $coating->id }}" selected>{{ $coating->coating}}</option>
                          @endif
                           <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                         @endforeach
                       </select>
                       </div>
                    </td>
                   </tr>
                   <tr>
                    <td>Coating3</td>
                     <td colspan="4">
                       <div class="col-12">
                        <select name="r_coating_3_id"  class="form-control">
                          
                          @foreach ($coating_array as $coating)
                          
                           @if($order_data[0]->coating_3_id ==  $coating->id)
                          <option value="{{ $coating->id }}" selected>{{ $coating->coating }}</option>
                          @endif
                           <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_coating_3_id"  class="form-control">
                       
                         @foreach ($coating_array as $coating)
                        
                          @if($order_data[1]->coating_3_id ==  $coating->id)
                         <option value="{{ $coating->id }}" selected>{{ $coating->coating }}</option>
                          @endif
                           <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                         @endforeach
                       </select>
                       </div>
                    </td>
                   </tr>
                   <tr>
                    <td>Coating4</td>
                     <td colspan="4">
                       <div class="col-12">
                        <select name="r_coating_4_id"  class="form-control">
                        
                          @foreach ($coating_array as $coating)
                           
                           @if($order_data[0]->coating_4_id ==  $coating->id)
                         <option value="{{ $coating->id }}" selected>{{ $coating->coating }}</option>
                          @endif
                           <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_coating_4_id"  class="form-control">
                         @foreach ($coating_array as $coating)
                      
                       @if($order_data[1]->coating_4_id ==  $coating->id)
                         <option value="{{ $coating->id }}" selected>{{ $coating->coating }}</option>
                          @endif
                           <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                         @endforeach
                       </select>
                       </div>
                    </td>
                   </tr>
                   <tr>
                    <td>A</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="A" name="r_a" value="{{ $order_data[0]->a }}">
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control" placeholder="A" name="l_a" value="{{ $order_data[1]->a }}">                 
                       </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>B</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="B" name="r_b" value="{{ $order_data[0]->b }}">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control" placeholder="B" name="l_b" value="{{ $order_data[1]->b }}">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>dbl</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="dbl" name="r_dbl" value="{{ $order_data[0]->dbl }}">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control" placeholder="dbl" name="l_dbl" value="{{ $order_data[1]->dbl }}">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>ED</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="ed" name="r_ed" value="{{ $order_data[0]->ed }}">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control" placeholder="ed" name="l_ed" value="{{ $order_data[1]->ed }}">
                     </div>
                    </td>
                   </tr>
                
                </tbody>
                
                </table>
                <div class="col-md-4" style="margin-left:100px; margin-top:5px;">
                  <div class="form-group" >
                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                  </div>
              </div>
              
              {{-- eyes form --}}
    </form>

    </div>
  </div>

    





    
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

$("#brand_id").select2({
  tags: true
});
$("#frame_model").select2({
  tags: true
});
// $("#brand_id").on('change',function(){
//               var brand_id = $("#brand_id").val();
            
              
//               var url = "{{url('get_models')}}/"+brand_id;
//               $.ajax({
//                 url : url,
//                 type : 'GET',
//                 cache: false,
//                 data: {_token:'{{ csrf_token() }}'},
//                 success: function(classesData) {
//                      console.log(classesData);
//                      var select = $("#frame_model");
//                      select.empty();
                    
//                                 $.each(classesData, function (index, itemData) {
//                                     select.append($('<option/>', {
//                                         value: itemData.id,
//                                         text: itemData.model_name
//                                     }));
//                                 });
                     
//                      console.log("success");  
//          },
              
              
//               });
//            });
function getStockItem(){
    var id =  $("#frame_model").val();
    var url = "{{url('stockItem')}}/"+id;
    $.ajax({
      url : url,
      type : 'GET',
      cache: false,
      data: {_token:'{{ csrf_token() }}'},
      success:function(data){
      console.log(data[1]);
      if (data[1] == 'NEED TO ORDER!') {
        $("#msg").html('<span  class="alert alert-danger"  role="alert">'+data+'</span>')
      }
      else{
      $("#msg").html('<span  class="alert alert-success"  role="alert">'+data+'</span>')
      }
      }
  });
}

</script>

@endsection