<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
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
        <a href="{{ route('frame_order.create',['id'=> 0]) }}" class="btn btn-primary" style="float: right">+ Order Frame</a>

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
             
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Status</th>
              <th>Actions</th>
            </thead>
            <tbody>
            @foreach ($frame_order as $order)
                
              <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->category_name }}</td>
                <td>{{ $order->manufacturer_name }}</td>
                <td>{{ $order->brand_name }}</td>
                <td>{{ $order->model_name }}</td>
                
               
               
                <td>{{ $order->quantity }}</td>
                <td data-cost="{{ $order->id }}" contenteditable="true" id="cost">{{ $order->unit_cost }}</td>
                <td >
                  <select name='status_id' style='display:none' class='update order_status'  onchange='frame_order_status(this.value,{{ $order->id }})' id="select_lab_{{ $order->id }}">
                      @foreach ($status_array as $status)
                          <option value="{{ $status->id }}">{{ $status->status_title }}</option>
                      @endforeach
                  </select>
                 @if ($order->status_title == 'Received')
                 <span data-id="{{$order->id }}" class="badge badge-success edit_able" id="lbl_status_{{ $order->id }}" onclick="status_toggle({{ $order->id }})" style="cursor: pointer">{{ $order->status_title }}</span>
                 @else
                 <span data-id="{{$order->id }}" class="badge badge-warning edit_able" id="lbl_status_{{ $order->id }}" onclick="status_toggle({{ $order->id }})" style="cursor: pointer">{{ $order->status_title }}</span>

                 @endif
                </td>

      
                <td><a href="frameorder_edit/{{ $order->id }}" style="color: rgb(8, 155, 74)"><i class="fa fa-edit"></i></a> |
              
                  {{-- <a  style="color: red;margin-left: 3%;margin-top:-8.8%" id="{{ $order->id }}" class="delete-btn"><i class="fa fa-trash"></i></a>--}}
                   <a href="frame_order_show/{{ $order->id }}" style="margin-left: 3%;margin-top:-8.8%"  class="show-btn"><i class="fa fa-eye"></i></a>
                  
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
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
          //alert(delete_id);
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


  
//     $(function () {
        
//         $(".edit_able").each(function () {
//             //Reference the Label.
//            var id= $(this).attr("data-id");
//            //console.log(id);
//             var label = $(this);
//      label.after("<select name='status_id' style='display:none' class='update order_status'  onchange='receive_unreceive_order(this.value,"+id+")'></select>");
//      var url = "{{url('get_status')}}";
//               $.ajax({
//                 url : url,
//                 type : 'GET',
//                 cache: false,
//                 data: {_token:'{{ csrf_token() }}'},
//                 success: function(classesData) {
//                      console.log(classesData);
//                      var select = $(".order_status");
//                      select.empty();
//                      select.append($('<option/>', {
//                                         value: '',
//                                         text: 'Select'
//                                     }));
                    
//                                 $.each(classesData, function (index, itemData) {
//                                     select.append($("<option value="+itemData.id+">"+itemData.status_title+"</option>"));
//                                 });
                     
//                      console.log("success");  
//          },
              
              
//               });
     
     
//             // //Reference the TextBox.
//             // var textbox = $(this).next();
     
//             // //Set the name attribute of the TextBox.
//             // // textbox[0].name = this.id.replace("select");
     
//             // //Assign the value of Label to TextBox.
//             // textbox.val(label.html());
     
//             // //When Label is clicked, hide Label and show TextBox.
//             // label.click(function () {
//             //     $(this).hide();
//             //     $(this).next().show();
//             // });
     
//             // //When focus is lost from TextBox, hide TextBox and show Label.
//             // textbox.focusout(function () {
//             //     $(this).hide();
//             //     $(this).prev().html($(this).text());
//             //     // $(".order_status option:selected").html($(this).text());
//             //     $(this).prev().show();
//             // });
//     });

// });

function status_toggle(id){
                $("#select_lab_"+id).show();
                $("#lbl_status_"+id).hide();
                    
            
            }
           
            function frame_order_status(status_id, id) {
              $("#lbl_status_"+id).text($("#select_lab_"+id).find(":selected").text());
                     //$("#lbl_lab"+id).attr("class",'badge-danger');
                     //$("#lbl_lab"+id).removeClass('badge badge-warning').addClass('badge badge-danger');
                    $("#select_lab_"+id).hide();
                    $("#lbl_status_"+id).show();
                    console.log(id)
                    console.log(status_id)
                    var url = "{{ url('orders_update') }}/" + id;
                    
                    $.ajax({
                        url: url,
                        type: "PUT",
                        cache: false,
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        data: {
                            _token: '{{ csrf_token() }}',
                            status_id: status_id
                        },
                        success: function(response) {
                            console.log("success");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("update request failure");
                            //errorFunction(); 
                        }
                    });
            } 
                     
            
            
            //=========================frame status start=========================
           
            
    </script>
@endsection