@extends('layouts.master')

@section('title')
   Update Frames
@endsection

@section('headername')
  Update Form Frames

@endsection

@section('content')
    <div class="container">
<div class="card col-8">
    <div class="card-header">
      <a href="{{ route('frame.index') }}" class="btn btn-primary" style="float: right;">Back</a>
      <h5 class="title">Update Frames</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="/frame_update/{{ $frame->id }}">
      @csrf
      @method('PUT')
      @csrf
      <div class="container" style="margin-left: 10%">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Frame Model</label>
              <input type="text" class="form-control" placeholder="Enter Frame Model Name" name="model_name" value="{{ $frame->model_name }}">
            </div>
          </div>
          
          <div class="col-md-5">
              <div class="form-group">
                  <label for="">Brand</label>
                  <select name="brand_id" id="" class="form-control">
                      <option value="">Select</option>
                      @foreach ($frame_brand_array as $brand)
                      @if ($frame->brand_id == $brand->id)
                      <option value="{{ $brand->id }}" selected>{{ $brand->brand_name }}{{ " "}}({{ $brand->manufacturer_name}})</option>                          
                      @endif
                          <option value="{{ $brand->id }}">{{ $brand->brand_name }}{{ " "}}({{ $brand->manufacturer_name}})</option>                          
                      @endforeach
                  </select>
              </div>
          </div>
        </div>
        
        
        <div class="row">
          <div class="col-md-5">
              <div class="form-group">
                <label for="">Category</label>
                <select name="category_id" id="" class="form-control">
                    <option value="">Select</option>
                    @foreach ($category_array as $category)
                    @if ($frame->category_id == $category->id)
                    <option value="{{ $category->id}}" selected>{{ $category->category_name }}</option>

                    @endif
                    <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                        
                    @endforeach
                </select>
              </div>
          </div>
          
          <div class="col-md-5">
            <div class="form-group">
              <label for="">Cost</label>
              <input type="number" name="cost" id="cost" placeholder="Enter Cost" class="form-control" value="{{ $frame->cost }}">
            </div>
        </div>
        
        </div>
        
        
        <div class="row">
          <div class="col-md-5">
              <div class="form-group">
                <label for="">Sell Price</label>
                <input type="number" name="sell_price" id="sell_price" placeholder="Enter Sell Price" class="form-control" value="{{ $frame->sell_price }}">
              </div>
          </div>
          
          <div class="col-md-5">
            <div class="form-group">
              <label for="">URL Link</label>
              <input type="text" name="url_link" id="url_link" placeholder="Enter URL Link" class="form-control" value="{{ $frame->url_link }}">
            </div>
        </div>
        
        </div>
        <div class="row">
          <div class="col-md-10">
              <div class="form-group">
                <label for="">Purchasing Link</label>
                <input type="text" name="purchasing_link" id="purchasing_link" placeholder="Enter Purchasing Link" class="form-control" value="{{ $frame->purchasing_link }}">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
            @if ($frame->is_active == 1)
            <input type="checkbox" name="is_active" id="is_active" value="1" checked>&nbsp;
            <label for="">Is Active</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @else
            <input type="checkbox" name="is_active" id="is_active" value="1">&nbsp;
            <label for="">Is Active</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @endif
             @if ($frame->is_stocked_item == 1)
             <input type="checkbox" name="is_stocked_item" id="is_stocked_item" value="1" checked>&nbsp;
             <label for="">Is Stocked Item</label>
             @else
             <input type="checkbox" name="is_stocked_item" id="is_stocked_item" value="1">&nbsp;
             <label for="">Is Stocked Item</label>
             @endif
             
            </div>
          </div>
          
         
           
            
        </div>
        
            <div class="form-group col-md-3 p1-3">
                <button type="submit" class="btn btn-primary btn-md">Submit</button>    
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