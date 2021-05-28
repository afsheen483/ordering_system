{{-- <html lang="en">

<head>
  <meta charset="utf-8">
  <title>Print Lable</title>
  <link href="labels.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

  <style>
    body {
      width: 8.89cm; 
        margin: 0in .1875in;
        }
    .label{
        /* Avery 5160 labels -- CSS and HTML by MM at Boulder Information Services */
        width: 8.89cm; /* plus .6 inches from padding */
        height: 2.77cm; /* plus .125 inches from padding */
        padding: .125in .3in 0;
        margin-right: .125in; /* the gutter */

        float: left;

        text-align: center;
        overflow: hidden;

        outline: 1px dotted; /* outline doesn't occupy space like border does */
        }
    .page-break  {
        clear: left;
        display:block;
        page-break-after:always;
        }
      
  </style>

</head>

<body>
<br>
  @foreach ($patient_data as $data)
  <div class="label">
   
    <br> Patient Name:   {{ $data->patient_name }}
    <br> Order Data:     {{ $data->date }}
    <br> Frame:          {{ $data->model_name }}
    <br> Tray Number:    {{ $data->tray_number }}
    <br>
  </div>
  @endforeach
 
  <div class="page-break"></div>

</body>

</html>
 --}}
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

 <title>Print Lable</title>
 <style>
 body {
  background: rgb(204,204,204); 
  font-size: 20px !important
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
 
}
page[size="A4"] {  
  width: 8.9cm;
  height: 2.8cm; 
 
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
table{
  font-size: 20px !important
}

  </style>
 
 </head>
 
 <body>
  <div class="book">
  @foreach ($patient_data as $data)
     {{-- <div class="label"><b>Patient Name: </b> {{ $data->patient_name }}<b></br>Order Date:</b>{{ $data->date }}</br><b>Frame:</b>{{ $data->model_name }}</br><b>Tray Number:</b>{{ $data->tray_number }}</div> --}}
     
     <page size="A4">     
            {{-- <b>Patient Name: </b> {{ $data->patient_name }}<b></br>Order Date:</b>{{ $data->date }}</br><b>Frame:</b>{{ $data->model_name }}</br><b>Tray Number:</b>{{ $data->tray_number }} --}}
           <div > 
           
            <table border="1" class="table" >
                {{-- <thead>
                    <tr>
                        <th>Date</th>
                        <th>Brand</th>
                        <th>Patient Name</th>
                    </tr>
                </thead> --}}
                <tbody>
                    <tr style="text-align:center">
                        <td >{{ date('m-d', strtotime($data->date_of_service))}}</td>
                        <td >{{ $data->brand_name }}</td>
                       
                        
                    </tr>
                    <tr style="text-align:center">
                        <td  colspan="2"> {{ $data->patient_name }}</td>
                    </tr>
                </tbody>
              
            </table>
           
               
                    </div> 
               
           
       </page>
 

     @endforeach
    </div>
     {{-- <div class="label page-break"><b>Title </b></br>Fname Lname</br>Media Type</br>200x500 cm</br>1958</div> --}}
 </body>
 </html>