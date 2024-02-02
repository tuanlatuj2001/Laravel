@extends('layouts.admin');

@section('content')

<div class="container-fluid py-5">
    <div>
        <h3>Dashboard</h3>
    </div>
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">User</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text" style="height: 30px">{{$cUser}}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Asset</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text" style="height: 30px">{{$cAsset}}</p>
                </div>
            </div>
        </div>

        <div class="col">

        </div>
        <div class="col">
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            User
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">NAME</th>
                        <th scope="col">LOCATION</th>
                        <th scope="col">ROLE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($u as $user)
                    <tr>
                        <th>{{$user->id}} </th>
                        <td>{{$user->email}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->location_name}}</td>
                        <td>
                            @foreach ($user->roles as $role)
                            <span class="badge badge-warning">{{ $role->name }}</span>
                            @endforeach
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold">
            Asset
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CODE</th>
                        <th scope="col">NAME</th>
                        <th scope="col">LOCATION</th>
                        <th scope="col">CONDITION</th>
                        <th scope="col">PURCHASE</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">NOTES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($a as $asset)

                    <tr>
                        <th>{{$asset->id}} </th>
                        <td>{{$asset->code}}</td>
                        <td>{{$asset->code}}</td>
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


                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection