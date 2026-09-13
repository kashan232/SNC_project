@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Add Area</h5>
    <div class="card-body">
      <form method="post" action="{{route('area.store')}}">
        @csrf
        <div class="form-group">
          <label>City</label>
          <select name="city_id" class="form-control" required>
              <option value="">Select City</option>
              @foreach($cities as $city)
                  <option value="{{$city->id}}">{{$city->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Area Name</label>
          <input type="text" name="name" class="form-control" required>
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