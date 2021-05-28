@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title')
    Orders Entry
@endsection
@section('headername')
    Orders Entry
@endsection
@section('content')

        
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
                                        <h6 id="print_lable">
                                        </h6>
                                        <button class="btn btn-success btn-lg"  type="submit" style="margin-left: 8.8cm;margin-top:-1.24cm">Print Lable</button>
            
                                    </form>
                                    <form action="{{ url('print_orders') }}" method="get" target="_blank" style="display: none" id="print_order" >
                                        @csrf
                                            <h6 id="print_order_h6">
                                            </h6>
                                            <button class="btn btn-success btn-lg"  type="submit" style="margin-left: 11.7cm;margin-top:-1.46cm">Print Orders</button>
                
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
                                            @hasanyrole('admin|vendor')
                                            <th data-priority="1"></th>
                                          
                                            <th  data-priority="2"><input type="checkbox" name="checkAll" id="selectAll" ></th>
                                            @endhasanyrole
                                           
                                            <th  data-priority="3">Date</th>
                                            <th  data-priority="4">Patient</th>
                                            <th data-priority="-7">Tray Number</th>
                                            <th>Type</th>
                                            {{-- <th>Eye</th>
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
                                            <th>ED</th> --}}
                                            <th>Frame Models</th>
                                            <th  data-priority="5">Shippment
                                            Tracking<br>
                                            Numbers</th>
                                            <th>Invoice Number</th>
                                            <th >Frame
                                            Order Number</th>
                                            @hasanyrole('vendor|admin|receiver')
                                            <th  data-priority="-6">Price</th>
                                            @endhasanyrole
                                            @hasanyrole('admin|receiver|vendor')
                                            <th  data-priority="-5">Paid</th>
                                            @endhasanyrole
                                            <th>Freight Cost</th>
                                            <th>Staff Notes</th>
                                            @hasanyrole('receiver|admin|vendor')
                                            <th data-priority="-4">Lens Status</th>
                                            <th data-priority="-3">Lab Status</th>
                                            <th  data-priority="-2">Frame Status</th>
                                            @endhasanyrole
                                            @hasanyrole('staff|admin')
                                            <th  data-priority="-1">Action</th>
                                            @endhasanyrole
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
                    @if (date("Y-m-d", strtotime('+5 days', strtotime($order->date_of_service))) < date("Y-m-d") )
                    @hasanyrole('admin|vendor')
                                <td></td>
       
                                       <td style="background-color: rgb(247, 141, 141);"><input type="checkbox" name="patient[]" value="{{ $order->id }}" class="check_box" id="check-box" ></td>   
                                    @endhasanyrole   
                                        <td style="background-color: rgb(247, 141, 141);">{{ $order->date_of_service }}</td>
                                      
                                        @hasanyrole('vendor|receiver|staff|admin')
                                        <td style="background-color: rgb(247, 141, 141);"><a href="/orders_show/{{ $order->id }}" >{{ $order->patient_name }}</a></td>
                                        
                                        @endhasanyrole
                                         
                                        {{-- <td style="background-color: rgb(247, 141, 141);">{{ $order->tray_number }}</td>
                                        <td style="background-color: rgb(247, 141, 141);">{{ $order->type }}</td> --}}
                          @else 
                          @hasanyrole('admin|vendor')
 
                                            <td></td>
                          <td ><input type="checkbox" name="patient[]" value="{{ $order->id }}" class="check_box" id="check-box" ></td>   
                       @endhasanyrole   
                           <td >{{ $order->date_of_service }}</td>
                         
                           @hasanyrole('vendor|receiver|staff|admin')
                           <td ><a href="/orders_show/{{ $order->id }}">{{ $order->patient_name }}</a></td>
                           
                           @endhasanyrole
                             
                           
                          @endif           
                                        {{-- <td>{{ $order->eye }}</td>
                                        <td>{{ $order->sph }}</td>
                                        <td>{{ $order->cyl }}</td>
                                        <td>{{ $order->axis }}</td>
                                        <td>{{ $order->add }}</td>
                                        <td>{{ $order->pd }}</td>
                                        <td>{{ $order->ph }}</td>
                                        <td>{{ $order->lens_type->lenses }}</td>
                                        <td>{{ $order->coating->coating}}</td>
                                        <td>{{ $order->coating2->coating }}</td>
                                        <td>{{ $order->coating3->coating }}</td>
                                        <td>{{ $order->coating4->coating }}</td>
                                        <td>{{ $order->a }}</td>
                                        <td>{{ $order->b }}</td>
                                        <td>{{ $order->dbl }}</td>
                                        <td>{{ $order->ed }}</td> --}}
                                        <td>
                                            <input type = 'text' name='tray_number[]' style='display:none' class='form-control' onfocusout='insert_tray_number(this.value,{{ $order->patient_id }})' id="tray_number_insert_{{ $order->patient_id }}"/>
                                            <span data-tray="{{ $order->patient_id }}" class="EditTrayNumber" onclick="tray_number_toggle({{ $order->patient_id }})" id="tray_number_entry_{{ $order->patient_id }}" style="cursor: pointer;">{{ $order->tray_number }}</span>
                                        </td>
                                        <td>{{ $order->type }}</td>
                                        <td>{{ $order->model_name }}</td>
                                        
                                        <td >{{ $order->tracking_number }}</td>
                                        <td >{{ $order->lens_order_number }}</td>
                                        <td >{{ $order->frame_order_number }}</td>
                                        
                                        @hasanyrole('admin|receiver|vendor')                                       
                                        <td>
                                            <input type = 'text' style='display:none' name='price[]'   class='form-control' onfocusout='insert_Price(this.value,{{ $order->id }})' id="enter_price_entry_{{ $order->id }}"/>
                                            @if ($order->price == '')
                                            <span data-element="{{ $order->id  }}" class="editable" onclick="price_toggle({{ $order->id }})" id="price_entry_{{ $order->id }}" style="cursor: pointer;">0</span>
                                            @else  
                                            <span data-element="{{ $order->id  }}" class="editable" onclick="price_toggle({{ $order->id }})" id="price_entry_{{ $order->id }}" style="cursor: pointer;">{{ $order->price }}</span>
                                            @endif
                                        </td>
                                      
                                        @endhasanyrole
                                        @hasrole('vendor')
                                    
                                        @if ($order->paid == '')
                                            <td>0</td>
                                        @else
                                            <td>{{$order->paid }}</td>
                                        @endif                                       
                                        @endhasrole
                                        @hasanyrole('admin|receiver')
                                        <td>
                                            <input type = 'number' name='paid[]' style='display:none' class='form-control' onfocusout='insert_paid(this.value,{{ $order->id }})' id="enter_paid-entry_{{ $order->id }}"/>
                                            @if ($order->paid == '')
                                                <span class="paid" data-paid="{{ $order->id}}" onclick="paid_toggle({{ $order->id }})" id="paid_entry_{{ $order->id }}" style="cursor: pointer;">0</span>
                                            @else
                                                <span class="paid" data-paid="{{ $order->id}}" onclick="paid_toggle({{ $order->id }})" id="paid_entry_{{ $order->id }}" style="cursor: pointer;">{{$order->paid }}</span>
                                            @endif
                                        </td>
                                        @endhasanyrole
                                        <td>{{ $order->freight_cost }}</td>
                                        <td>{{ $order->staff_notes }}</td>
                                        @hasrole('vendor')
                                        <td> 
                                            @if ($order->order_status == 'Received' || $order->order_status == 'Shipped')
                                            {{-- <span data-id="{{$order->id }}" class=" badge badge-success edit_able" id="lblname">{{ $order->order_status }}</span> --}}
                                            <h5><span  class="badge badge-success " > {{ $order->order_status }}</span></h5>
                                           @else
                                             <h5><span  class=" badge badge-warning "  >{{ $order->order_status }}</span></h5>

                                            @endif
                                          
                                     </td>
                                     <td> 
                                       
                                        @if ($order->status_type == 'Cancel Order' || $order->status_type == 'Dispensed' || $order->status_type == 'Waiting to Cut')
                                        {{-- <span data-id="{{$order->id }}" class=" badge badge-success edit_able" id="lblname">{{ $order->order_status }}</span> --}}
                                        <h5><span  class="badge badge-warning"> {{ $order->status_type }}</span></h5>
                                       @else
                                         <h5><span  class=" badge badge-success " >{{ $order->status_type }}</span></h5>

                                        @endif
                                      
                                 </td>
                                        <td>
                                            @if ($order->frame_status == 'Received' || $order->frame_status == 'Shipped')
                                            <h5><span  class="badge badge-success">{{ $order->frame_status }}</span></h5>
                                            
                                            @else
                                            <h5><span  class=" badge badge-warning" >{{ $order->frame_status }}</span></h5>
                                            @endif
                                        </td>
                                        
                                        @endhasrole
                                            @hasanyrole('receiver|admin')
                                        <td> 
                                            <select name='order_status[]' style='display:none' class='update order_status'  onchange='receive_unreceive_order(this.value,{{ $order->id }})' id="select_lens_status_{{ $order->id }}" data-labStatus="{{ $order->id }}">
                                                <option value='0'>Select</option>
                                                <option value='Received'>Received</option>
                                                <option value='Not Shipped'>Not Shipped</option>
                                                <option value='Missing'>Missing</option>
                                            </select>
                                                @if ($order->order_status == 'Received' || $order->order_status == 'Shipped')
                                                {{-- <span data-id="{{$order->id }}" class=" badge badge-success edit_able" id="lblname">{{ $order->order_status }}</span> --}}
                                                <h5><span data-id="{{$order->id }}" class="badge badge-success edit_able" id="lable_lens_status_{{ $order->id }}" onclick="lens_status_toggle({{ $order->id }})" style="cursor: pointer;">{{ $order->order_status }}</span></h5>
                                               @else
                                                 <h5><span data-id="{{ $order->id }}" class=" badge badge-warning edit_able" id="lable_lens_status_{{ $order->id }}" onclick="lens_status_toggle({{ $order->id }})" style="cursor: pointer;">{{ $order->order_status }}</span></h5>

                                                @endif
                                              
                                         </td>
                                         <td data-st="{{ $order->id }}" id="data-st"> 
                                            <select name='lab_status_id[]'  style='display:none' class='update lab_status'  onchange='change_status_lab(this.value,{{ $order->id }})' id="select_lab_{{ $order->id }}">
                                                @foreach ($lab_status_array as $status)
                                                    <option value="{{ $status->id }}">{{ $status->status_type }}</option>
                                                @endforeach
                                            </select>
                                            @if ($order->status_type == 'Cancel Order' || $order->status_type == 'Dispensed' || $order->status_type == 'Waiting to Cut')
                                            {{-- <span data-id="{{$order->id }}" class=" badge badge-success edit_able" id="lblname">{{ $order->order_status }}</span> --}}
                                            <h5><span data-lab="{{$order->id }}" class="badge badge-warning lab_status_editable" id="lbl_lab_{{ $order->id }}" onclick="lab_status_toggle({{ $order->id }})" style="cursor: pointer;">{{ $order->status_type }}</span></h5>
                                           @else
                                             <h5><span data-lab="{{ $order->id }}" class=" badge badge-success lab_status_editable" id="lbl_lab_{{ $order->id }}" onclick="lab_status_toggle({{ $order->id }})" style="cursor: pointer;" >{{ $order->status_type }}</span></h5>

                                            @endif
                                          
                                     </td>
                                            <td>
                                                <select name='frame_status[]' style='display:none' class='update frame_status'  onchange='change_frame_status(this.value,{{ $order->id }})' id="select_frame_status_{{ $order->id }}" data-frameStatus="{{ $order->id }}">
                                                    <option value='0'>Select</option>
                                                    <option value='Received'>Received</option>
                                                    <option value='Shipped'>Shipped</option>
                                                    <option value='Not Shipped'>Not Shipped</option>
                                                    <option value='Missing'>Missing</option>
                                                </select>
                                                @if ($order->frame_status == 'Received' || $order->frame_status == 'Shipped')
                                                <h5><span data-frame="{{$order->id }}" class="badge badge-success edit_frame" id="lable_frame_status_{{ $order->id }}" onclick="frame_status_toggle({{ $order->id }})" style="cursor: pointer;">{{ $order->frame_status }}</span></h5>
                                                
                                                @else
                                                <h5><span data-frame="{{ $order->id }}" class=" badge badge-warning edit_frame" id="lable_frame_status_{{ $order->id }}" onclick="frame_status_toggle({{ $order->id }})" style="cursor: pointer;">{{ $order->frame_status }}</span></h5>
                                                @endif
                                            </td>
                                            

                                            @endhasanyrole
                                            @hasanyrole('staff|admin')
                                            <td><a href="/orders_edit/{{ $order->id }}" style="margin-left: 15%"><i
                                                        class="fa fa-edit"></i></a>|
                                                        <a href="/orders_show/{{ $order->id }}"><i
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
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.22/api/sum().js"></script>
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
        
        $('table thead th').each(function(i) {
                console.log(calculateColumn(i));
            });
       
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
            
           console.log(val);
           
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
           
            //this is for print lables for patients
            $("#print_lable").html("<input name='print_id[]' value='"+val+"'  type='text' id='print_id' style='display:none'/>");
            $("#print_order_h6").html("<input name='print_order_id[]' value='"+val+"'  type='text' id='print_order_id' style='display:none'/>");
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
