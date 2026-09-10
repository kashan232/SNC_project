@extends('backend.layouts.master')
@section('title','E-SHOP || Outlets Page')
@section('main-content')
<div class="card shadow mb-4">
  <div class="row">
      <div class="col-md-12">
         @include('backend.layouts.notification')
      </div>
  </div>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Outlets List</h6>
    <a href="{{route('outlet.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Outlet"><i class="fas fa-plus"></i> Add Outlet</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Name</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($outlets as $outlet)
            <tr>
                <td>{{$outlet->id}}</td>
                <td>{{$outlet->name}}</td>
                <td>{{$outlet->address}}</td>
                <td>
                    @if($outlet->status=='active')
                        <span class="badge badge-success">{{$outlet->status}}</span>
                    @else
                        <span class="badge badge-warning">{{$outlet->status}}</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('outlet.edit',$outlet->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('outlet.destroy',[$outlet->id])}}">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{$outlet->id}}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection