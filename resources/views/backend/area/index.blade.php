@extends('backend.layouts.master')
@section('title','E-SHOP || Areas')
@section('main-content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Area List</h6>
    <a href="{{route('area.create')}}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Add Area</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>City</th>
            <th>Area Name</th>
            
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($areas as $area)
            <tr>
                <td>{{$area->city->name}}</td>
                <td>{{$area->name}}</td>
                
                <td>
                    @if($area->status=='active') <span class="badge badge-success">Active</span>
                    @else <span class="badge badge-warning">Inactive</span> @endif
                </td>
                <td>
                    <a href="{{route('area.edit',$area->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('area.destroy',[$area->id])}}">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{$area->id}}" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></button>
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