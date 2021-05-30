@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">


 

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
                  <input type="text" name="tracking_numbers" placeholder="Tracking Number" class="form-control" />
                    <!-- Data passed is displayed  
                        in this part of the  
                        modal body -->
                    <h6 id="modal_body"></h6> 
                    <h5 id="total_price"></h5> 
                    <input type="text" name="freight_cost" placeholder="Freight Cost..." id="freight_cost" class="form-control" />
                    <h5 id="total_Amount"></h5>
                </div> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Ship Batch</button>
                <button type="submit" class="btn btn-warning">UnShip Batch</button>
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
                
                {{-- cyl sph filter --}}
              
                <form action="{{ url('cyl_sph_filter') }}" method="post"  id="sph_cyl_form" style="display: none">
                    @csrf
                       
                      
                       <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                <input type="number" name="from_sph" id="" placeholder="SPH From" class="form-control" >
                                </div>

                            </div>
                            <div class="col-2" >
                                <div class="form-group">
                                    <input type="number" name="to_sph" id="" placeholder="SPH To" class="form-control" >
                                    
                                </div>
                            </div>
                            <div class="col-1">
                                    <div class="form-group">
                                        <select name="and_or" id="" class="form-control" >
                                            <option value="OR">OR</option>
                                            <option value="AND">AND</option>
                                        </select>
                                       
                                       
                                    </div>
                            </div>
                            <div class="col-2" >
                                <div class="form-group">
                                <input type="number" name="from_cyl" id="" placeholder="CYL From" class="form-control" >
                                </div>
                            </div>
                            <div class="col-2" >
                                <div class="form-group">
                                    <input type="number" name="to_cyl" id="" placeholder="CYL To" class="form-control" >

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                   <select class="form-control" name="lenses">
                                             <option value="" >Select Lens Type</option>
                                        @foreach ($lens_type_array as $lense)
                                            <option value="{{ $lense->id }}">{{ $lense->lenses }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                         
                                <div class="form-group col-8">
                                    <select    id="coating_select" name="coating[]" multiple data-selected-text-format="count > 3">
                                        
                                        
                                       
                                        @foreach ($coating_array as $coating)
                                            <option value="{{ $coating->id }}">{{ $coating->coating }}</option>
                                        @endforeach
                                       
                                    </select>
                                    <button type="submit" class="btn btn-primary" >Search</button>

                                </div>
                               
                        </div>
                    </div>
                    </form>
          
          
                {{-- cyl sph filter --}}
                
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
                        <div class="col">
                            <div class="dropdown" style="margin-left: -11.6cm">
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
                              <button type="botton" id="cyl_sph" class="btn btn-lg btn-info">Range Filter</button>
        
                              
                          </div>
                          
                        </div>
                    </div>

                <div class="container-fluid" style="margin-bottom:-1.1%;">
                   
                        <div class="card-body">
                          <div class="table-responsive" id="dvData">
                            <form>
                                <table class="display" id="example">
                                    <thead>
                                        <tr>
                                            
                                           
                                            <th >Date</th>
                                            <th>Patient</th>
                                            <th>Tray Number</th>
                                            <th>Type</th>
                                            <th>Eye</th>
                                            <th>Sph</th>
                                            <th>Cyl</th>
                                            <th>Axis</th>
                                            <th>Add</th>
                                            <th>PD</th>
                                            <th>PH</th>
                                            <th>Lens 
                                            Type</th>
                                            <th>Coating1</th>
                                            <th>Coating2</th>
                                            <th>Coating3</th>
                                            <th>Coating4</th>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>DBL</th>
                                            <th>ED</th>
                                            <th>Lens Status</th> 
                                            <th>Action</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody >
                                   @php
                                       //dd($orders[0]);
                                       //return;
                                   @endphp
                                {{-- @if(!empty($orders)) --}}
                                @foreach ($orders as $order)
                                      
                                <tr>
                               
                    @if (date("Y-m-d", strtotime('+5 days', strtotime($order->date_of_service))) < date("Y-m-d"))

                                 
                                        <td style="background-color: rgb(247, 141, 141);">{{ $order->date_of_service }}</td>
                                      
                                        @hasanyrole('vendor|receiver|admin|staff')
                                        <td style="background-color: rgb(247, 141, 141);"><a href="/orders_show/{{ $order->order_head_id }}" >{{ $order->patient_name }}</a></td>
                                        
                                        @endhasanyrole
                                          
                                        <td style="background-color: rgb(247, 141, 141);">{{ $order->tray_number }}</td>
                                        <td style="background-color: rgb(247, 141, 141);">{{ $order->type }}</td>
                          @else 
                          @hasanyrole('admin|vendor')
 
                                            
                       @endhasanyrole   
                           <td >{{ $order->date_of_service }}</td>
                         
                           @hasanyrole('vendor|receiver|admin|staff')
                           <td ><a href="/orders_show/{{ $order->order_head_id }}">{{ $order->patient_name }}</a></td>
                           
                           @endhasanyrole
                          
                           <td>{{ $order->tray_number }}</td>
                           <td>{{ $order->type }}</td>
                          @endif           
                                        <td>{{ $order->eye }}</td>
                                        <td>{{ $order->sph }}</td>
                                        <td>{{ $order->cyl }}</td>
                                        <td>{{ $order->axis }}</td>
                                        <td>{{ $order->add }}</td>
                                        <td>{{ $order->pd }}</td>
                                        <td>{{ $order->ph }}</td>
                                        <td>{{ $order->lenses }}</td>
                                        <td>@if ($order->coating->coating == 'Select')
                                            {{ '' }}
                                        @else
                                             {{ $order->coating->coating}}
                                        @endif</td>
                                        <td>@if ($order->coating2->coating)
                                            {{ '' }}
                                        @else
                                             {{ $order->coating2->coating }}
                                        @endif</td>
                                        <td>@if ($order->coating3->coating == 'Select')
                                            {{ '' }}
                                        @else
                                             {{ $order->coating3->coating }}
                                        @endif</td>
                                        <td>@if ($order->coating4->coating == 'Select')
                                            {{ '' }}
                                        @else
                                            {{ $order->coating4->coating }}
                                        @endif</td>
                                        <td>{{ $order->a }}</td>
                                        <td>{{ $order->b }}</td>
                                        <td>{{ $order->dbl }}</td>
                                        <td>{{ $order->ed }}</td>
                                        <td > 
                                            @if ($order->order_status == 'Received' || $order->order_status == 'Shipped')
                                            {{-- <span data-id="{{$order->id }}" class=" badge badge-success edit_able" id="lblname">{{ $order->order_status }}</span> --}}
                                            <h5><span data-id="{{$order->id }}" class="badge badge-success edit_able" id="lblname"  >{{ $order->order_status }}</span></h5>
                                           @else
                                             <h5><span data-id="{{ $order->id }}" class=" badge badge-warning edit_able" id="lblname">{{ $order->order_status }}</span></h5>

                                            @endif
                                          
                                     </td>
                                        

                                         
                                            @hasanyrole('staff|admin')
                                            <td><a href="/orders_edit/{{ $order->order_head_id }}" style="margin-left: 15%"><i
                                                        class="fa fa-edit"></i></a>|
                                                        <a href="/orders_show/{{ $order->order_head_id }}"><i
                                                            class="fa fa-eye"></i></a>
                                            </td>
                                            @endhasanyrole
                                   
                                        </td>
                                      
                                       
                                        </tr>
                                        @endforeach
                                  
                                      
                                        
                                    </tbody>
                                    
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
{{-- multiselect dropdwn --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

<script>









$(document).ready(function() {
    $('#coating_select').selectpicker();
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
        
        $('table thead th').each(function(i) {
                console.log(calculateColumn(i));
            });
       
        




      
  

} );

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
                
                
                //=================status change=======================
                
                $(function () {
        
        $(".edit_able").each(function () {
            //Reference the Label.
           var id= $(this).attr("data-id");
           //console.log(id);
            var label = $(this);
     label.after("<select name='order_status[]' style='display:none' class='update order_status'  onchange='receive_unreceive_order(this.value,"+id+")'>+<option value='0'>Select</option>+<option value='Received'>Received</option>+<option value='Shipped'>Shipped</option>++<option value='Not Shipped'>Not Shipped</option>+<option value='Missing'>Missing</option>+</select>");
     
            //Reference the TextBox.
            var textbox = $(this).next();
     
            //Set the name attribute of the TextBox.
            textbox[0].name = this.id.replace("select");
     
            //Assign the value of Label to TextBox.
            textbox.val(label.html());
     
            //When Label is clicked, hide Label and show TextBox.
            label.click(function () {
                $(this).hide();
                $(this).next().show();
            });
     
            //When focus is lost from TextBox, hide TextBox and show Label.
            textbox.focusout(function () {
                $(this).hide();
                $(this).prev().html($(this).val());
                $(this).prev().show();
            });
    });
});
            function receive_unreceive_order(order_status, id) {
            
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
            
$(function () {
        
        $(".edit_frame").each(function () {
            //Reference the Label.
           var id= $(this).attr("data-frame");
           //console.log(id);
            var label = $(this);
     label.after("<select name='frame_status[]' style='display:none' class='update frame_status'  onchange='change_frame_status(this.value,"+id+")'>+<option value='0'>Select</option>+<option value='Received'>Received</option>+<option value='Shipped'>Shipped</option>++<option value='Not Shipped'>Not Shipped</option>+<option value='Missing'>Missing</option>+</select>");
     
            //Reference the TextBox.
            var textbox = $(this).next();
     
            //Set the name attribute of the TextBox.
            textbox[0].name = this.id.replace("select");
     
            //Assign the value of Label to TextBox.
            textbox.val(label.html());
     
            //When Label is clicked, hide Label and show TextBox.
            label.click(function () {
                $(this).hide();
                $(this).next().show();
            });
     
            //When focus is lost from TextBox, hide TextBox and show Label.
            textbox.focusout(function () {
                $(this).hide();
                $(this).prev().html($(this).val());
                $(this).prev().show();
            });
    });
});
            function change_frame_status(frame_status, id) {
            
                    console.log(id)
                    console.log(frame_status)
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
            
            
            
            
            //================end frame status=================
            
            
            
            
$(function () {
    //Loop through all Labels with class 'editable'.
    $(".editable").each(function () {
        //Reference the Label.
        var val = $('.editable').val();
        var id = $(this).attr("data-element");
        
        var label = $(this);
        console.log(id);
        //Add a TextBox next to the Label.
       
        label.after("<input type = 'text' style='display:none' name='price[]'   class='form-control' onfocusout='insert_Price(this.value,"+id+")'/>");
 
        //Reference the TextBox.
        var textbox = $(this).next();
 
        //Set the name attribute of the TextBox.
        textbox[0].name = this.id.replace("lbl", "txt");
 
        //Assign the value of Label to TextBox.
        textbox.val(label.html());
 
        //When Label is clicked, hide Label and show TextBox.
        label.click(function () {
            $(this).hide();
            $(this).next().show();
        });
 
        //When focus is lost from TextBox, hide TextBox and show Label.
        textbox.focusout(function () {
            $(this).hide();
            $(this).prev().html($(this).val());
            $(this).prev().show();
        });
    });
});


function insert_Price(price,id) {
           
           //var id = $(this).attr("data-element");
           console.log(id);
           console.log(price);
           var url = "{{ url('order_price') }}/"+id+"/"+price;
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
       
       
       $(".paid").each(function () {
        //Reference the Label.
        var id = $(this).attr("data-paid");
        var val = $(".paid").val();
       console.log(val);
      
        var label = $(this);
        console.log(id);
        //Add a TextBox next to the Label.
        label.after("<input type = 'text' name='paid[]' style='display:none' class='form-control' onfocusout='insert_paid(this.value,"+id+")' />");
        var textbox = $(this).next();
 
         //Set the name attribute of the TextBox.
         textbox[0].name = this.id.replace("lbl", "txt");
        
         //Assign the value of Label to TextBox.
         textbox.val(label.html());
           
              
        
         //When Label is clicked, hide Label and show TextBox.
         label.click(function () {
             $(this).hide();
             $(this).next().show();
         });
        
         //When focus is lost from TextBox, hide TextBox and show Label.
         textbox.focusout(function () {
             $(this).hide();
             $(this).prev().html($(this).val());
             $(this).prev().show();
         });

        
    });
          
        function insert_paid(paid,id) {
           
           //var id = $(this).attr("data-element");
           console.log(id);
           console.log(paid);
           var url = "{{ url('vendor_number_update') }}/"+id+"/"+paid;
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
                   // console.log(checkedChbx);
                }
             else {
                $("#one").hide();
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
        $('#selectAll').click(function(e){
           var table= $(e.target).closest('table');
           $('td input:checkbox',table).attr('checked',e.target.checked);
        
           });
           $('[type="checkbox"]').click(function(){
        var val = [];
        $('[type="checkbox"]:checked').each(function(i){
          val[i] = $(this).val();
        });
        $("#modal_body").html("<input name='patient_id[]' value='"+val+"'  type='text' id='patient_id' style='display:none'/>");
            var patient_id = $('#patient_id').val();
           console.log(patient_id);
            var url = "{{ url('total-price') }}/"+patient_id;
            $.ajax({
                url: url,
                type: "GET",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    console.log(data);
                    $("#total_price").html('Total Price:'+data);
                    var price = data;
                    $("#freight_cost").keyup(function(){
                        var freight_cost= $('#freight_cost').val();
                        var total_amount = parseInt(freight_cost) + parseInt(price);
                        $("#total_Amount").html('Total Amount:'+total_amount);
                        
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("request failure");
                    //errorFunction(); 
                }
            });
        
        });  
       
        $("#date_filter").click(function(){
        $("#date_form").toggle();
     });
     $("#cyl_sph").click(function(){
        $("#sph_cyl_form").toggle();
     });
     
    
        </script>

@endsection
