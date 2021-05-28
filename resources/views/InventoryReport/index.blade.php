<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">


@extends('layouts.master')


@section('title')
    Inventory Reports
@endsection

@section('headername')
Inventory Reports
@endsection

@section('content')

<div class="row">

    <div class="card">
      <div class="card-header">
        {{-- <a href="{{ route('frame.create') }}" class="btn btn-primary" style="float: right">+ Add Frame</a> --}}
       
        
        <h4 class="card-title">Inventory Reports</h4>
      </div>
      <div class="rows" >
        @hasanyrole('admin|vendor|staff|receiver')
          <form id="date_form" class="form-inline" method="GET" action="{{ url('inventory_reports_create') }}" style="display: none">
            @csrf
                  <label for="" style="margin-left: 0.5cm"> Start Date:&nbsp;</label><br>  
                 <input type="date" name="start_date" id="start_date" required class="col-md-2" style="margin-left: 0.1cm">
                 <label for="" style="margin-left: 0.1cm">&nbsp;End Date:&nbsp;</label>
                 <input type="date" name="end_date" id="end_date" required style="margin-left: cm" class="col-md-2">&nbsp;                            
             <button type="submit" class="btn btn-primary" id="range-date" style="margin-top:-1.6ch">Search</button>
            </form>
            @endhasanyrole
        </div>
        
      <div class="card-body">
        <div class="dropdown">
          <button type="button" class="btn btn-lg btn-secondary dropdown-toggle" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Filters
          </button>
         
          <div class="dropdown-menu" >
              <a href="/inventory_reports/all" class="dropdown-item" name="all" class="all" id="btn-all">All</a>
              <a href="/inventory_reports/stocked_items" class="dropdown-item" name="shipped" class="shipped"
                  id="complete-btn">Stocked Items</a>
                  <a href="/inventory_reports/non_stocked_items" class="dropdown-item" name="missing" class="missing"
                  id="missing-btn">NonStocked Items</a>
             
          </div>
        
        
        {{-- <button class="export-btn btn btn-success btn-lg"><i class="fa fa-file-excel-o"></i> &nbsp;Export</button> --}}
        {{-- <button id="button-excel" class=" btn btn-success btn-lg"><i class="fa fa-file-excel-o"></i> &nbsp;Export</button> --}}
        <button style="display: none" id="one" type="submit" class="btn btn-lg btn-primary"  data-toggle="modal" data-target="#exampleModal">Batch Together</button>
        <button type="submit" id="date_filter" class="btn btn-lg btn-info">Date Filter</button>
        
    </div>
    
    <br>
        <div class="table-responsive">
          <div class="container-fluid">
            <table id="example" class="display" style="width:100%">
              <thead >
                <th>Manufacturer</th>
              <th>Brand Name</th>
              <th>Collection</th>
              <th>Model Name </th>
              <th>Cost</th>
              <th>Sell Price</th>
            
              <th>Stock</th>
              <th>Sold</th>
              <th>Status</th>
              <th>Is Stocked Item</th>
              @if (Request::get('start_date') == true && Request::get('end_date')== true )
                  <th>MIN</th>
                  <th>MAX</th>
          
              @endif
            </thead>
            <tbody>
            @foreach ($inventory_reports as $inventory_reports)
                
              <tr>
               
                <td>{{ $inventory_reports->manufacturer_name }}</td>
                <td>{{ $inventory_reports->brand_name }}</td>
                <td>{{ $inventory_reports->collection }}</td>
                <td>{{ $inventory_reports->model_name }}</td>
               
               
                <td>{{ $inventory_reports->cost }}</td>
                <td>{{ $inventory_reports->sell_price }}</td>
                
                <td>{{ $inventory_reports->stock }}</td>
                <td>{{ $inventory_reports->sold }}</td>
                <td>@if ($inventory_reports->is_active == 1) 
                  <span class="badge badge-success">{{ 'Active' }}</span>
                @else
                <span class="badge badge-warning">{{ 'Discontinued' }}</span>

                @endif
                </td>
                <td>@if ($inventory_reports->is_stocked_item == 1) 
                  <span class="badge badge-success">{{ 'Stocked Item' }}</span>
                @else
                <span class="badge badge-warning">{{ 'NonStocked Item' }}</span>

                @endif
                </td>
                @if (Request::get('start_date') == true && Request::get('end_date')== true )
                <td>{{ $inventory_reports->min }}</td>
                <td>{{ $inventory_reports->max }}</td>
               
        
            @endif
              
              </tr>
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
        
        $(".delete-btn").click(function(){
          var delete_id = $(this).attr("id");
          console.log(delete_id);
          var url = "{{url('frame')}}/"+delete_id;
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
         
        $("#date_filter").click(function(){
        $("#date_form").toggle();
     });
} );
    </script>
@endsection