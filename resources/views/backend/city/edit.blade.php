@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Edit City</h5>
    <div class="card-body">
      <form method="post" action="{{route('city.update', $city->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label>City Name</label>
          <input type="text" name="name" class="form-control" value="{{$city->name}}" required>
        </div>
        <div class="form-group">
          <label>Icon</label>
          <input type="text" name="icon" class="form-control" value="{{$city->icon}}">
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="status" class="form-control">
              <option value="active" {{$city->status=='active' ? 'selected' : ''}}>Active</option>
              <option value="inactive" {{$city->status=='inactive' ? 'selected' : ''}}>Inactive</option>
          </select>
        </div>
        <button class="btn btn-success" type="submit">Update</button>
      </form>
    </div>
</div>
@endsection