@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Add City</h5>
    <div class="card-body">
      <form method="post" action="{{route('city.store')}}">
        @csrf
        <div class="form-group">
          <label>City Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Icon (FontAwesome Class, e.g., fa fa-building)</label>
          <input type="text" name="icon" class="form-control" value="fa fa-map-marker">
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
        </div>
        <button class="btn btn-success" type="submit">Submit</button>
      </form>
    </div>
</div>
@endsection