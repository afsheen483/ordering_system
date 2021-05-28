<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.foundation.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


@extends('layouts.master')


@section('title')
    Frame Order
@endsection

@section('headername')
    Frame Order
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="btn-group" role="group" aria-label="Basic example" style="position: absolute; right: 2%;">
                <a href="{{ route('frame_order.index') }}" class="btn btn-primary" style="margin-left: 12cm">Back</a>
                <a href="../frameOrder_edit/{{ $frame_order_data[0]->id }}" class="btn btn-primary" >Edit</a>
            </div>
        </div>

        <h4 class="card-title">Frame Orders</h4>
      </div>
      
      <div class="card-body">
        <div class="table-responsive">
            <div class="container-fluid">
              <table class="table">
                <thead >
                <th>ID</th>
                <th>Vendor</th>
                <th>Category</th>
                <th>Model Name </th>
                <th>Manufacturer</th>
                <th>Brand</th>
                  <th>Quantity</th>
                  <th>Unit Cost</th>
                  <th>Status</th>
              </thead>
              <tbody>
                    <td>{{ $frame_order_data[0]->id }}</td>
                    <td>{{ $frame_order_data[0]->name }}</td>
                    <td>{{ $frame_order_data[0]->category_name }}</td>
                    <td>{{ $frame_order_data[0]->model_name }}</td>
                    <td>{{ $frame_order_data[0]->manufacturer_name }}</td>
                    <td>{{ $frame_order_data[0]->brand_name }}</td>
                    <td>{{ $frame_order_data[0]->quantity }}</td>
                    <td>{{ $frame_order_data[0]->unit_cost }}</td>
                    <td>{{ $frame_order_data[0]->status_type }}</td>
              </tbody>
              </table>
            </div>
        </div>
        
        <hr>
        <label for="" style="font-weight: bold">Frame LOGS</label>
        <div class="table-responsive mb-0">
       
          <div class="container-fluid">
            <table class="table">
              <thead >
              <th>Action</th>
              <th>Username</th>
              <th>Date</th>
              
            </thead>
            <tbody>
                  @foreach ($frame_logs as $frame_log)
                  <td>{{ $frame_log->action }}</td>
                  <td>{{ $frame_log->name }}</td>
                  <td>{{ date(' jS  F Y h:i A', strtotime($frame_log->created_at))}}</td>
                  @endforeach
                  
            </tbody>
            </table>
          </div>
      </div>
      </div>
    </div>
  </div>
  
</div>


@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.foundation.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.foundation.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        ordering:false,
        buttons: ['excel','colvis']
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .small-6.columns:eq(0)' );
        
        $(".delete-btn").click(function(){
          var delete_id = $(this).attr("id");
          console.log(delete_id);
          var url = "{{url('orderFrame')}}/"+delete_id;
          Swal.fire({
							  title: 'Are you sure?',
							  text: "You won't be able to revert this!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, delete it!'
							}).then(function(result){
                if (result.isConfirmed)  
                  {
                      $.ajax({
                      
                        url : url,
                        type : 'DELETE',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}'},
                        success:function(data){
                         if (data == 1) {
                          Swal.fire({
                                title:'Deleted!',
                                text:'Your file and data has been deleted.',
                                type: 'success',
                              })
                              th.parents('tr').hide();
                            }
                          else{
                                Swal.fire({
                                    title: 'Oopps!',
                                    text: "something went wrong!",
                                    type: 'warning',
                          			})
                          		}
                         }
                        
                        });
                }
              });
               
        });
        
} );
    </script>
@endsection