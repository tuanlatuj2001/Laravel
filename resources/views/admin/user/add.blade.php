@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6" style="text-align: center;background:lightblue;">
        <h4><a href="" style="color:black">Users</a></h4>
    </div>
    <div class="col-md-6" style="text-align: center;">
        <h4><a href="{{url('admin/role/list')}}" style="color:black">Roles</a></h4>
    </div>
</div>
<div id="content" class="container-fluid">
    <div class="card">

        <div class="card-header font-weight-bold">
            New User
        </div>
        <div class="row">

            <div class="card-body col-6">
                <form action="{{route('user.add')}}" method="POST">

                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Name</span>
                        </div>
                        <input type="text" name="name" class="form-control ">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email</span>
                        </div>
                        <input type="email" name="email" class="form-control ">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Role</span>
                        </div>
                        <select class="form-control" id="roles" name="roles">
                            <option value="">Select Role</option>
                            @foreach ($roles as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Location</span>
                        </div>
                        <select class="form-control" id="location" name="location_id">
                            <option value="">Select Location</option>
                            @foreach ($location as $l)
                            <option value="{{ $l->id }}">{{ $l->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3" id="deparment">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Deparment</span>
                        </div>
                        <input disabled type="text" name="depament_name" class="form-control" id="deparment_name" value="">
                           
                
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Floor</span>
                        </div>
                        <input disabled type="text" name="floor" class="form-control" id="floor" value="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Until</span>
                        </div>
                        <input disabled type="text" name="until" class="form-control" id="until" value="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Building</span>
                        </div>
                        <input disabled type="text" name="building" class="form-control" id="building" value="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Strest Address</span>
                        </div>
                        <input disabled type="text" name="street" class="form-control" id="street" value="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">State</span>
                        </div>
                        <input disabled type="text" name="state" class="form-control" id="state" value=""> 
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Zip Code</span>
                        </div>
                        <input disabled type="text" name="zipcode" class="form-control" id="zipcode" value="">
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
                    <button type="submit" name="add_location" value="add" class="btn btn-primary">Create
                        User</button>
                    <button type="button" onclick="window.history.back()" class="btn btn-primary">Cancel</button>
            </div>
            <div id="abc">

            </div>
            </form>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#location').on('change', function () {
            var location = $(this).val();
            var url = 'http://127.0.0.1/api/get-deparments/'+location;
           
            
            // Gửi yêu cầu Ajax
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'GET',
             
                success: function (data) {
                    $('#deparment_name').val("");
                    $('#floor').val("");
                    $('#until').val("");
                    $('#building').val("");
                    $('#street').val("");
                    $('#state').val("");
                    $('#zipcode').val("");
                     $.each(data, function (key, value) {
                    //  $("#abc").html("Không có dữ liệu hoặc dữ liệu không hợp lệ."+ value.deparment_name);
                     $("#deparment_name").val($("#deparment_name").val() + value.deparment_name);
                     $("#floor").val($("#floor").val() + value.floor);
                     $("#until").val($("#until").val() + value.until);
                     $("#building").val($("#building").val() + value.building);
                     $("#street").val($("#street").val() + value.street);
                     $("#state").val($("#state").val() + value.state);
                     $("#zipcode").val($("#zipcode").val() + value.zipcode);
                });
                }
            });
           
        });
    });
</script>

@endsection