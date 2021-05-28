@extends('layouts.master')

@section('title')
    Orders Details
@endsection

@section('headername')
    Orders Details
@endsection

@section('content')

  
        <div class="card">
            <div class="card-header row">
                @hasanyrole('admin|staff')
            <div class="btn-group" role="group" aria-label="Basic example" style="position: absolute; right: 2%;">
                <a href="/orders-list/all" class="btn btn-primary" style="margin-left: 12cm">Back</a>
                <a href="/orders_edit/{{ $edit_order_head[0]->id }}" class="btn btn-primary" >Edit</a>
                <a href="/orders_print/{{ $edit_order_head[0]->id }}" class="btn btn-primary" target="_blank">Print</a>
            </div>
            </div>
            @endhasanyrole
              <div class="col-md-6" >
                <h4 class="card-title">Shipped Orders Details</h4>
                <br>
              </div>
             
             @hasrole('vendor')
             <div class="col-md-6">
                <a href="/orders-list/all" class="btn btn-primary rounded" style="float: right; margin-left:2%" >Back</a>
              </div>
             @endhasrole
               
                <div class="row">
                    <div style="margin-left:2%" >
                    <b>Date Of Invoice</b>: &nbsp;{{ $patient_data[0]->date_of_service }}<br>
                    <b>Tray Number</b>: &nbsp;{{ $patient_data[0]->tray_number }}<br>
                    <b>Patient Name</b>: &nbsp;{{ $patient_data[0]->patient_name }}<br>
                    <b>Type</b>: &nbsp;{{ $get_prescription[0]->type }}<br>
                    </div>
                    <div  style="margin-left:50%;"><b>Vendor Name</b>: &nbsp;{{ $vendor_name[0]->name }}<br>
                    <b>Tracking Numbers</b>: &nbsp;{{ $edit_order_head[0]->tracking_numbers }}<br>
                    <b>Order Numbers</b>: &nbsp;{{ $edit_order_head[0]->lens_order_number }}<br>
                    <b>Frame Model</b>: &nbsp;{{ $order_data[0]->brand_name }}({{$order_data[0]->model_name}})<br>

                    <b>Frame Order Numbers</b>: &nbsp;{{ $edit_order_head[0]->frame_order_number }}<br>
                    </div>
                    </div>
                 
                  
             
                   
                  
                    <div class="card-body">
                        <hr>
                        <label style="font-weight: bold">Orders Details</label>
                        <div class="table-responsive">
                   Right Eye:
                   <br>
                    <table class="table mb-0">
                        <thead >
                            <tr>
                                <th>Sph</th>
                                <th>Cyl</th>
                                <th>Axis</th>
                                <th>Add</th>
                                <th>PD</th>
                                <th>PH</th>
                                <th>Lens 
                                Type</th>
                                <th>Coating 1</th>
                                <th>Coating 2</th>
                                <th>Coating 3</th>
                                <th>Coating 4</th>
                                <th>A</th>
                                <th>B</th>
                                <th>DBL</th>
                                <th>ED</th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order_data[0]->sph }}</td>
                                    <td>{{ $order_data[0]->cyl }}</td>
                                    <td>{{ $order_data[0]->axis }}</td>
                                    <td>{{ $order_data[0]->add }}</td>
                                    <td>{{ $order_data[0]->pd }}</td>
                                    <td>{{ $order_data[0]->ph }}</td>
                                    <td>{{ $order_data[0]->lenses }}</td>
                                    <td>@if ( $order_data[0]->coating->coating == 'Select')
                                        {{ '' }}
                                        @else
                                        {{ $order_data[0]->coating->coating }}
                                        @endif</td>
                                    <td>@if ($order_data[0]->coating2->coating == 'Select')
                                        {{ '' }}
                                    @else
                                    {{ $order_data[0]->coating2->coating }}
                                    @endif</td>
                                    <td>@if ($order_data[0]->coating3->coating == 'Select')
                                        {{ '' }}
                                    @else
                                         {{ $order_data[0]->coating3->coating }}
                                    @endif</td>
                                    <td>@if ($order_data[0]->coating4->coating == 'Select')
                                        {{ '' }}
                                    @else
                                    {{ $order_data[0]->coating4->coating }}
                                    @endif</td>
                                
                                    <td>{{ $order_data[0]->a }}</td>
                                    <td>{{ $order_data[0]->b }}</td>
                                    <td>{{ $order_data[0]->dbl }}</td>
                                    <td>{{ $order_data[0]->ed }}</td>
                                </tr>
                            </tbody>
                    </table>
                    Left Eye:
                   <br>
                    <table class="table mb-0">
                        <thead >
                            <tr>
                                <th>Sph</th>
                                <th>Cyl</th>
                                <th>Axis</th>
                                <th>Add</th>
                                <th>PD</th>
                                <th>PH</th>
                                <th>Lens 
                                Type</th>
                                <th>Coating 1</th>
                                <th>Coating 2</th>
                                <th>Coating 3</th>
                                <th>Coating 4</th>
                                <th>A</th>
                                <th>B</th>
                                <th>DBL</th>
                                <th>ED</th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order_data[1]->sph }}</td>
                                    <td>{{ $order_data[1]->cyl }}</td>
                                    <td>{{ $order_data[1]->axis }}</td>
                                    <td>{{ $order_data[1]->add }}</td>
                                    <td>{{ $order_data[1]->pd }}</td>
                                    <td>{{ $order_data[1]->ph }}</td>
                                    <td>{{ $order_data[1]->lenses }}</td>
                                    <td>@if ( $order_data[1]->coating->coating == 'Select')
                                        {{ '' }}
                                        @else
                                        {{ $order_data[1]->coating->coating }}
                                        @endif</td>
                                    <td>@if ($order_data[1]->coating2->coating == 'Select')
                                        {{ '' }}
                                    @else
                                    {{ $order_data[1]->coating2->coating }}
                                    @endif</td>
                                    <td>@if ($order_data[1]->coating3->coating == 'Select')
                                        {{ '' }}
                                    @else
                                         {{ $order_data[1]->coating3->coating }}
                                    @endif</td>
                                    <td>@if ($order_data[1]->coating4->coating == 'Select')
                                        {{ '' }}
                                    @else
                                    {{ $order_data[1]->coating4->coating }}
                                    @endif</td>
                                    <td>{{ $order_data[1]->a }}</td>
                                    <td>{{ $order_data[1]->b }}</td>
                                    <td>{{ $order_data[1]->dbl }}</td>
                                    <td>{{ $order_data[1]->ed }}</td>
                                </tr>
                            </tbody>
                    </table>
                    </div>
                    <br><br>
                   <div class="col-6">
                    <label style="margin-left: 2%">Staff Notes</label><span style="margin-left: 7.8%">{{  $edit_order_head[0]->staff_notes }}</span>
                    <br>
                    @if ($order_data[1]->shippment_status == 'Shipped')
                    <label for="" style="margin-left: 2%">Frame Status:</label> <span style="margin-left: 3%" class="badge badge-success">{{ $edit_order_head[0]->frame_status }}</span>
                    @else
                    <label for="" style="margin-left: 2%">Frame Status:</label> <span style="margin-left: 3%" class="badge badge-warning">{{ $edit_order_head[0]->frame_status }}</span>

                    @endif
                <br>
                @if ($order_data[1]->order_status == 'Received')
                <label for="" style="margin-left: 2%">Order Status:</label> <span style="margin-left: 4%" class="badge badge-success">{{ $edit_order_head[0]->order_status }}</span>

                @else
                <label for="" style="margin-left: 2%">Order Status:</label> <span style="margin-left: 4%" class="badge badge-warning">{{ $edit_order_head[0]->order_status }}</span>

                @endif
                   </div>
               
                        <hr>
                        <div class="table-responsive">
                        <label for="" style="font-weight: bold">LOGS</label>
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                <th>Username</th>
                                <th>Action</th>
                                <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_logs as $order_log)
                                    <tr>
                                        <td>{{ $order_log->action }}</td>
                                        <td>{{ $order_log->name }}</td>
                                        <td>{{ date(' jS  F Y h:i A', strtotime($order_log->created_at))}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
               
                   </div>
                </div>
                
            </div>
    
     
               

@endsection

@section('scripts')
    
@endsection