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
<div class="card-header font-weight-bold d-flex justify-content-between align-items-center">

    <div class="form-search form-inline">
        <form action="#">
            <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword"
                value="{{ request()->input('keyword') }}">
            <input type="submit" name="btn-search" value="Tìm " class="btn btn-primary">
        </form>
    </div>
    @canany('user.create')
    <a class="btn btn-primary" href="{{url('admin/user/add')}}">New User</a>
    @endcanany
    </button>
</div>
<table class="table table-striped table-checkall">
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
        @php
        $t = 0;
        @endphp
        @foreach ($data as $user)
        <tr class="">
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->location_name }}</td>
            <td>
                @foreach ($user->roles as $role)
                <span class="badge badge-warning">{{ $role->name }}</span>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $data->links() }}

@include('admin.modal.location_modal')
@endsection