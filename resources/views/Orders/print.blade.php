<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
  <meta charset="utf-8">
 <title>Print</title>
  <link href="labels.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


  <style>
  body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}

page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}


@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
  
}

  </style>

</head>

<body>
    <page size="A4" layout="landscape">
                <div class="row">
                    <div style="margin-left:4%;margin-top:4%" >
                    <b>Date Of Invoice</b>: &nbsp;{{ $patient_data[0]->date_of_service }}<br>
                    <b>Tray Number</b>: &nbsp;{{ $patient_data[0]->tray_number }}<br>
                    <b>Patient Name</b>: &nbsp;{{ $patient_data[0]->patient_name }}<br>
                    <b>Type</b>: &nbsp;{{ $get_prescription[0]->type }}<br>
                    </div>
                    <div  style="margin-left:54%; margin-top:-2cm"><b>Vendor Name</b>: &nbsp;{{ $vendor_name[0]->name }}<br>
                    <b>Tracking Numbers</b>: &nbsp;{{ $edit_order_head[0]->tracking_numbers }}<br>
                    <b>Order Numbers</b>: &nbsp;{{ $edit_order_head[0]->lens_order_number }}<br>
                    <b>Frame Model</b>: &nbsp;{{ $order_data[0]->brand_name }}({{$order_data[0]->model_name}})<br>
                    <b>Frame Order Numbers</b>: &nbsp;{{ $edit_order_head[0]->frame_order_number }}<br>
                    </div>
                 </div>
                 
                  
             
                   
                  
                   
                        <hr>
                        
                        <div class="table-responsive" style="margin-left: 3%; margin-right:3%">
                            <label style="font-weight: bolder">Orders Details</label>
                            <br>
                  <label for="" style="font-weight: bold"> Right Eye:</label>
                   <br>
                    <table border="1" class="table">
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
                <label for="" style="font-weight: bold">Left Eye:</label>
                   <br>
                    <table border="1" class="table">
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
                    <div style="margin-left: 3%">
                        <table>
                          <tr>
                            <td><b>Staff Notes</b></td><td>{{  $order_data[1]->staff_notes }}</td>
                          </tr>
                          <tr>
                            <td><b>Frame Status:</b></td><td>{{  $order_data[1]->frame_status }}</td>
                          </tr>
                          <tr>
                            <td><b>Order Status:</b></td><td>{{  $order_data[1]->order_status }}</td>
                          </tr>
                      </table>
                      </div>
               
                        
               
                  
                </div>
                
            </div>
    
       
        </page>     
   
</body>

</html>
 