@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6" style="text-align: center;background:lightblue;">
        <h4><a href="" style="color:black">Locations</a></h4>
    </div>
    <div class="col-md-6" style="text-align: center;">
        <h4><a href="" style="color:black">Deparments</a></h4>
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
    @canany('location.create')
    <a class="btn btn-primary" href="{{url('admin/location/create')}}">New Loctions</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Import Location
    </button>
    @endcanany
</div>
<table class="table table-striped table-checkall">
    <thead>
        <tr>
            <th scope="col">NO</th>

            <th scope="col">NAME</th>
            <th scope="col">ADDRESS</th>
            <th scope="col">NOTES</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($data as $loc)

        <tr class="">

            <td>{{ $loc->id }}</td>
            <td>{{ $loc->location_name }}</td>
            <td>{{ $loc->building }}, {{ $loc->street }}, {{ $loc->city }}, {{ $loc->state }}, {{ $loc->countrie_name }}
            </td>
            <td>{{ $loc->note }}</td>
            <td>
                @canany('location.edit')
                <a href="{{url('admin/location/edit',$loc->id)}}" class="btn btn-primary btn-sm rounded-0">Edit</a>
                @endcanany
                @canany('location.create')
                <a href="{{url('admin/location/copy',$loc->id)}}" class="btn btn-primary btn-sm rounded-0">Cpoy</a>
                @endcanany
                @canany('location.delete')
                <a href="{{url('admin/location/delete',$loc->id)}}" class="btn btn-danger btn-sm rounded-0 text-white"
                    type="button" data-toggle="tooltip" data-placement="top" title="Delete"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')">Delete</a>

                @method('delete')
                @endcanany
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $data->links() }}

@include('admin.modal.location_modal')
@endsection