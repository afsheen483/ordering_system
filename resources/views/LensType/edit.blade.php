<link href="{{  asset('css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('demo/demo.css')}}" rel="stylesheet" />
@extends('layouts.master')

@section('title')
    Update LensType
@endsection

@section('headername')
    
    Update LensType
@endsection

@section('content')
<div class="card">
    <div class="card-header">
      <h5 class="title">Update LensType</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="/lens_update/{{ $lens->id }}">
      @csrf
      @method('PUT')
        <div class="row">
          <div class="col-md-3 p1-3">
            <div class="form-group">
              <label>Lense Type</label>
              <input type="text" class="form-control" placeholder="LensType" name="lenses" value="{{ $lens->lenses}}">
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