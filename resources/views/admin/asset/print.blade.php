@extends('layouts.admin')
@section('content')
<form action="{{url('admin/asset/review')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-5">
            <p>Please field to be printed on label:</p>
            <table style=" border: 1px solid black; margin:30px;">
                <tbody>
                    @foreach($asset as $a)
                    <tr>
                        <td>Asset name</td>
                        <td><input type="checkbox" name="asset_name" value="{{$a['asset_name']}}"></td>
                    </tr>
                    <tr>
                        <td>Asset code</td>
                        <td><input type="checkbox" name="code" value="{{$a['code']}}"></td>
                    </tr>
                    <tr>
                        <td>Date Purchase</td>
                        <td><input type="checkbox" name="date" value="{{$a['created_at']}}"></td>
                    </tr>
                    <tr>
                        <td>Warranty</td>
                        <td><input type="checkbox" name="warranty" value="{{$a['warranty']}}"></td>
                    </tr>
                    <tr>
                        <td>Vendor</td>
                        <td><input type="checkbox" name="vednor" value="{{$a['supplier_name']}}"></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><input type="checkbox" name="model" value="{{$a['modele_name']}}"></td>
                    </tr>
                    <tr>
                        <td>Serial</td>
                        <td><input type="checkbox" name="serial" value="{{$a['serial']}}"></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td><input type="checkbox" name="location" value="{{$a['location_name']}}"></td>
                    </tr>
                    <tr>
                        <td>Deparment</td>
                        <td><input type="checkbox" name="deparment" value="{{$a['deparment_name']}}"></td>
                    </tr>
                    <tr>
                        <td>QR Code</td>
                        <td><input type="checkbox" name="qr" value="{{$a['asset_code']}}"></td>
                    </tr>

                    @endforeach


                </tbody>
            </table>
            </div>
            <div class="col-5">
                <p>Please select layout:</p>
                <div class="row">
                    <div>

                        <label for="html"><img src="{{asset('img/52.PNG')}}"  width='150px' height='200px' alt=""></label><br>
                        <input type="radio" id="html" name="layout" value="5x2" checked style="margin-left: 70px;">
                    </div>
                    <div>
                          <label for="css"><img src="{{asset('img/73.PNG')}}"  width='150px' height='200px' alt=""></label><br>
                          <input type="radio" id="css" name="layout" value="7x3" style="margin-left: 70px;">
                    </div>
                      <div>

                          <label for="css"><img src="{{asset('img/83.PNG')}}"  width='150px' height='200px' alt=""></label><br>
                          <input type="radio" id="css" name="layout" value="8x3" style="margin-left: 70px;">
                    </div>
                </div>
            </div>
        
    </div>


    <button type="submit" name="add_location" value="add" class="btn btn-primary">Print</button>
</form>
@endsection