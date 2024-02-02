@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="text-align: center;">
            <h4><a href="{{url('admin/user/list')}}" style="color:black">Users</a></h4>
        </div>
        <div class="col-md-6" style="text-align: center;background:lightblue;">
            <h4><a href="{{url('admin/role/list')}}" style="color:black">Roles</a></h4>
        </div>
    </div>
    <div class="card">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">

            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword"
                        value="{{ request()->input('keyword') }}">
                    <input type="submit" name="btn-search" value="Tìm " class="btn btn-primary">
                </form>
            </div>
            @canany('role.create')
            <a class="btn btn-primary" href="{{url('admin/role/add')}}">New Role</a>
@endcanany
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td><a href="{{ route('role.edit', $role->id) }}">{{ $role->name }}</a></td>
                        <td>{{ $role->description }}</td>
                        <td>
                        @canany('role.edit')
                            <a href="{{route('role.edit',$role->id)}}"
                                class="btn btn-primary btn-sm rounded-0">Edit</a>
                        @endcanany
                        @canany('role.create')
                            <a href="{{route('role.copy',$role->id)}}"
                                class="btn btn-primary btn-sm rounded-0">Cpoy</a>
                        @endcanany
                        @canany('role.delete')
                            <a href="{{ route('role.delete', $role->id) }}"
                                class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                data-placement="top" title="Delete"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')">Delete</a>
                            @method('delete')
                        @endcanany
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection