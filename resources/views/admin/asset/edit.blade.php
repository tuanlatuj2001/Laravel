@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">

        <div class="card-header font-weight-bold">
            Edit Asset
        </div>
        <div class="row">

            <div class="card-body col-12">
                <form action="{{url('admin/asset/update',$asset->id)}}" method="POST">
                    @csrf
                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Name</span>
                        </div>
                        <input type="text" name="asset_name" class="form-control" value="{{$asset->asset_name}}">
                    </div>

                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Category</span>
                        </div>
                        <select class="form-control" id="" name="categorie_id">
                            <option value="">Select Catagory</option>
                            @foreach ($catagorie as $c)
                            <option value="{{ $c->id }}" {{ $asset->categorie_id  == $c->id ? 'selected' : '' }}>
                                            {{ $c->catagorie_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Location</span>
                            </div>
                            <select class="form-control" id="location" name="location_id">
                                <option value="">Select Location</option>
                                @foreach ($location as $l)
                                <option value="{{ $l->id }}" {{ $asset->location_id == $l->id ? 'selected' : '' }}>{{ $l->location_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3 col-6 ">
                            <div class="input-group-prepend" id="deparment">
                            
                            </div>
                        </div>
                    </div>
                   
                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Condition</span>
                        </div>
                        <select class="form-control" id="" name="condition">
                            <option value="">Select Condition</option>
                          
                            <option value="0" {{$asset->condition== 0 ? 'selected' : '' }}>NONE-EXISTENT (Asset abandoned or no longer exists)</option>
                            <option value="1" {{$asset->condition== 1 ? 'selected' : '' }}>VETY GOOD (Only normal maintenace required)</option>
                            <option value="2" {{$asset->condition== 2 ? 'selected' : '' }}>GOOD (Minor maintenace required 5%)</option>
                            <option value="3" {{$asset->condition== 3 ? 'selected' : '' }}>FAIR (Signficant maintenace required 10-20%)</option>
                            <option value="4" {{$asset->condition== 4 ? 'selected' : '' }}>FAIR (Signficant renewal/upgrade required 20-40%)</option>
                            <option value="5" {{$asset->condition== 5 ? 'selected' : '' }}>UNSERVICEABLE (Over 50% of asset required replacement)</option>
            
                        </select>
                    </div>
                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Note</span>
                        </div>
                        <textarea class="form-control" name="note">{{$asset->note}}</textarea>
                    </div>
                    <p>Purchase Information</p>
                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Manufacturer</span>
                        </div>
                        <select class="form-control"  name="manufacturer_id" id="manufacturer">
                            <option value="">Select Manufacturer</option>
                            @foreach ($manufacturer as $m)
                            <option value="{{ $m->id }}" {{ $asset->manufacturer_id == $m->id ? 'selected' : '' }}>{{ $m->manufacturer_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Model</span>
                        </div>
                        <select class="form-control" id="model" name="modele_id">
                            <option value="">Select Model</option>
                           
                        </select>
                    </div>
                    <div class="input-group mb-3 col-6">
                       <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Serial</span>
                        </div>
                        <input type="text" name="serial" class="form-control " value="{{$asset->serial}}">
                    </div>
                    <div class="input-group mb-3 col-6">
                       <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Warranty</span>
                        </div>
                        <input type="text" name="warranty" class="form-control "value="{{$asset->warranty}}">
                    </div> 
                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Price</span>
                        </div>
                        <input type="text" name="price" class="form-control " value="{{$asset->price}}">
                    </div>
                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Supplier</span>
                        </div>
                        <select class="form-control"  name="supplier_id" >
                            <option value="">Select Supplier</option>
                            @foreach ($supplier as $s)
                            <option value="{{ $s->id }}" {{ $asset->supplier_id == $s->id ? 'selected' : '' }}>{{ $s->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <button type="submit" name="add_location" value="add" class="btn btn-primary">Save</button>
                    <button type="button" onclick="window.history.back()" class="btn btn-primary">Cancel</button>
            </div>
            
            </form>
        
        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function () {
        $('#manufacturer').on('change', function () {
            var manufacturer = $(this).val();
           
            var url = 'http://127.0.0.1/api/get-models/'+manufacturer;
           
    
            // Gửi yêu cầu Ajax
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'GET',
             
                success: function (data) {
                    $('#model').empty();
                    $.each(data, function (key, value) {
                    $('#model').append('<option value="' +  value.id + '">' + value.modele_name + '</option>');
                    });
                }
            });
           
        });
    });

    $(document).ready(function () {
        $('#manufacturer').on('change', function () {
            var manufacturer = $(this).val();
           
            var url = 'http://127.0.0.1/api/get-models/'+manufacturer;
           
    
            // Gửi yêu cầu Ajax
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'GET',
             
                success: function (data) {
                    $('#model').empty();
                    $.each(data, function (key, value) {
                    $('#model').append('<option value="' +  value.id + '">' + value.modele_name + '</option>');
                    });
                }
            });
           
        });
    });$(document).ready(function () {
        $('#location').on('change', function () {
            var location = $(this).val();
           
            var url = 'http://127.0.0.1/api/get-deparments/'+location;
           
            
            // Gửi yêu cầu Ajax
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'GET',
             
                success: function (data) {
                      $('#deparment').empty();
                     $.each(data, function (key, value) {
                    // $("#deparment").html("Không có dữ liệu hoặc dữ liệu không hợp lệ."+data[0].deparment_name);
                    $('#deparment').append('<p>' + value.deparment_name+
                    '- Building:'+ value.building+', street:'+value.street+
                    ', City:'+value.city+'</p>');
                });
                }
            });
           
        });
    });
</script>


@endsection