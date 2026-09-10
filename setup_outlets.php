<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Model
$model = <<<PHP
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected \$fillable = ['name', 'address', 'status'];
}
PHP;
file_put_contents($base_dir . 'app/Models/Outlet.php', $model);

// 2. Migration
$migrations = glob($base_dir . 'database/migrations/*_create_outlets_table.php');
if (count($migrations) > 0) {
    $migration_file = $migrations[0];
    $migration = <<<PHP
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('outlets', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->text('address');
            \$table->enum('status', ['active', 'inactive'])->default('active');
            \$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('outlets');
    }
};
PHP;
    file_put_contents($migration_file, $migration);
}

// 3. Controller
$controller = <<<PHP
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function index()
    {
        \$outlets = Outlet::orderBy('id', 'DESC')->paginate(10);
        return view('backend.outlet.index', compact('outlets'));
    }

    public function create()
    {
        return view('backend.outlet.create');
    }

    public function store(Request \$request)
    {
        \$this->validate(\$request, [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        Outlet::create(\$request->all());
        return redirect()->route('outlet.index')->with('success', 'Outlet created successfully');
    }

    public function edit(\$id)
    {
        \$outlet = Outlet::findOrFail(\$id);
        return view('backend.outlet.edit', compact('outlet'));
    }

    public function update(Request \$request, \$id)
    {
        \$this->validate(\$request, [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        \$outlet = Outlet::findOrFail(\$id);
        \$outlet->update(\$request->all());
        return redirect()->route('outlet.index')->with('success', 'Outlet updated successfully');
    }

    public function destroy(\$id)
    {
        \$outlet = Outlet::findOrFail(\$id);
        \$outlet->delete();
        return redirect()->route('outlet.index')->with('success', 'Outlet deleted successfully');
    }
}
PHP;
file_put_contents($base_dir . 'app/Http/Controllers/OutletController.php', $controller);

// 4. Views
@mkdir($base_dir . 'resources/views/backend/outlet', 0777, true);

// index.blade.php
$index = <<<HTML
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
          @foreach(\$outlets as \$outlet)
            <tr>
                <td>{{\$outlet->id}}</td>
                <td>{{\$outlet->name}}</td>
                <td>{{\$outlet->address}}</td>
                <td>
                    @if(\$outlet->status=='active')
                        <span class="badge badge-success">{{\$outlet->status}}</span>
                    @else
                        <span class="badge badge-warning">{{\$outlet->status}}</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('outlet.edit',\$outlet->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('outlet.destroy',[\$outlet->id])}}">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{\$outlet->id}}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
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
HTML;
file_put_contents($base_dir . 'resources/views/backend/outlet/index.blade.php', $index);

// create.blade.php
$create = <<<HTML
@extends('backend.layouts.master')
@section('title','E-SHOP || Add Outlet')
@section('main-content')
<div class="card">
    <h5 class="card-header">Add Outlet</h5>
    <div class="card-body">
      <form method="post" action="{{route('outlet.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter outlet name"  value="{{old('name')}}" class="form-control">
          @error('name')
          <span class="text-danger">{{\$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="inputAddress" class="col-form-label">Address <span class="text-danger">*</span></label>
          <textarea class="form-control" id="address" name="address">{{old('address')}}</textarea>
          @error('address')
          <span class="text-danger">{{\$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{\$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>
@endsection
HTML;
file_put_contents($base_dir . 'resources/views/backend/outlet/create.blade.php', $create);

// edit.blade.php
$edit = <<<HTML
@extends('backend.layouts.master')
@section('title','E-SHOP || Edit Outlet')
@section('main-content')
<div class="card">
    <h5 class="card-header">Edit Outlet</h5>
    <div class="card-body">
      <form method="post" action="{{route('outlet.update',\$outlet->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter outlet name"  value="{{\$outlet->name}}" class="form-control">
          @error('name')
          <span class="text-danger">{{\$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="inputAddress" class="col-form-label">Address <span class="text-danger">*</span></label>
          <textarea class="form-control" id="address" name="address">{{\$outlet->address}}</textarea>
          @error('address')
          <span class="text-danger">{{\$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active" {{((\$outlet->status=='active') ? 'selected' : '')}}>Active</option>
              <option value="inactive" {{((\$outlet->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{\$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>
@endsection
HTML;
file_put_contents($base_dir . 'resources/views/backend/outlet/edit.blade.php', $edit);

// 5. Update Web Routes
$routes = file_get_contents($base_dir . 'routes/web.php');
if (strpos($routes, "Route::resource('/outlet', 'OutletController');") === false) {
    // Insert into admin group
    $routes = str_replace(
        "Route::resource('/shipping','ShippingController');",
        "Route::resource('/shipping','ShippingController');\n    Route::resource('/outlet', 'App\Http\Controllers\OutletController');",
        $routes
    );
    file_put_contents($base_dir . 'routes/web.php', $routes);
}

// 6. Update Sidebar
$sidebar = file_get_contents($base_dir . 'resources/views/backend/layouts/sidebar.blade.php');
if (strpos($sidebar, 'Outlets') === false) {
    $outlet_menu = <<<HTML
    <!-- Outlets -->
    <li class="nav-item">
      <a class="nav-link" href="{{route('outlet.index')}}">
        <i class="fas fa-fw fa-store"></i>
        <span>Outlets</span></a>
    </li>
HTML;
    $sidebar = str_replace(
        '<!-- Reviews -->',
        $outlet_menu . "\n    <!-- Reviews -->",
        $sidebar
    );
    file_put_contents($base_dir . 'resources/views/backend/layouts/sidebar.blade.php', $sidebar);
}

// 7. Update Frontend index.blade.php to fetch dynamic outlets
$frontend = file_get_contents($base_dir . 'resources/views/frontend/index.blade.php');
$grid_pattern = '/<div class="store-grid">.*?<\/div>\s*<\/div>\s*<\/section>/s';
$dynamic_grid = <<<HTML
<div class="store-grid">
            @php
                \$outlets = \App\Models\Outlet::where('status','active')->get();
            @endphp
            @foreach(\$outlets as \$outlet)
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>{{\$outlet->name}}</h4>
                <p>{{\$outlet->address}}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
HTML;
$frontend = preg_replace($grid_pattern, $dynamic_grid, $frontend);
file_put_contents($base_dir . 'resources/views/frontend/index.blade.php', $frontend);

echo "Outlets admin panel setup successfully!\n";
