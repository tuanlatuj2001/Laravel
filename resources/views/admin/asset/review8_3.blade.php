<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.tiny.cloud/1/78btwo285kckdrzlosmbky5jwp9exe5ous8jpxy0crajl3uf/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <style type="text/css" media="print">
        #print_button {
            display: none;
         
        }
    </style>
</head>
<body>
    
    <div class="row">
    @for($i = 0; $i < 24; $i++)
    <div class="row col-3" style=" border: 1px solid black; margin-left:70px; margin-bottom:20px;">
    <div class="col-8 ">
            @if(array_key_exists('asset_name',$data))
            <strong style="font-size:10px;">{{$data['asset_name']}}</strong>
            @endif
            @if(array_key_exists('code',$data))
            <p style="font-size:10px;">Asset Code: {{$data['code']}} </p>
            @endif
            @if(array_key_exists('date',$data))
            <p style="font-size:10px;">Date Purchased: {{$data['date']}}</p>
            @endif
            @if(array_key_exists('warranty',$data))
            <p style="font-size:10px;">Warranty: {{$data['warranty']}}m</p>
            @endif
            @if(array_key_exists('vendor',$data))
            <p style="font-size:10px;">Vendor: {{$data['supplier_name']}}</p>
            @endif
            @if(array_key_exists('model',$data))
            <p style="font-size:10px;">Model/Serial: {{$data['model']}} / {{$data['serial']}}</p>
            @endif
            @if(array_key_exists('deparment',$data))
            <p style="font-size:10px;">Location/Deparment: {{$data['location']}} / {{$data['deparment']}}</p>
            @endif
        </div>
        <div class="col-1 " >
        @if(array_key_exists('qr',$data))
            <div style="margin-top:50px;margin-bottom: 25px;">{!!QrCode::size(60)->generate($data['qr'])!!}</div>
        @endif
        </div>
    </div>
        
    
    @endfor
    </div>
    <div class="col-12 d-flex justify-content-center">
    <input type="button" class="btn- btn-primary" id="print_button" value="Print" onclick="window.print()" />
</div>
</body>
</html>



    


