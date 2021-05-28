<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
  <meta charset="utf-8">
 <title>Print Orders</title>
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
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
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
 
  @for ($i = 0; $i < $count_rows - 1 ; $i++)
      
 <page size="A4" layout="landscape">            
              <div class="row">
                <div style="margin-left:4%;margin-top:4%" >
                <b>Date Of Invoice</b>: &nbsp;{{ $patient_data[$i]->date_of_service }}<br>
                <b>Tray Number</b>: &nbsp;{{ $patient_data[$i]->tray_number }}<br>
                <b>Patient Name</b>: &nbsp;{{ $patient_data[$i]->patient_name }}<br>
                <b>Type</b>: &nbsp;{{ $patient_data[$i]->type }}<br>
                </div>
                <div  style="margin-left:54%; margin-top:-2cm"><b>Vendor Name</b>: &nbsp;{{ $patient_data[$i]->name }}<br>
                <b>Tracking Numbers</b>: &nbsp;{{ $patient_data[$i]->tracking_numbers }}<br>
                <b>Order Numbers</b>: &nbsp;{{ $patient_data[$i]->lens_order_number }}<br>
                <b>Frame Model</b>: &nbsp;{{ $patient_data[$i]->brand_name }}&nbsp;({{$patient_data[$i]->model_name}})<br>
                <b>Frame Order Numbers</b>: &nbsp;{{ $patient_data[$i]->frame_order_number }}<br>
                </div>
             </div>
             
                 
                  
             
                   
                  

                      
               
           
                        <hr>
                  <div style="margin-left:3%;margin-right:3%">
                        <label style="font-weight: bolder">Orders Details</label>
                        <div class="table-responsive">
                  <label for="" style="font-weight: bold">Eye:</label>
                   <br>
                    <table border="1" class="table">
                        <thead >
                            <tr>
                                <th>Eye</th>
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
                            {{-- @if ($i%2==0) --}}
                                <tr>
                                  <td>{{ $patient_data[$i]->eye }}</td>
                                  <td>{{ $patient_data[$i]->sph }}</td>
                                  <td>{{ $patient_data[$i]->cyl }}</td>
                                  <td>{{ $patient_data[$i]->axis }}</td>
                                  <td>{{ $patient_data[$i]->add }}</td>
                                  <td>{{ $patient_data[$i]->pd }}</td>
                                  <td>{{ $patient_data[$i]->ph }}</td>
                                  <td>{{ $patient_data[$i]->lenses }}</td>
                                  <td>@if ($patient_data[$i]->coating->coating == 'Select')
                                    {{ '' }}
                                @else
                                {{ $patient_data[$i]->coating->coating }}
                                @endif</td>
                                <td>@if ( $patient_data[$i]->coating2->coating  == 'Select')
                                    {{ '' }}
                                @else
                                {{ $patient_data[$i]->coating2->coating }}
                                @endif</td>
                                <td>@if ( $patient_data[$i]->coating3->coating  == 'Select')
                                    {{ '' }}
                                @else
                                {{ $patient_data[$i]->coating3->coating }}
                                @endif</td>
                                <td>@if ( $patient_data[$i]->coating4->coating  == 'Select')
                                    {{ '' }}
                                @else
                                {{ $patient_data[$i]->coating4->coating }}
                                @endif</td>
                              
                                  <td>{{ $patient_data[$i]->a }}</td>
                                  <td>{{ $patient_data[$i]->b }}</td>
                                  <td>{{ $patient_data[$i]->dbl }}</td>
                                  <td>{{ $patient_data[$i]->ed }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                  
                        
                                <tr>
                                    <td>{{ $patient_data[$i]->eye }}</td>
                                    <td>{{ $patient_data[$i]->sph }}</td>
                                    <td>{{ $patient_data[$i]->cyl }}</td>
                                    <td>{{ $patient_data[$i]->axis }}</td>
                                    <td>{{ $patient_data[$i]->add }}</td>
                                    <td>{{ $patient_data[$i]->pd }}</td>
                                    <td>{{ $patient_data[$i]->ph }}</td>
                                    <td>{{ $patient_data[$i]->lenses }}</td>
                                    <td>@if ($patient_data[$i]->coating->coating == 'Select')
                                        {{ '' }}
                                    @else
                                    {{ $patient_data[$i]->coating->coating }}
                                    @endif</td>
                                    <td>@if ( $patient_data[$i]->coating2->coating  == 'Select')
                                        {{ '' }}
                                    @else
                                    {{ $patient_data[$i]->coating2->coating }}
                                    @endif</td>
                                    <td>@if ( $patient_data[$i]->coating3->coating  == 'Select')
                                        {{ '' }}
                                    @else
                                    {{ $patient_data[$i]->coating3->coating }}
                                    @endif</td>
                                    <td>@if ( $patient_data[$i]->coating4->coating  == 'Select')
                                        {{ '' }}
                                    @else
                                    {{ $patient_data[$i]->coating4->coating }}
                                    @endif</td>
                                
                                    <td>{{ $patient_data[$i]->a }}</td>
                                    <td>{{ $patient_data[$i]->b }}</td>
                                    <td>{{ $patient_data[$i]->dbl }}</td>
                                    <td>{{ $patient_data[$i]->ed }}</td>
                                </tr>
                            {{-- @endif --}}
                            </tbody>
                    </table>
                    </div>
                  </div>
                  <br><br>
                 <div style="margin-left: 3%">
                  <table>
                    <tr>
                      <td><b>Staff Notes</b></td><td>{{  $patient_data[$i]->staff_notes }}</td>
                    </tr>
                    <tr>
                      <td><b>Frame Status:</b></td><td>{{  $patient_data[$i]->frame_status }}</td>
                    </tr>
                    <tr>
                      <td><b>Order Status:</b></td><td>{{  $patient_data[$i]->order_status }}</td>
                    </tr>
                </table>
                </div>
                  
                </div>      
            </div>
        </page> 
        

        @endfor
    
</body>

</html>
 