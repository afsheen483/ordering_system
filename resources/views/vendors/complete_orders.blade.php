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
            <button class="export-btn btn btn-success btn-lg" ><i class="fa fa-file-excel-o"></i> Export to Excel</button>

          </div>
        <div class="card-body">

          <div class="table-responsive">
            <table  class="table" id="myTable">
                <thead>
                <th>ID</th>
                <th>Date</th>
                <th>P_Name</th>
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
                <th>Shippment</th>
               
              </thead>
              <tbody>
              @foreach ($complete_orders as $order)
             
              @if ($order->shippment_status == "Shipped")

                <tr>
                  <td>{{ $order->id }}</td>
                <td>{{ $order->order_head_date->date_of_service }}</td>
                <td>{{ $order->order_head->patient_name }}</td>    
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
                  <td>{{ $order->shippment_status }}</td>
                
        
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



@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://gitcdn.xyz/repo/FuriosoJack/TableHTMLExport/v1.0.0/src/tableHTMLExport.js"></script>
<script>
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