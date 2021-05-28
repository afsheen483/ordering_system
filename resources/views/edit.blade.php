
@extends('layouts.master')

@section('title')
    Create Prescritpion Type
@endsection

@section('headername')
Prescritpion Type
@endsection

@section('content')
<div class="card">
    <div class="card-header">
      <h5 class="title">Prescritpion Type</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="/prescription_update/{{ $prescription->id }}">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-md-3 p1-3">
            <div class="form-group">
              <label>Role</label>
              <input type="text" class="form-control" placeholder="LensType" name="type" value="{{ $prescription->type }}">
            </div>
            <div class="form-group col-md-3 p1-3">
                <button type="submit" class="btn btn-primary btn-md">Add</button>    
            
              </div>
            
          </div>
          
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection

