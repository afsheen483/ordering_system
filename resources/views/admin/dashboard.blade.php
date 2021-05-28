
@extends('layouts.master')


@section('headername')
    Dashboard
@endsection
@section('title')
    Dashboard
@endsection

@section('content')
<div class="row">
@hasanyrole('admin|vendor|staff|receiver')
@hasanyrole('admin|vendor')
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg3"><i class="fas fa-exclamation-circle"></i></span>
        <div class="dash-widget-info text-right">
            <h3>
            @php
                $id = Auth::user()->id;
                //dd($id);
            @endphp
            @if (Auth::user()->hasrole('vendor'))
                {{ \App\Models\VendorNumberModel::where('order_status','Not Shipped')->where('vendor_id',$id)->get()->count() }}
            @else
            {{ \App\Models\VendorNumberModel::where('order_status','Not Shipped')->get()->count() }}
            @endif</h3>
            <span class="widget-title3"><a href="/orders-list/notshipped" style="color: rgb(250, 249, 249);">Not Shipped</a></span>
        </div>
    </div>
  </div>
  @endhasanyrole
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
      <div class="dash-widget">
          <span class="dash-widget-bg2"><i class="fas fa-check"></i></span>
          <div class="dash-widget-info text-right">
            <h3>
                @php
                    $id = Auth::user()->id;
                    //dd($id);
                @endphp
                @if (Auth::user()->hasrole('vendor'))
                    {{ \App\Models\VendorNumberModel::where('order_status','Shipped')->where('vendor_id',$id)->get()->count() }}
                @else
                {{ \App\Models\VendorNumberModel::where('order_status','Shipped')->get()->count() }}
                @endif</h3>
              <span class="widget-title2"><a href="/orders-list/shipped" style="color: rgb(250, 249, 249);">Shipped Orders</a></span>
          </div>
      </div>
  </div>
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
      <div class="dash-widget">
          <span class="dash-widget-bg4"><i class="fas fa-clipboard-list-check"></i></span>
          <div class="dash-widget-info text-right">
            <h3>
                @php
                    $id = Auth::user()->id;
                   // dd($id);
                @endphp
                @if (Auth::user()->hasrole('vendor'))
                    {{ \App\Models\VendorNumberModel::where('order_status','Received')->where('vendor_id',$id)->get()->count() }}
                @else
                {{ \App\Models\VendorNumberModel::where('order_status','Received')->get()->count() }}
                @endif</h3>
              <span class="widget-title4"><a href="/orders-list/received" style="color: rgb(250, 249, 249);">Received</a></span>
          </div>
      </div>
  </div>
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg5"><i class="fa fa-remove"></i></span>
        <div class="dash-widget-info text-right">
        <h3>
            @php
                    $id = Auth::user()->id;
                   // dd($id);
                @endphp
                @if (Auth::user()->hasrole('vendor'))
                    {{ \App\Models\VendorNumberModel::where('order_status','Missing')->where('vendor_id',$id)->get()->count() }}
                @else
                {{ \App\Models\VendorNumberModel::where('order_status','Missing')->get()->count() }}
                @endif</h3>
            <span class="widget-title5"><a href="/orders-list/missing" style="color: rgb(250, 249, 249);">Missing</a> </span>
        </div>
    </div>
</div>  
@hasanyrole('admin|staff')
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg0"><i class="fas fa-plus"></i></span>
        <div class="dash-widget-info text-right">
            <h3><i class="fas fa-plus"></i></h3>
            <span class="widget-title0"><a href="{{ route('orders.create') }}" style="color: rgb(250, 249, 249);">Add Lens Orders</a></span>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg0"><i class="fas fa-plus"></i></span>
        <div class="dash-widget-info text-right">
            <h3><i class="fas fa-plus"></i></h3>
            <span class="widget-title0"><a href="{{ route('frame_order.create') }}" style="color: rgb(250, 249, 249);">Frames Order</a></span>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg7"><i class="fas fa-glasses"></i></span>
        <div class="dash-widget-info text-right">
            <h3>{{ \App\Models\FrameModel::where('id','!=','1')->count() }}</h3>
            <span class="widget-title7"><a href="/frame" style="color: rgb(250, 249, 249);">Frame Models</a></span>
        </div>
    </div>
</div>
@endhasanyrole
@hasanyrole('admin|vendor')
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg1"><i class="fab fa-first-order"></i></span>
        <div class="dash-widget-info text-right">
            <h3><i class="fab fa-first-order"></i></h3>
            <span class="widget-title1"><a href="/orders-list/priority" style="color: rgb(250, 249, 249);">Next Periority Orders </a></span>
        </div>
    </div>
</div>
@endhasanyrole
@endhasanyrole
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg0"><i class="fa fa-sticky-note"></i></span>
        <div class="dash-widget-info text-right">
            <h3><i class="fa fa-sticky-note"></i></h3>
            <span class="widget-title0"><a href="/inventory_reports/all" style="color: rgb(250, 249, 249);">Inventory Reports</a></span>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg0"><i class="fa fa-sticky-note"></i></span>
        <div class="dash-widget-info text-right">
            <h3><i class="fa fa-sticky-note"></i></h3>
            <span class="widget-title0"><a href="/cycle_amount_inventory" style="color: rgb(250, 249, 249);">Cycle Amount Inventory</a></span>
        </div>
    </div>
</div>
</div>



@endsection



@section('scripts')
    
@endsection
