@extends('layouts.master')

@section('title')
    
@endsection
@section('headername')
    
@endsection

@section('content')
    
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">

          <h4 class="card-title">Completed Shippments</h4>
        </div>
       
          <div class="container-fluid">
            <a href="orders" class="btn btn-primary btn-lg" name="all" class="all" id="btn-all">
              All
            </a>  
    
            <a href="missing_orders" class="btn btn-danger btn-lg" name="missing" class="missing" id="missing-btn">
              Missing
            </a>   
            <a href="shipped_orders" class="btn btn-success btn-lg" name="shipped" class="shipped" id="complete-btn">
              Complete
            </a>   
            @hasanyrole('vendor|admin')
          <a href="receive_orders" class="btn btn-success btn-lg" value="receive" name="receive" id="hide" >Receive Items</a>
          <a href="unreceive_orders" class="btn btn-success btn-lg" value="receive" name="receive" id="hide" >UnReceive Items</a>
          @endhasanyrole
          <button class="export-btn btn btn-success btn-lg" ><i class="fa fa-file-excel-o"></i> Export to Excel</button>

            <div class="col-3" style="float: right;">
              <input id="myInput" type="text" placeholder="Search.." class="form-control">
            </div>
          </div>
          <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="myTable">
                <thead >
                <th>Date</th>
                <th>Patient Name</th>
                <th>Eye</th>
                <th>SPH</th>
                <th>Cyl</th>
                <th>Axis</th>
                <th>Add</th>
                <th>PD</th>
                <th>LensType</th>
                <th>PH</th>
                <th>A</th>
                <th>B</th>
                <th>DBL</th>
                <th>ED</th>
                <th>Coating1</th>
                <th>Coating2</th>
                @hasanyrole('vendor|admin')
                <th>Shippment</th>
                @endhasanyrole
              </thead>
              <tbody>
              @foreach ($shipped_orders as $order)
             
              @if ($order->shippment_status == "shipped")

                <tr>
                
                @if ($order->eye == 'R') 
                    <td rowspan="2">{{ $order->order_head_date->date_of_service }}</td>
                    <td rowspan="2">{{ $order->order_head->patient_name }}</td> 
                    @endif
                  <td>{{ $order->eye }}</td>
                  <td>{{ $order->sph }}</td>
                  <td>{{ $order->cyl }}</td>
                  <td>{{ $order->axis }}</td>
                  <td>{{ $order->add }}</td>
                  <td>{{ $order->pd }}</td>
                  <td>{{ $order->lens_type->lenses }}</td>
                  <td>{{ $order->ph }}</td>
                  <td>{{ $order->a }}</td>
                  <td>{{ $order->b }}</td>
                  <td>{{ $order->dbl }}</td>
                  <td>{{ $order->ed }}</td>
                  <td>{{ $order->coating->coating_1 }}</td>
                  <td>{{ $order->coating2->coating_2 }}</td>
                  @hasanyrole('vendor|admin')
                  @if ($order->eye == 'R')
                  <td>{{ $order->shippment_status }}</td>
                  @endif
                  @endhasanyrole
                </tr>
                @endif
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
  </div>
    
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://gitcdn.xyz/repo/FuriosoJack/TableHTMLExport/v1.0.0/src/tableHTMLExport.js"></script>

@section('scripts')
<script>
    
  $(document).ready(function(){
$("#myInput").on("keyup", function() {
  var value = $(this).val().toLowerCase();
  $("#myTable tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});

});
$(document).ready(function(){
   $(".export-btn").click(function(){  
     $("#myTable").tableHTMLExport({
      type:'csv',
      filename:'patient_records.csv',
    });
  });
});

 
  </script>


        
@endsection