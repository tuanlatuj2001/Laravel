@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6" style="text-align: center;background:lightblue;">
        <h4><a href="" style="color:black">Locations</a></h4>
    </div>
    <div class="col-md-6" style="text-align: center;">
        <h4><a href="" style="color:black"></a></h4>
    </div>
</div>
<div id="content" class="container-fluid">
    <div class="card">

        <div class="card-header font-weight-bold">
            New Location
        </div>
        <div class="row">

            <div class="card-body col-6">
                <form action="{{url('admin/location/update',$location->id)}}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Location Name</span>
                        </div>
                        <input type="text" name="location_name" class="form-control "
                            value="{{$location->location_name}}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Notes</span>
                        </div>
                        <textarea class="form-control" name="note">{{$location->location_name}}</textarea>
                    </div>

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Deparment</span>
                        </div>
                        <select class="form-control" id="deparment_id" name="deparment_id">
                            <option value="">Select Deparmant</option>
                            @foreach ($data as $d)
                            <option value="{{ $d->id }}" {{ $location->deparment_id == $d->id ? 'selected' : '' }}
                                >{{ $d->deparment_name }}</option>
                            @endforeach
                        </select>
                    </div>
@foreach($deparment as $d)
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Floor</span>
                        </div>
                        <input disabled type="text" name="floor" class="form-control" id="floor" value="{{$d->floor}}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Until</span>
                        </div>
                        <input disabled type="text" name="until" class="form-control" id="until" value="{{$d->until}}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Building</span>
                        </div>
                        <input disabled type="text" name="building" class="form-control" id="building" value="{{$d->building}}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Strest Address</span>
                        </div>
                        <input disabled type="text" name="street" class="form-control" id="street" value="{{$d->street}}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">State</span>
                        </div>
                        <input disabled type="text" name="state" class="form-control" id="state" value="{{$d->state}}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Zip Code</span>
                        </div>
                        <input disabled type="text" name="zipcode" class="form-control" id="zipcode" value="{{$d->zipcode}}">
                    </div>

                @endforeach
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <button type="submit" name="add_location" value="add" class="btn btn-primary">Update
                        Location</button>
                        <button type="button" onclick="window.history.back()" class="btn btn-primary">Cancel</button>
            </div>
            </form>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>



    $(document).ready(function () {
        $('#deparment_id').on('change', function () {
            var deparment = $(this).val();
           
            var url = 'http://127.0.0.1/api/get-deparments/'+deparment;
            // $("#result").html("Không có dữ liệu hoặc dữ liệu không hợp lệ."+url);
    
            // Gửi yêu cầu Ajax
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'GET',
                
                success: function (data) {
                    $('#floor').val('');
                    $('#until').val('');
                    $('#building').val('');
                    $('#street').val('');
                    $('#state').val('');
                    $('#zipcode').val('');

                    $.each(data, function (key, value) {
                    $('#floor').val($("#floor").val()+value.floor);
                    $('#until').val($("#until").val()+value.until);
                    $('#building').val($("#building").val()+value.building);
                    $('#street').val($("#street").val()+value.street);
                    $('#state').val($("#state").val()+value.state);
                    $('#zipcode').val($("#zipcode").val()+value.zipcode);
                    });
                }
            });
           
        });
    });
</script>
@endsection