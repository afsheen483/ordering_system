<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


@extends('layouts.master')


@section('title')
Tracking Details
@endsection

@section('headername')
Tracking Details
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
      

        <h4 class="card-title">Tracking Details</h4>
      </div>
      
      <div class="card-body">
         
        <div class="table-responsive">
          <div class="container-fluid">
            <table id="example" class="display" style="width:100%">
              <thead >
              <th>Date</th>
              <th>Vendor Name</th>
              <th>Tracking Numbers</th>
              <th>Total Amount</th>
              <th>Total Paid Amount</th>
            </thead>
            <tbody>
            {{-- @php
                  dd($tracking_numbers->user->name);
            @endphp --}}
            @foreach ($tracking_numbers as $tracking_numbers)
              
              <tr>
                <td>{{ $tracking_numbers->date }}</td>
                <td>{{ $tracking_numbers->name }}</td>
                <td>{{ $tracking_numbers->tracking_numbers }}</td>
                <td>${{ $tracking_numbers->total_amount }}</td>
                <td>${{ $tracking_numbers->total_paid }}</td>
              </tr>
              @endforeach

            </tbody>
            {{-- <tfoot>
              <tr>
                  <th></th>
                  <th><input type="text" id="tracking_numbers" Placeholder="Enter Tracking Number" class="form-control col-md-4" /></th>
                  <th>Total Price: $</th>
              </tr>
          </tfoot> --}}
          </table>
          </div>
        </div>
      </div>
    </div>
      You can get Total Amount against Tracking Number<br><br>
      <form class="form-inline">
        <input type="text" id="tracking_numbers" Placeholder="Enter Tracking Number" class="form-control col-3" />
        <p style="font-weight: bold; margin-left:5%">Total Amount: $<span id="totalPrice" style="margin-top: 10%; margin-left:3%"></span></p>
      </form>
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
        
} );
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
    </script>
@endsection