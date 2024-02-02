@extends('layouts.admin')
@section('content')
<div class="row">

    <div class="col-md-6" style="text-align: center;background:lightblue;">
        <h4><a href="" style="color:black">Assets</a></h4>
    </div>
    <div class="col-md-6" style="text-align: center;">
        <h4><a href="{{url('admin/asset/qr')}}" style="color:black">QR Codes</a></h4>
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
    
    @canany('asset.create')
    <a class="btn btn-primary" href="{{url('admin/asset/create')}}">New Asset</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Import Asset
    </button>
    @endcanany
</div>
<table class="table table-striped table-checkall">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">CODE</th>
            <th scope="col">NAME</th>
            <th scope="col">LOACTION</th>
            <th scope="col">CONDITION</th>
            <th scope="col">PURCHASE</th>
            <th scope="col">PRICE</th>
            <th scope="col">NOTES</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @php
        $t = 0;
        @endphp
        @foreach ($data as $asset)
        @php
        $t++;
        @endphp
        <tr class="">
            <td>{{ $t }}</td>
            <td>{{ $asset->code }}</td>
            <td>{{$asset->asset_name }}</td>
            <td>{{$asset->location_name}}</td>
            @php
            if($asset->condition==0){
            echo"<td>NONE-EXISTENT</td>";
            }elseif($asset->condition==1){
            echo"<td>VERY GOOD</td>";
            }elseif($asset->condition==2){
            echo"<td>GOOD</td>";
            }elseif($asset->condition==3){
            echo"<td>FAIR</td>";
            }elseif($asset->condition==4){
            echo"<td>REQUIRES RENEWAL</td>";
            }else{
            echo"<td>UNSERVICEABLE</td>";
            }

            @endphp
            <td>Date: {{$asset->created_at}} <br>Warranty: {{$asset->warranty}}m
                <br>Model: {{$asset->modele_name}} <br>Serial: {{$asset->serial}}
                <br>Vendor: {{$asset->supplier_name}}
            </td>
            <td>{{number_format($asset->price, 0, ',', ',')}}</td>
            <td>{{$asset->note}}</td>
            @canany('asset.edit')
            <td>
                <a href="{{url('admin/asset/edit',$asset->id)}}" class="btn btn-primary btn-sm rounded-0">Edit</a>
            </td>
            @endcanany
            <td>
            <a href="{{url('admin/asset/print',$asset->id)}}" class="btn btn-primary btn-sm rounded-0">Print</a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $data->links() }}

@include('admin.modal.asset_modal')
@endsection