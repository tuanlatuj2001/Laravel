@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6" style="text-align: center;">
        <h4><a href="{{url('admin/asset/list')}}" style="color:black">Assets</a></h4>
    </div>
    <div class="col-md-6" style="text-align: center;background:lightblue;">
        <h4><a href="" style="color:black">QR Codes</a></h4>
    </div>
</div>
<div class="card-header font-weight-bold d-flex justify-content-between align-items-center">

    <div class="form-search form-inline">
        <form action="#">
            <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword"
                value="{{ request()->input('keyword') }}">
            <input type="submit" name="btn-search" value="Tìm " class="btn btn-primary">
        </form>
    </div>
    <a class="btn btn-primary" href="{{url('admin/location/create')}}">PRINT LABEL</a>
</div>
@foreach($data as $qr)
<div class="row" style=" border: 1px solid black; margin:30px;">
    <div class="col-sm-8">
        <strong>{{$qr->asset_name}}</strong>
        <p>Asset Code: {{$qr->code}} </p>
        <p>Date Purchased: {{$qr->created_at}}</p>
        <p>Warranty: {{$qr->warranty}}m</p>
        <p>Vendor: {{$qr->supplier_name}}</p>
        <p>Model/Serial: {{$qr->modele_name}} / {{$qr->serial}}</p>
        <p>Location/Deparment: {{$qr->location_name}} / {{$qr->deparment_name}}</p>

    </div>
    <div class="col-sm-4">
        <div style="margin-top:50px;margin-bottom: 25px;">{!!QrCode::size(120)->generate($qr->asset_code)!!}</div>
        <a href="{{url('admin/asset/qr',$qr->id)}}"><button class="btn btn-primary">Change Code</button></a>
    </div>
</div>
@endforeach
{{ $data->links() }}
@endsection