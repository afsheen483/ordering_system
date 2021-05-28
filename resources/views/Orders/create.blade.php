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
        <form method="POST" action="{{ route('orders.store')}}">
        @csrf
       <div class="row">
        <div class="form-group col-md-3  pr-1" >
          <label for="">RevolutionEHR Invoice Number</label>
        <input type="text" name="order_number" class="form-control" required placeholder="Enter Invoice Number">
        </div>
        <div class="form-group col-md-3 px-1" >
          <label for="">Tray Number</label>
        <input type="text" name="tray_number" class="form-control"  placeholder="Enter Tray Number">
        </div>
        <div class="form-group col-md-3 pl-1" >
          <label for="">Clinic</label>
            <select name="clinic_id" id="clinic_id" class="form-control">
              @foreach ($clinic_array as $clinic)
                  <option value="{{ $clinic->id }}">{{ $clinic->clinic_name }}</option>
              @endforeach
            </select>
        </div>
       </div>
            
              <div class="row">
                <div class="col-md-3 pr-1">
                  <div class="form-group">
                    <label>Date of Invoice</label>
                    <input type="date" class="form-control" value='<?php echo date('Y-m-d');?>' name="date_of_service" id="date">
                  </div>
                </div>
                <div class="col-md-3 px-1">
                  <div class="form-group">
                    <label>Patient Name</label>
                    <input type="text" class="form-control" placeholder="Patient Name" name="patient_name" required>
                  </div>
                </div>
                <div class="col-md-3 pl-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Prescription Type</label>
                    <select name="prescription_id" class="form-control" required>
                      <option value="">Select</option>
                    @foreach ($prescription_array as $prescription)
                      <option value="{{ $prescription->id }}">{{ $prescription->type }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3 pl-1">
                  <div class="form-group">
                    <label>Vendor</label>
                    <select name="vendor_name" class="form-control" required>
                      <option value="">Select</option>
                    @foreach ($user_array as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class="container" style="margin-left:20cm;">
              <div class="form-group col-lg-4">
                <label for="">Order Number For Frame</label>
                <input type="text" name="frame_order_number" class="form-control">
            </div>
            
              {{-- <div class="form-group col-lg-4">
                <label>Brands</label>
                <select name="brand_id" id="brand_id" class="form-control">
                  <option value="">Select</option>
                  @foreach ($frame_brand_array as $brand)
                  
                  <option value="{{ $brand->id }}">{{ $brand->brand_name }}{{ " "}}({{ $brand->manufacturer_name}})</option>                          
                  @endforeach
              </select>
             
            </div> --}}
            <div class="form-group col-lg-4">
              <label for="">Frame Model</label>
              <select name="frame_model_id" id="frame_model" class="form-control" onchange="getStockItem()" required>
                <option value="1">Select Frame Model<option>
                  @foreach ($frame_model_array as $model)
                  
                  <option value="{{ $model->id }}">{{ $model->model_name }}</option>

                  @endforeach
                    
             </select>
            </div>
            <div class=" col-lg-6" id="msg">
            </div>
            <br>
            <div class="form-group col-lg-4">
              <label for="">Staff Notes</label>
                <textarea name="staff_notes" id="" cols="10" rows="10" class="form-control"></textarea>
            </div>
            </div>
        
              {{-- table --}}
<div class="container"  style="margin-left:5%;margin-top:-13.1cm">
               
              <table class="table-responsive">
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
                  <tr>
                   <td>Sph</td>
                    <td colspan="4">
                      <div class="col-12">
                        <input type="text" class="form-control" placeholder="Sphere" name="r_sph" id="r_sph">
                      </div>
                    </td>
                    <td colspan="4">
                      <div class="col-12">
                        <input type="text" class="form-control"  name="l_sph" id="l_sph">
                      </div>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Cyl</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="CYL" name="r_cyl" id="r_cyl">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                        <input type="text" class="form-control"  name="l_cyl" id="l_cyl">
                      </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>Axis</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="Axis" name="r_axis" id="r_axis">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control"  name="l_axis" id="l_axis">
                     </div>
                    </td>
                   </tr>
                   
                   
                   <tr>
                    <td>Add</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="Add" name="r_add" id="r_add">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control" name="l_add" id="l_add">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>Pd</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="PD" name="r_pd" id="r_pd">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control" name="l_pd" id="l_pd">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>Ph</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="PH" name="r_ph" id="r_ph">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control"  name="l_ph" id="l_ph">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>Type</td>
                     <td colspan="4">
                       <div class="col-12">
                        <select name="r_lens_type_id"  class="form-control" required id="r_lens_type_id">
                          <option value="">Select</option>
                          @foreach ($lens_type_array as $lens)
                          <option value="{{ $lens->id }}">{{ $lens->lenses }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_lens_type_id"  class="form-control" required id="l_lens_type_id">
                        <option value="">Select</option>
                         @foreach ($lens_type_array as $lens)
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
                        <select name="r_coating_1_id"  class="form-control" id="r_coating_1_id">
                         
                          @foreach ($coating_array as $coating)
                          <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_coating_1_id"  class="form-control" id="l_coating_1_id">
                       
                         @foreach ($coating_array as $coating)
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
                        <select name="r_coating_2_id"  class="form-control" id="r_coating_2_id">
                         
                          @foreach ($coating_array as $coating)
                          <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_coating_2_id"  class="form-control" id="l_coating_2_id">
                        
                         @foreach ($coating_array as $coating)
                         <option value="{{ $coating->id }}">{{ $coating->coating}}</option>
                         @endforeach
                       </select>
                       </div>
                    </td>
                   </tr>
                   <tr>
                    <td>Coating3</td>
                     <td colspan="4">
                       <div class="col-12">
                        <select name="r_coating_3_id"  class="form-control" id="r_coating_3_id">
                         
                          @foreach ($coating_array as $coating)
                          <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_coating_3_id"  class="form-control" id="l_coating_3_id">
                        
                         @foreach ($coating_array as $coating)
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
                        <select name="r_coating_4_id"  class="form-control" id="r_coating_4_id">
                          
                          @foreach ($coating_array as $coating)
                          <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                          @endforeach
                        </select>
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <select name="l_coating_4_id"  class="form-control" id="l_coating_4_id">
                         
                         @foreach ($coating_array as $coating)        
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
                        <input type="text" class="form-control" placeholder="A" name="r_a" id="r_a">
                        </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control"  name="l_a" id="l_a">                 
                       </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>B</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="B" name="r_b" id="r_b">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control"  name="l_b" id="l_b">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>dbl</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="dbl" name="r_dbl" id="r_dbl">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control"  name="l_dbl" id="l_dbl">
                     </div>
                    </td>
                   </tr>
                   
                   <tr>
                    <td>ED</td>
                     <td colspan="4">
                       <div class="col-12">
                        <input type="text" class="form-control" placeholder="ed" name="r_ed" id="r_ed">
                      </div>
                     </td>
                     <td colspan="4">
                      <div class="col-12">
                       <input type="text" class="form-control"  name="l_ed" id="l_ed">
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

$("#frame_model").select2({
  tags: true
});
$("#brand_id").select2({
  tags: true
});
$(document).ready(function (){
  // $("#brand_id").on('change',function(){
  //             var brand_id = $("#brand_id").val();
            
              
  //             var url = "{{url('get_models')}}/"+brand_id;
  //             $.ajax({
  //               url : url,
  //               type : 'GET',
  //               cache: false,
  //               data: {_token:'{{ csrf_token() }}'},
  //               success: function(classesData) {
  //                    console.log(classesData);
  //                    var select = $("#frame_model");
  //                    select.empty();
                    
  //                               $.each(classesData, function (index, itemData) {
  //                                   select.append($('<option/>', {
  //                                       value: itemData.id,
  //                                       text: itemData.model_name
  //                                   }));
  //                               });
                     
  //                    console.log("success");  
  //        },
              
              
  //             });
  //          });
           



      //  $('#r_sph').keyup(function (e) {
      //         var txtVal = $(this).val();
      //         $('#l_sph').val(txtVal);
      //  });
      //  $('#r_cyl').keyup(function (e) {
      //      var txtVal = $(this).val();
      //      $('#l_cyl').val(txtVal);
      //  });
      //  $('#r_axis').keyup(function (e) {
      //      var txtVal = $(this).val();
      //      $('#l_axis').val(txtVal);
      //  });
      //  $('#r_add').keyup(function (e) {
      //      var txtVal = $(this).val();
      //      $('#l_add').val(txtVal);
      //  });
      //  $('#r_pd').keyup(function (e) {
      //      var txtVal = $(this).val();
      //      $('#l_pd').val(txtVal);
      //  });  $('#r_ph').keyup(function (e) {
      //      var txtVal = $(this).val();
      //      $('#l_ph').val(txtVal);
      //  });  $('#r_lens_type_id').change(function (e) {
      //      var txtVal = $(this).val();
      //      $('#l_lens_type_id').val(txtVal);
      //  });  $('#r_coating_1_id').change(function (e) {
      //      var txtVal = $(this).val();
      //      $('#l_coating_1_id').val(txtVal);
      //  });
       
      //  $('#r_coating_2_id').change(function (e) {
      //         var txtVal = $(this).val();
      //         $('#l_coating_2_id').val(txtVal);
      //  });
      //  $('#r_coating_3_id').change(function (e) {
      //         var txtVal = $(this).val();
      //         $('#l_coating_3_id').val(txtVal);
      //  });
      //  $('#r_coating_4_id').change(function (e) {
      //         var txtVal = $(this).val();
      //         $('#l_coating_4_id').val(txtVal);
      //  });
       
       
       $('#r_a').keyup(function (e) {
              var txtVal = $(this).val();
              $('#l_a').val(txtVal);
       });
       $('#r_b').keyup(function (e) {
              var txtVal = $(this).val();
              $('#l_b').val(txtVal);
       });
       $('#r_dbl').keyup(function (e) {
              var txtVal = $(this).val();
              $('#l_dbl').val(txtVal);
       });
       $('#r_ed').keyup(function (e) {
              var txtVal = $(this).val();
              $('#l_ed').val(txtVal);
       });
      
   });
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
      if (data[1] == 'Non Stocked Item!  NEED TO ORDER') {
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