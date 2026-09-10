@extends('backend.layouts.master')
@section('title','E-SHOP || Edit Outlet')
@section('main-content')
<div class="card">
    <h5 class="card-header">Edit Outlet</h5>
    <div class="card-body">
      <form method="post" action="{{route('outlet.update',$outlet->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter outlet name"  value="{{$outlet->name}}" class="form-control">
          @error('name')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="inputAddress" class="col-form-label">Address <span class="text-danger">*</span></label>
          <textarea class="form-control" id="address" name="address">{{$outlet->address}}</textarea>
          @error('address')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active" {{(($outlet->status=='active') ? 'selected' : '')}}>Active</option>
              <option value="inactive" {{(($outlet->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>
@endsection