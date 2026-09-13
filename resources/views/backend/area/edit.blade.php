@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Edit Area</h5>
    <div class="card-body">
      <form method="post" action="{{route('area.update', $area->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label>City</label>
          <select name="city_id" class="form-control" required>
              @foreach($cities as $city)
                  <option value="{{$city->id}}" {{$area->city_id == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Area Name</label>
          <input type="text" name="name" class="form-control" value="{{$area->name}}" required>
        </div>
        
        <div class="form-group">
          <label>Status</label>
          <select name="status" class="form-control">
              <option value="active" {{$area->status=='active' ? 'selected' : ''}}>Active</option>
              <option value="inactive" {{$area->status=='inactive' ? 'selected' : ''}}>Inactive</option>
          </select>
        </div>
        <button class="btn btn-success" type="submit">Update</button>
      </form>
    </div>
</div>
@endsection