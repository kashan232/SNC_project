@extends('backend.layouts.master')
@section('title','E-SHOP || Cities')
@section('main-content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">City List</h6>
    <a href="{{route('city.create')}}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Add City</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Icon Class</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cities as $city)
            <tr>
                <td>{{$city->name}}</td>
                <td><i class="{{$city->icon}}"></i> {{\Reflector::class}}</td>
                <td>
                    @if($city->status=='active') <span class="badge badge-success">Active</span>
                    @else <span class="badge badge-warning">Inactive</span> @endif
                </td>
                <td>
                    <a href="{{route('city.edit',$city->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('city.destroy',[$city->id])}}">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{$city->id}}" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></button>
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