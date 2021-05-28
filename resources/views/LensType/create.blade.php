@extends('layouts.master')

@section('title')
    Create LensType
@endsection

@section('headername')
   Form LensType
@endsection

@section('content')
    
<div class="card">
    <div class="card-header">
      <h5 class="title">LensType</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('lens.store')}}">
      @csrf
        <div class="row">
          <div class="col-md-3 p1-3">
            <div class="form-group">
              <label>LensType</label>
              <input type="text" class="form-control" placeholder="LensType" name="lenses">
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

@section('scripts')
    
@endsection