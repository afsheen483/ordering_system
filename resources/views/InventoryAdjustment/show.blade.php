<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.foundation.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.foundation.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


@extends('layouts.master')


@section('title')
    Inventory Adjustment
@endsection

@section('headername')
    Inventory Adjustment
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="btn-group" role="group" aria-label="Basic example" style="position: absolute; right: 2%;">
                <a href="{{ route('inventory_adjustment.index') }}" class="btn btn-primary" style="margin-left: 12cm">Back</a>
                <a href="{{ route('inventory_adjustment.create',['id'=>$inventory_adjustment[0]->id]) }}" class="btn btn-primary" >Edit</a>
            </div>
        </div>
        <h4 class="card-title">Inventory Adjustment</h4>
      </div>
      
      <div class="card-body">
         
        <div class="table-responsive">
          <div class="container-fluid">
            <table class="table">
              <thead >
              <th>ID</th>
              <th>Category Name</th>
              <th>Model Name</th>
              <th>Brand Name </th>
              <th>Manufacturer</th>
              <th>Adjustment Type</th>
              <th>Quantity</th>
              <th>Remarks</th>
           
            </thead>
            <tbody>
           
                
              <tr>
                <td>{{ $inventory_adjustment[0]->id }}</td>
                <td>{{ $inventory_adjustment[0]->category_name }}</td>
                <td>{{ $inventory_adjustment[0]->model_name }}</td>
                <td>{{ $inventory_adjustment[0]->brand_name }}</td>
                <td>{{ $inventory_adjustment[0]->manufacturer_name }}</td>
                <td>{{ $inventory_adjustment[0]->type }}</td>
                <td>{{ $inventory_adjustment[0]->qty }}</td>
                <td>{{ $inventory_adjustment[0]->remarks }}</td>
               
              
            
              </tr>
             

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

@endsection