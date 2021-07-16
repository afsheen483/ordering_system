@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title')
    Orders Entry
@endsection
@section('headername')
    Orders Entry
@endsection
@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Check Shippment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('vendor_number.store')}}">
                @csrf
                <div class="form-group col-lg-12">
                    <label for="">Tracking Number</label>
                    <input type="text" name="tracking_numbers" placeholder="Tracking Number" class="form-control" id="tracking_numbers"  value="" required/>
                      <!-- Data passed is displayed  
                          in this part of the  
                          modal body -->
                      <input type="text" name="patient_id"  id="patient_ids" hidden=""> 
                      <input type="text" name="ord_price" id="ord_price" hidden="">
                      <h5 id="total_price">Total Price:</h5> 
                      <input type="text" name="freight_cost" placeholder="Freight Cost..." id="freight_cost" class="form-control" required/>
                      <h5 id="total_Amount">Total Amount:</h5>
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="ship">Ship Batch</button>
                  <button type="submit" class="btn btn-warning" name="unship">UnShip Batch</button>
                </div>
              </form>
              </div>
            </div>
          </div>
          {{-- end model --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                  <div class="col-md-6">
                    <h4 class="card-title">Orders List</h4>
                  </div>
                  
                  <div class="col-md-6">
                    @hasanyrole('staff|admin')
                      <a href="{{ route('orders.create') }}" class="btn btn-primary " style="float: right;" >+ Add Order Entry</a>
                     @endhasanyrole
                  </div>
                </div>
                <div class="rows" >
                @hasanyrole('admin|vendor|staff|receiver')
                  <form id="date_form" class="form-inline" method="GET" action="{{ url('order-filter') }}" style="display: none">
                    @csrf
                          <label for="" style="margin-left: 0.5cm"> Start Date:&nbsp;</label><br>  
                         <input type="date" name="start_date" id="start_date" required class="col-md-2" style="margin-left: 0.1cm">
                         <label for="" style="margin-left: 0.1cm">&nbsp;End Date:&nbsp;</label>
                         <input type="date" name="end_date" id="end_date" required style="margin-left: cm" class="col-md-2">&nbsp;                            
                     <button type="submit" class="btn btn-primary" id="range-date" style="margin-top:-1.6ch">Search</button>
                    </form>
                    @endhasanyrole
                </div>
                <div class="container row">
                        <div class="col">
                            <div class="dropdown" >
                                <button type="button" class="btn btn-lg btn-secondary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Summary
                                </button>
                               
                                <div class="dropdown-menu">
                                    <a href="/orders-list/all" class="dropdown-item" name="all" class="all" id="btn-all">All</a>
                                  
                                    <a href="/orders-list/shipped" class="dropdown-item" name="shipped" class="shipped"
                                        id="complete-btn">Shipped Items</a>
                                        <a href="/orders-list/notshipped" class="dropdown-item" name="missing" class="missing"
                                        id="missing-btn">Not Shipped</a>
                                    <a href="/orders-list/received" class="dropdown-item" value="received" name="received"
                                        id="hide">Receive Items</a>
                                    <a href="/orders-list/missing" class="dropdown-item" value="unreceived" name="unreceived"
                                        id="hide">Missing Items</a>
                                      <a href="/orders-list/unpaid" class="dropdown-item" value="unreceived" name="unreceived"
                                        id="hide">Unpaid Items</a>   
                                        
                                        <a href="/orders-list/priority" class="dropdown-item">Next Priority Items</a>
                                </div>
                            </div>
                            </div>
                            <div class="col" style="margin-left: -23.2cm">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-lg btn-secondary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Detail
                                    </button>
                                   
                                    <div class="dropdown-menu" >
                                        <a href="/detail/all" class="dropdown-item" name="all" class="all" id="btn-all">All</a>
                                        <a href="/detail/shipped" class="dropdown-item" name="shipped" class="shipped"
                                            id="complete-btn">Shipped Items</a>
                                            <a href="/detail/notshipped" class="dropdown-item" name="missing" class="missing"
                                            id="missing-btn">Not Shipped</a>
                                        <a href="/detail/received" class="dropdown-item" value="received" name="received"
                                            id="hide">Receive Items</a>
                                        <a href="/detail/missing" class="dropdown-item" value="unreceived" name="unreceived"
                                            id="hide">Missing Items</a>
                                          <a href="/detail/unpaid" class="dropdown-item" value="unreceived" name="unreceived"
                                            id="hide">Unpaid Items</a>   
                                            
                                            <a href="/detail/priority" class="dropdown-item">Next Priority Items</a>
                                    </div>
                                  
                                  
                                  {{-- <button class="export-btn btn btn-success btn-lg"><i class="fa fa-file-excel-o"></i> &nbsp;Export</button> --}}
                                  {{-- <button id="button-excel" class=" btn btn-success btn-lg"><i class="fa fa-file-excel-o"></i> &nbsp;Export</button> --}}
                                  
                                  <button style="display: none" id="one" type="submit" class="btn btn-lg btn-primary"  data-toggle="modal" data-target="#exampleModal">Batch Together</button>
          
                                  <button type="submit" id="date_filter" class="btn btn-lg btn-info">Date Filter</button>
                                  <form action="{{ url('print_lable') }}" method="get" target="_blank" style="display: none" id="print" >
                                    @csrf
                                      
                                            <input type="text" name="print_id" id="print_lable" value="" hidden>
                                       
                                         <button class="btn btn-success btn-lg"  type="submit" style="margin-left: 8.8cm;margin-top:-1cm">Print Lable</button>
            
                                    </form>
                                    <form action="{{ url('print_orders') }}" method="get" target="_blank" style="display: none" id="print_order" >
                                        @csrf
                                            <input type="text" name="print_order_id" id="print_order_h6" value="" hidden>
                                            
                                              <button class="btn btn-success btn-lg"  type="submit" style = "margin-left: 11.7cm;margin-top:-1.02cm">Print Orders</button>
                
                                        </form>
                            </div>
                        </div>
                      
                </div>
                <div class="container-fluid" style="margin-bottom:-1.1%;">  
                        <div class="card-body">
                          <div class="table-responsive" id="dvData">
                            <form>
                                <table class="display nowrap" id="example">
                                    <thead>
                                        <tr >
                                          
                                           
                                          
                                            
                                           
                                            <th  data-priority="3">Date</th>
                                            <th  data-priority="-8">Patient</th>
                                            <th data-priority="-7">Tray Number</th>
                                            <th>Type</th>
                                           
                                           
                                        </tr>
                                    </thead>
                                   
                                </table>
                                
                            </div>
                          </form>
                        </div>
            </div>
        </div>
    </div>
</div>
{{-- @else
<div style="margin-left: 100%" class="container">
  <table>
      <tbody>
          <tr>
              <td> NO Records Found</td>
          </tr>         
                  
      </tbody>   
  
  </table>
  <div>            

    @endif --}}
    

@endsection




@section('scripts')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
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
          processing: true,
                serverSide: true,
                ajax: "{{ route('server.side.index') }}",
                columns: [
                    { "data": "date" },
                    { "data": "patient_name" },
                    { "data": "tray_number" },
                    { "data": "type" },
                ],
        
        buttons: [
            'colvis',
            'excelHtml5',
            'csvHtml5',
            
        ],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        search: {
     regex: false,
     smart: false
  }
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .small-6.columns:eq(0)' );
        
       
    //    $(".edit_able").each(function(){
    //     // var order_status = $(this).text();
    //     var order_id = $(this).attr('data-id');
    //      var order_status = $(this).text();
    //     // var frame_status = $(this).text();
    //         //alert(index + val)
    //         //alert( order_status);

    
    //   // console.log(order_status);
    //   $(".edit_frame").each(function(){
    // var frame_status = $(this).text();

    //    // alert( frame_status);
      
    //    if (order_status == 'Received' || frame_status == 'Received') {
    //     var url = "{{ url('update_lab_status') }}/" + order_id;
    //        $.ajax({
    //         url: url,
    //         type: "PUT",
    //         cache: false,
    //         headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //         },
    //         success: function(response) {
    //             console.log("success");
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             console.log("update request failure");
    //             //errorFunction(); 
    //         }

    //        });
    //    }
    //    if(order_status == 'Received' && frame_status == 'Received'){
    //     var url = "{{ url('lab_status_change') }}/" + order_id;
    //        $.ajax({
    //         url: url,
    //         type: "PUT",
    //         cache: false,
    //         headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //         },
    //         success: function(response) {
    //             console.log("success");
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             console.log("update request failure");
    //             //errorFunction(); 
    //         }

    //        });
    //    }
    //    })
    // })
      

   
       

} );

    // for delete purpose
    $(".delete").click(function(){
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('orders_delete')}}/"+delete_id;
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

    $(".order_status, .frame_status").change(function(){
        var os_id = $(this).attr("data-labStatus");
        var fs_id = $(this).attr("data-frameStatus");
        //alert(fs_id);
        var url = "{{ url('lab_status_change') }}";
        var os = $(".order_status").text();
       // alert(os);
       var order_status = $("#select_lens_status_"+os_id).find(":selected").text();
       //alert(order_status);
       //var order_status = 'Received';
       var frame_status = $("#select_frame_status_"+fs_id).find(":selected").text();
      // alert(frame_status);
       var frame_status = 'Received';
          $.ajax({
         url: url,
            type: "put",
            cache: false,
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
           data: {
               _token: '{{ csrf_token() }}',
                order_status : order_status,
                frame_status :frame_status,
           },
            success: function(response) {
                console.log("success");
        },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("update request failure");
                //errorFunction(); 
            }
       });
    });
function calculateColumn(index) {
            var total = 0;
            $('table tr').each(function() {
                var value = parseInt($('td', this).eq(index).text());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('table tfoot td').eq(index).text('Total: ' + total);
        }
//=====================================================================================================================================================================
            // for search
            // $("#myInput").on("keyup", function() {
            //     var value = $(this).val().toLowerCase();
            //     $("#myTable tr").filter(function() {
            //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            //     });
            // });
            
// function myFunction() {
//         var input, filter, table, tr, td, i;
//         input = document.getElementById("myInput");
//         filter = input.value.toUpperCase();
//         table = document.getElementById("myTable");
//         tr = table.getElementsByTagName("tr");
//         var show = true;
//         var spannedRows = 0;
//         for (i = 0; i < tr.length; i++) {
//             td = tr[i].getElementsByTagName("td")[i];
//             if(spannedRows > 0) {
//                 if(show)
//                     tr[i].style.display = "";
//                 else
//                     tr[i].style.display = "none";
//                 spannedRows--;
//             } else if (td) {
//                 if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
//                     tr[i].style.display = "";
//                 } else {
//                     tr[i].style.display = "none";
//                 }
//                 let rs = td.getAttribute("rowspan");
//                 console.log("rs = " + rs);
//                 if(rs && rs > 1) {
//                     show = td.innerHTML.toUpperCase().indexOf(filter) > -1;
//                     spannedRows = rs - 1;
//                 }
//             }
//         }
//     }
            
//                 //export 
//                 let button = document.querySelector("#button-excel");                
//                 button.addEventListener("click", e => {
//                 let table = document.querySelector("#mytable");
//                   TableToExcel.convert(table);
//                 });
                
                
//=================================================status change======================================================================================
                
   function lens_status_toggle(id){
    $("#select_lens_status_"+id).show();
    $("#lable_lens_status_"+id).hide();
   }
            function receive_unreceive_order(order_status, id) {
                $("#lable_lens_status_"+id).text($("#select_lens_status_"+id).find(":selected").text());
         
                $("#select_lens_status_"+id).hide();
                $("#lable_lens_status_"+id).show();
       
                    console.log(id)
                    console.log(order_status)
                    var url = "{{ url('orders_update') }}/" + id+"/"+order_status;
                    
                    $.ajax({
                        url: url,
                        type: "PUT",
                        cache: false,
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        data: {
                            _token: '{{ csrf_token() }}',
                            order_status: order_status
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
            
            function frame_status_toggle(id){
                $("#select_frame_status_"+id).show();
                $("#lable_frame_status_"+id).hide();
            }


            function change_frame_status(frame_status, id) {
                $("#lable_frame_status_"+id).text($("#select_frame_status_"+id).find(":selected").text());
         
                $("#select_frame_status_"+id).hide();
                $("#lable_frame_status_"+id).show();
                    console.log(id)
                    var frames_status = $(".frame_status").val();
                   // console.log(frame_status)
                    var url = "{{ url('frame_update') }}/" + id+"/"+frame_status;
                    
                    $.ajax({
                        url: url,
                        type: "PUT",
                        cache: false,
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        data: {
                            _token: '{{ csrf_token() }}',
                            frame_status: frame_status
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
            
            
            
            
//=================================================end frame status=========================================================
            
            
            
function price_toggle(id){
    $("#enter_price_entry_"+id).show();
         $("#price_entry_"+id).hide();
}

function insert_Price(price,id) {
     $("#price_entry_"+id).val($("#enter_price_entry_"+id).find(':input').val());
         
         $("#enter_price_entry_"+id).prev().hide();
         $("#price_entry_"+id).next().show();
           //var id = $(this).attr("data-element");
           console.log(id);
           console.log(price);
           var url = "{{ url('order_price') }}/"+id;
           $.ajax({
               url: url,
               type: "PUT",
               headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               data: {
                   _token: '{{ csrf_token() }}',
                   price:price
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
       
    //    paid entry ====================================
      function paid_toggle(id){
        $("#enter_paid-entry_"+id).show();
         $("#paid_entry_"+id).hide();
        
      }
          
        function insert_paid(paid,id) {
           
            $("#paid_entry_"+id).val($("#enter_paid-entry_"+id).find(':input').val());
         
        $("#enter_paid-entry_"+id).prev().hide();
        $("#paid_entry_"+id).next().show();
           console.log(id);
           console.log(paid);
           var url = "{{ url('vendor_number_update') }}/"+id;
           $.ajax({
               url: url,
               type: "PUT",
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               data: {
                   _token: '{{ csrf_token() }}',
                   paid: paid
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
            $(document).on('focusout', '#tracking_numbers', function() {
            
            var tracking_numbers = $("#tracking_numbers").val();
           
            console.log(tracking_numbers);
            var url = "{{ url('vendor_number') }}";
            $.ajax({
                url: url,
                type: "GET",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    tracking_numbers: tracking_numbers
                },
                success: function(data) {
                    console.log(data);
                    $('#totalPrice').html(data);
                   
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("update request failure");
                    //errorFunction(); 
                }
            });

        });
        
        $('[type=checkbox]').click(function ()
            {
                var checkedChbx = $('[type=checkbox]:checked');
                var String
                if (checkedChbx.length > 0)
                {
                    $('#one').show();
                    $('#print').show();
                    $('#print_order').show();
                   // console.log(checkedChbx);
                }
             else {
                $("#one").hide();
                $("#print").hide();
                $("#print_order").hide();
            }
            if (checkedChbx.length >= $('[type=checkbox]').length)
                {
                    $('#all').show();
                    
                    //console.log(length);
                }
                else
                {
                    $('#all').hide();
                }
        
         
    })
         $("#selectAll").change(function() {
       
        if($(this).is(":checked")) {
           $(".check_box").prop('checked', true);
        }
        else {
            $(".check_box").prop('checked', false);
        }
    });


        $('#selectAll').click(function(e){
          
           var patient_ids = "";
        
             // patient_ids = patient_ids + 
             if($(this).prop("checked") == true){
                 var all_patient_ids = $("#all_patient_ids").val();
                 var all_order_price = $("#all_order_price").val();
                 var cost = $("#all_f_cost").val();
                  $("#patient_ids").val(all_patient_ids);
                  $("#print_lable").val(all_patient_ids);
                  $("#print_order_h6").val(all_patient_ids);
                  $("#ord_price").val(all_order_price);
                   var tracking = $("#all_tracking_numbers").val();
                    $("#tracking_numbers").val(tracking);
                    $("#total_price").html('Total Price:'+all_order_price);
                    
                     var freight_val = $(this).attr("data-freight");

                     $("#freight_cost").val(cost);
                    var total_amount = parseFloat(freight_val) + parseFloat(all_order_price);
                    $("#total_Amount").html('Total Amount:'+total_amount);

            }else{

                  $("#patient_ids").val('');
                  $("#ord_price").val('0');
                   $("#print_lable").val('');
                   $("#print_order_h6").val('');
                     $("#tracking_numbers").val('');
                      $("#freight_cost").val('');
                    
                    
                
            }

              // console.log(this.data());
          

          
        
           });


        // total freight
            $("#freight_cost").keyup(function(){
              console.log('in freight_cost');
              var freight_value = parseFloat($(this).val());
              var total_price = parseFloat($("#ord_price").val());
               var total_amount = freight_value + total_price;
               $("#total_Amount").html('Total Amount:'+total_amount);
            });


        $('.check_box').click(function(){
             // var val = [];
             // $('[type="checkbox"]:checked')
        //       .each(function(i){
        //         val[i] = $(this).val();
        // });

          if($(this).prop("checked") == true){
                var id = $(this).val();
               // console.log(id);.
                var ids = $("#patient_ids").val();
                ids = ids + id + ",";
                console.log(ids);
                $("#patient_ids").val(ids);
                $("#print_lable").val(ids);
                $("#print_order_h6").val(ids);

                // this is for price total
                var price_val = $(this).attr("data-ordprice"); 
                  var tracking = $("#all_tracking_numbers").val();
                    $("#tracking_numbers").val(tracking);
                var ord_price = $("#ord_price").val();
                if (parseFloat(ord_price) > 0) {
                  price_val = parseFloat(price_val) + parseFloat(ord_price);
                }
                $("#ord_price").val(price_val);
                console.log(price_val);
                $("#total_price").html('Total Price:'+price_val);

                var freight_val = $(this).attr("data-freight");
                $("#freight_cost").val(freight_val);
                var total_amount = parseFloat(freight_val) + parseFloat(price_val);
                $("#total_Amount").html('Total Amount:'+total_amount);
              

                // this is for freight cost
                //  var freight_val = $(this).attr("data-freight"); 
                // var freight_cost = $("#freight_cost").val();
                // if (parseFloat(freight_cost) > 0) {
                //   freight_val = parseFloat(freight_val) + parseFloat(freight_cost);
                // }
                //$("#freight_cost").val(freight_val);

          }else{
             var id = $(this).val();
           // console.log(id);.
            var ids = $("#patient_ids").val();
            ids = ids.replace(id + "," , "");
            console.log(ids);
            $("#patient_ids").val(ids);

             $("#print_lable").val(ids);
             $("#print_order_h6").val(ids);


             // this is for price total
                var price_val = $(this).attr("data-ordprice"); 
                var ord_price = $("#ord_price").val();
               //var tracking = $(this).attr("data-tray");
                 var tracking = $("#all_tracking_numbers").val();
                    $("#tracking_numbers").val();

                if (parseFloat(ord_price) > 0) {
                  price_val = parseFloat(ord_price) - parseFloat(price_val);
                }
                $("#ord_price").val(price_val);


                $("#total_price").html('Total Price:'+price_val);

                var freight_val = $(this).attr("data-freight");
                $("#freight_cost").val(freight_val);
                var total_amount = parseFloat(freight_val) + parseFloat(price_val);
                $("#total_Amount").html('Total Amount:'+total_amount);

                // this is for freight cost
                //  var freight_val = $(this).attr("data-freight"); 
                // var freight_cost = $("#freight_cost").val();
                // if (parseFloat(freight_cost) > 0) {
                //   freight_val =  parseFloat(freight_cost) - parseFloat(freight_val);
                // }
                // $("#freight_cost").val(freight_val);
          }



        //$("#modal_body").html("<input name='patient_id[]' value='"+val+"'  type='text' id='patient_id' style='display:none'/>");
            var patient_id = $('#patient_ids').val();
            
         //  console.log(val);
           
            // var url = "{{ url('total-price') }}/"+patient_id;
            // $.ajax({
            //     url: url,
            //     type: "GET",
            //     cache: false,
            //     data: {
            //         _token: '{{ csrf_token() }}',
            //     },
            //     success: function(data) {
            //         console.log(data);
            //         $("#total_price").html('Total Price:'+data);
            //         var price = data;
            //         $("#freight_cost").keyup(function(){
            //             var freight_cost= $('#freight_cost').val();
            //             var total_amount = parseInt(freight_cost) + parseInt(price);
            //             $("#total_Amount").html('Total Amount:'+total_amount);
                        
            //         });
            //     },
            //     error: function(jqXHR, textStatus, errorThrown) {
            //         console.log("request failure");
            //         //errorFunction(); 
            //     }
            // });
           
            //this is for print lables for patients
           //$("#print_lable").html("<input name='print_id[]' value='"+val+"'  type='text' id='print_id' style='display:none'/>");
            //$("#print_order_h6").html("<input name='print_order_id[]' value='"+val+"'  type='text' id='print_order_id' style='display:none'/>");
            var print_id = $('#print_id').val();
            // var url = "{{ url('print_lable') }}/"+print_id;
            // $.ajax({
            //     url: url,
            //     type: "GET",
            //     cache: false,
            //     data: {
            //         _token: '{{ csrf_token() }}',
            //     },
            //     success: function(data) {
            //         console.log(data);
            //         // $("#total_price").html('Total Price:'+data);
            //         // var price = data;
            //         // $("#freight_cost").keyup(function(){
            //         //     var freight_cost= $('#freight_cost').val();
            //         //     var total_amount = parseInt(freight_cost) + parseInt(price);
            //         //     $("#total_Amount").html('Total Amount:'+total_amount);
                        
            //         // });
            //     },
            //     error: function(jqXHR, textStatus, errorThrown) {
            //         console.log("request failure");
            //         //errorFunction(); 
            //     }
            // });
           
        
        });  
       
        $("#date_filter").click(function(){
        $("#date_form").toggle();
     });
     
     
     
    //  lab status
    
    
//     $(".lab_status_editable").mouseenter(function(){
//         //var a = $('.lab_status_editable').parent().prev().text();
//         var a = $('.lab_status_editable').parent('tr').prev().find('td').attr("data-lab");

//     alert(a);
// });

   // alert(a);

        
    //     $(".lab_status_editable").each(function () {
    //         //Reference the Label.
    //        var id= $(this).attr("data-lab");
    //        //console.log(id);
    //         var label = $(this);
    //  //label.after("<select name='lab_status_id[]' data-lens-id = "+id+" style='display:none' class='update lab_status'  onchange='change_status_lab(this.value,"+id+")'></select>");
    //  var url = "{{url('get_lab_status')}}";
    //           $.ajax({
    //             url : url,
    //             type : 'GET',
    //             cache: false,
    //             data: {_token:'{{ csrf_token() }}'},
    //             success: function(classesData) {
    //                  console.log(classesData);
    //                  var select = $(".lab_status");
    //                  select.empty();
    //                  select.append($('<option/>', {
    //                                     value: '',
    //                                     text: 'Select'
    //                                 }));
                    
    //                             $.each(classesData, function (index, itemData) {
    //                                 select.append($("<option value="+itemData.id+">"+itemData.status_type+"</option>"));
    //                             });
                     
    //                  console.log("success");  
    //      },
              
              
    //           });
     
    //           if ( a == 'Received') {
       
    //         //Reference the TextBox.
    //         var textbox = $(this).next();
     
    //         //Set the name attribute of the TextBox.
    //          textbox[0].name = this.id.replace("select");
     
    //         //Assign the value of Label to TextBox.
    //         textbox.val(label.html());
     
    //         //When Label is clicked, hide Label and show dropdown.
    //         label.click(function () {
    //             $(this).hide();
    //             $(this).next().show();
    //         });
     
    //         //When focus is lost from dropdown, hide dropdown and show Label.
    //         textbox.focusout(function () {
    //             $(this).hide();
    //             $(this).prev().html($(this).text());
    //             //$(this).prev().html($(find(":selected").text()));
    //             //$(this).prev().text();
    //             // $(".order_status option:selected").html($(this).text());
    //             $(this).prev().show();
    //         });
    //     }
    // });
    
    $("td[data-st]").mouseenter(function(){
		
        //   $(this).prev().text();
          var a =  $(this).closest('tr').find("select").val()
          if (a == 'Received') {
            
          }

});
     
function lab_status_toggle(id){
                $("#select_lab_"+id).show();
                $("#lbl_lab_"+id).hide();
                    
            
            }
           

   
            function change_status_lab(lab_status_id, id) {
                    $("#lbl_lab_"+id).text($("#select_lab_"+id).find(":selected").text());
                     //$("#lbl_lab"+id).attr("class",'badge-danger');
                     //$("#lbl_lab"+id).removeClass('badge badge-warning').addClass('badge badge-danger');
                    $("#select_lab_"+id).hide();
                    $("#lbl_lab_"+id).show();
                    console.log(id)
                    console.log(lab_status_id)
                    var url = "{{ url('lab_status_update') }}/" + id;
                    
                    $.ajax({
                        url: url,
                        type: "PUT",
                        cache: false,
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        data: {
                            _token: '{{ csrf_token() }}',
                            lab_status_id: lab_status_id
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
                     
           
    
    
    //end status


    // start tray number
    function tray_number_toggle(id){
        $("#tray_number_insert_"+id).show();
        $("#tray_number_entry_"+id).hide();
    }
          
        function insert_tray_number(tray_number,id) {
            $("#tray_number_entry_"+id).val($("#tray_number_insert_"+id).find(":input").val());
       
            $("#tray_number_insert_"+id).prev().hide();
            $("#tray_number_entry_"+id).next().show();
           //var id = $(this).attr("data-element");
           console.log(id);
           console.log(tray_number);
           var url = "{{ url('update_tray_number') }}/"+id;
           $.ajax({
               url: url,
               type: "PUT",
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               data: {
                   _token: '{{ csrf_token() }}',
                   tray_number: tray_number
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
        </script>

@endsection
