<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.foundation.min.css">

@extends('layouts.master')


@section('title')
Prescritpion Type
@endsection

@section('headername')
Prescritpion Type
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('prescription.create') }}" class="btn btn-primary" style="float: right">+ Add Prescription</a>

          <h4 class="card-title">Prescription</h4>
        </div>
        
        <div class="card-body">
           
          <div class="table-responsive">
            <div class="container-fluid">
              <table id="example" class="display" style="width:100%">
                <thead>
                <th>ID</th>
                <th>Type</th>
                <th>Actions</th>
              </thead>
              <tbody>
              @foreach ($prescription as $prescription)
                  
                <tr>
                  <td>{{ $prescription->id }}</td>
                  <td>{{ $prescription->type }}</td>
                  <td><a href="prescription_edit/{{ $prescription->id }}" style="color: rgb(8, 155, 74)"><i class="fa fa-edit"></i></a> |
                
                    <form method="post" action="{{route('prescription.destroy',$prescription->id)}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" style="color: red;margin-left: 6.5%;margin-top:-3.5%"><i class="fa fa-trash"></i></button>
                  </form></td>
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
        buttons: [ 'excel', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .small-6.columns:eq(0)' );
} );
    </script>
@endsection