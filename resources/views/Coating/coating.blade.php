<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.foundation.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


@extends('layouts.master')


@section('title')
    Coating
@endsection

@section('headername')
    Coating 
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('coating.create') }}" class="btn btn-primary" style="float: right">+ Add Coating</a>

        <h4 class="card-title">Coating</h4>
      </div>
      
      <div class="card-body">
         
        <div class="table-responsive">
          <div class="container-fluid">
            <table id="example" class="display" style="width:100%">
              <thead >
              <th>ID</th>
              <th>Coating </th>
              <th>Actions</th>
            </thead>
            <tbody>
            @foreach ($coating as $coating)
                
              <tr>
                <td>{{ $coating->id }}</td>
                <td>{{ $coating->coating }}</td>
                <td><a href="coating_edit/{{ $coating->id }}" style="color: rgb(8, 155, 74)"><i class="fa fa-edit"></i></a> |
              
                 <form method="post" action="{{route('coating.destroy',$coating->id)}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" style="color: red;margin-left: 8%;margin-top:-5%"><i class="fa fa-trash"></i></button>
                  </form>
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
        lengthChange: false,
        ordering:false,
        buttons: ['excel','colvis']
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .small-6.columns:eq(0)' );
        
       
               
        });
    </script>
@endsection