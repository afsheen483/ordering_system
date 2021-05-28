@extends('layouts.master')

@section('title')
    Coatings
@endsection

@section('headername')
   Form Coatings

@endsection

@section('content')
    <div class="container">
<div class="card col-8">
    <div class="card-header">
      <h5 class="title">Coatings</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('coating.store')}}">
      @csrf
      <div class="container" style="margin-left: 10%">
        <div class="row">
          <div class="col-md-5 p1-5">
            <div class="form-group">
              <label>Coating 1</label>
              <input type="text" class="form-control" placeholder="Coating" name="coating">
            </div>
            <div class="form-group col-md-3 p1-3">
                <button type="submit" class="btn btn-primary btn-md">Submit</button>    
            
              </div>
            
          </div>
          
          </div>
        </div>
    </div>
      </form>
    </div>
  </div>

</div>
</div>





    
@endsection

@section('scripts')
    
@endsection