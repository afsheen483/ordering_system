<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


@extends('layouts.master')


@section('title')
    Frame
@endsection

@section('headername')
    Frames
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('frame.create') }}" class="btn btn-primary" style="float: right">+ Add Frame</a>

        <h4 class="card-title">Frames</h4>
      </div>
      
      <div class="card-body">
         
        <div class="table-responsive">
          <div class="container-fluid">
            <table id="example" class="display" style="width:100%">
              <thead >
              <th>ID</th>
              <th>Category</th>
              <th>Manufacturer</th>
              <th>Brand</th>
              <th>Model Name </th>
              <th>Cost</th>
              <th>Sell Price</th>
              <th>URL Link</th>
              <th>Purchasing URL</th>
              <th>Actions</th>
            </thead>
            <tbody>
            @foreach ($frame as $frame)
                
              <tr>
                <td>{{ $frame->id }}</td>
                <td>{{ $frame->category_name }}</td>
                <td>{{ $frame->manufacturer_name }}</td>
                <td>{{ $frame->brand_name }}</td>
                <td>{{ $frame->model_name }}</td>
               
               
                <td>{{ $frame->cost }}</td>
                <td>{{ $frame->sell_price }}</td>
                <td><a href="{{ $frame->url_link }}" target="_blank">{{ $frame->url_link }}</a></td>
                <td><a href="{{ $frame->purchasing_link }}" target="_blank">{{ $frame->purchasing_link }}</a></td>
      
                <td><a href="frame_edit/{{ $frame->id }}" style="color: rgb(8, 155, 74)"><i class="fa fa-edit"></i></a> 
              
                 <!--  <form method="post" action="{{route('frame.destroy',$frame->id)}}">
                     @csrf
                       @method('DELETE')
                      <button type="submit" style="color: red;margin-left: 0.7cm;margin-top: -0.5cm"><i class="fa fa-trash"></i></button>
                  </form> -->
              </td>
              </tr>
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
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
     var table = $('#example').DataTable( {
        //dom: 'Bfrtip',
        dom: 'lBfrtip',
        responsive: true,
        pageLength: 10,
        lengthChange: true,
        ordering:false,
        
        buttons: [
            'colvis',
            'excelHtml5',
            'csvHtml5',
            
        ]
    } );
    table.buttons().container()
        .appendTo( '#example_wrapper .small-6.columns:eq(0)' );
        
        $(".delete-btn").click(function(){
          var delete_id = $(this).attr("id");
          console.log(delete_id);
          var url = "{{url('frame_delete')}}/"+delete_id;
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