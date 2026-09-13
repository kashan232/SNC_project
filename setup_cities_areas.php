<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Models
$city_model = <<<PHP
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected \$fillable = ['name', 'icon', 'status'];

    public function areas()
    {
        return \$this->hasMany(Area::class);
    }
}
PHP;
file_put_contents($base_dir . 'app/Models/City.php', $city_model);

$area_model = <<<PHP
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected \$fillable = ['city_id', 'name', 'delivery_charges', 'status'];

    public function city()
    {
        return \$this->belongsTo(City::class);
    }
}
PHP;
file_put_contents($base_dir . 'app/Models/Area.php', $area_model);

// 2. Migrations
$date = date('Y_m_d_His');
$city_migration = <<<PHP
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->string('icon')->nullable()->default('fa fa-map-marker');
            \$table->enum('status', ['active', 'inactive'])->default('active');
            \$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
PHP;
if (empty(glob($base_dir . 'database/migrations/*_create_cities_table.php'))) {
    file_put_contents($base_dir . "database/migrations/{$date}_create_cities_table.php", $city_migration);
}

sleep(1);
$date2 = date('Y_m_d_His');
$area_migration = <<<PHP
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint \$table) {
            \$table->id();
            \$table->unsignedBigInteger('city_id');
            \$table->string('name');
            \$table->decimal('delivery_charges', 10, 2)->default(0);
            \$table->enum('status', ['active', 'inactive'])->default('active');
            \$table->timestamps();
            
            \$table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('areas');
    }
};
PHP;
if (empty(glob($base_dir . 'database/migrations/*_create_areas_table.php'))) {
    file_put_contents($base_dir . "database/migrations/{$date2}_create_areas_table.php", $area_migration);
}


// 3. Controllers
$city_controller = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        \$cities = City::orderBy('id', 'DESC')->paginate(10);
        return view('backend.city.index', compact('cities'));
    }

    public function create()
    {
        return view('backend.city.create');
    }

    public function store(Request \$request)
    {
        \$this->validate(\$request, [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);
        City::create(\$request->all());
        return redirect()->route('city.index')->with('success', 'City created successfully');
    }

    public function edit(\$id)
    {
        \$city = City::findOrFail(\$id);
        return view('backend.city.edit', compact('city'));
    }

    public function update(Request \$request, \$id)
    {
        \$this->validate(\$request, [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);
        \$city = City::findOrFail(\$id);
        \$city->update(\$request->all());
        return redirect()->route('city.index')->with('success', 'City updated successfully');
    }

    public function destroy(\$id)
    {
        \$city = City::findOrFail(\$id);
        \$city->delete();
        return redirect()->route('city.index')->with('success', 'City deleted successfully');
    }
}
PHP;
file_put_contents($base_dir . 'app/Http/Controllers/CityController.php', $city_controller);

$area_controller = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\City;

class AreaController extends Controller
{
    public function index()
    {
        \$areas = Area::with('city')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.area.index', compact('areas'));
    }

    public function create()
    {
        \$cities = City::where('status','active')->get();
        return view('backend.area.create', compact('cities'));
    }

    public function store(Request \$request)
    {
        \$this->validate(\$request, [
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'delivery_charges' => 'nullable|numeric',
            'status' => 'required|in:active,inactive'
        ]);
        Area::create(\$request->all());
        return redirect()->route('area.index')->with('success', 'Area created successfully');
    }

    public function edit(\$id)
    {
        \$area = Area::findOrFail(\$id);
        \$cities = City::where('status','active')->get();
        return view('backend.area.edit', compact('area', 'cities'));
    }

    public function update(Request \$request, \$id)
    {
        \$this->validate(\$request, [
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'delivery_charges' => 'nullable|numeric',
            'status' => 'required|in:active,inactive'
        ]);
        \$area = Area::findOrFail(\$id);
        \$area->update(\$request->all());
        return redirect()->route('area.index')->with('success', 'Area updated successfully');
    }

    public function destroy(\$id)
    {
        \$area = Area::findOrFail(\$id);
        \$area->delete();
        return redirect()->route('area.index')->with('success', 'Area deleted successfully');
    }
    
    // API for Frontend
    public function getAreasByCity(\$city_id)
    {
        \$areas = Area::where('city_id', \$city_id)->where('status', 'active')->get();
        return response()->json(\$areas);
    }
}
PHP;
file_put_contents($base_dir . 'app/Http/Controllers/AreaController.php', $area_controller);


// 4. Views for City
@mkdir($base_dir . 'resources/views/backend/city', 0777, true);
$city_index = <<<HTML
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
          @foreach(\$cities as \$city)
            <tr>
                <td>{{\$city->name}}</td>
                <td><i class="{{\$city->icon}}"></i> {{\Reflector::class}}</td>
                <td>
                    @if(\$city->status=='active') <span class="badge badge-success">Active</span>
                    @else <span class="badge badge-warning">Inactive</span> @endif
                </td>
                <td>
                    <a href="{{route('city.edit',\$city->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('city.destroy',[\$city->id])}}">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{\$city->id}}" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></button>
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
file_put_contents($base_dir . 'resources/views/backend/city/index.blade.php', $city_index);

$city_create = <<<HTML
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
HTML;
file_put_contents($base_dir . 'resources/views/backend/city/create.blade.php', $city_create);

$city_edit = <<<HTML
@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Edit City</h5>
    <div class="card-body">
      <form method="post" action="{{route('city.update', \$city->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label>City Name</label>
          <input type="text" name="name" class="form-control" value="{{\$city->name}}" required>
        </div>
        <div class="form-group">
          <label>Icon</label>
          <input type="text" name="icon" class="form-control" value="{{\$city->icon}}">
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="status" class="form-control">
              <option value="active" {{\$city->status=='active' ? 'selected' : ''}}>Active</option>
              <option value="inactive" {{\$city->status=='inactive' ? 'selected' : ''}}>Inactive</option>
          </select>
        </div>
        <button class="btn btn-success" type="submit">Update</button>
      </form>
    </div>
</div>
@endsection
HTML;
file_put_contents($base_dir . 'resources/views/backend/city/edit.blade.php', $city_edit);


// 5. Views for Area
@mkdir($base_dir . 'resources/views/backend/area', 0777, true);
$area_index = <<<HTML
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
            <th>Delivery Charges</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach(\$areas as \$area)
            <tr>
                <td>{{\$area->city->name}}</td>
                <td>{{\$area->name}}</td>
                <td>{{\$area->delivery_charges}}</td>
                <td>
                    @if(\$area->status=='active') <span class="badge badge-success">Active</span>
                    @else <span class="badge badge-warning">Inactive</span> @endif
                </td>
                <td>
                    <a href="{{route('area.edit',\$area->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('area.destroy',[\$area->id])}}">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{\$area->id}}" style="height:30px; width:30px;border-radius:50%"><i class="fas fa-trash-alt"></i></button>
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
file_put_contents($base_dir . 'resources/views/backend/area/index.blade.php', $area_index);

$area_create = <<<HTML
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
              @foreach(\$cities as \$city)
                  <option value="{{\$city->id}}">{{\$city->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Area Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Delivery Charges</label>
          <input type="number" name="delivery_charges" class="form-control" value="0" step="0.01">
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
HTML;
file_put_contents($base_dir . 'resources/views/backend/area/create.blade.php', $area_create);

$area_edit = <<<HTML
@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Edit Area</h5>
    <div class="card-body">
      <form method="post" action="{{route('area.update', \$area->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label>City</label>
          <select name="city_id" class="form-control" required>
              @foreach(\$cities as \$city)
                  <option value="{{\$city->id}}" {{\$area->city_id == \$city->id ? 'selected' : ''}}>{{\$city->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Area Name</label>
          <input type="text" name="name" class="form-control" value="{{\$area->name}}" required>
        </div>
        <div class="form-group">
          <label>Delivery Charges</label>
          <input type="number" name="delivery_charges" class="form-control" value="{{\$area->delivery_charges}}" step="0.01">
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="status" class="form-control">
              <option value="active" {{\$area->status=='active' ? 'selected' : ''}}>Active</option>
              <option value="inactive" {{\$area->status=='inactive' ? 'selected' : ''}}>Inactive</option>
          </select>
        </div>
        <button class="btn btn-success" type="submit">Update</button>
      </form>
    </div>
</div>
@endsection
HTML;
file_put_contents($base_dir . 'resources/views/backend/area/edit.blade.php', $area_edit);

// 6. Routes
$routes = file_get_contents($base_dir . 'routes/web.php');
if (strpos($routes, "Route::resource('/city'") === false) {
    // Add ajax route outside auth
    $routes = str_replace(
        "Route::get('/shipping-policy', [FrontendController::class, 'shippingPolicy'])->name('shipping-policy');",
        "Route::get('/shipping-policy', [FrontendController::class, 'shippingPolicy'])->name('shipping-policy');\nRoute::get('/api/areas/{city_id}', 'App\Http\Controllers\AreaController@getAreasByCity');",
        $routes
    );

    // Add resource routes inside admin auth
    $routes = str_replace(
        "Route::resource('/outlet', 'App\Http\Controllers\OutletController');",
        "Route::resource('/outlet', 'App\Http\Controllers\OutletController');\n        Route::resource('/city', 'App\Http\Controllers\CityController');\n        Route::resource('/area', 'App\Http\Controllers\AreaController');",
        $routes
    );
    file_put_contents($base_dir . 'routes/web.php', $routes);
}

// 7. Sidebar
$sidebar = file_get_contents($base_dir . 'resources/views/backend/layouts/sidebar.blade.php');
if (strpos($sidebar, 'Cities') === false) {
    $delivery_menus = <<<HTML
    <!-- Cities -->
    <li class="nav-item">
      <a class="nav-link" href="{{route('city.index')}}">
        <i class="fas fa-fw fa-city"></i>
        <span>Cities</span></a>
    </li>
    <!-- Areas -->
    <li class="nav-item">
      <a class="nav-link" href="{{route('area.index')}}">
        <i class="fas fa-fw fa-map-marked-alt"></i>
        <span>Areas</span></a>
    </li>
HTML;
    $sidebar = str_replace(
        '<!-- Outlets -->',
        $delivery_menus . "\n    <!-- Outlets -->",
        $sidebar
    );
    file_put_contents($base_dir . 'resources/views/backend/layouts/sidebar.blade.php', $sidebar);
}

echo "Backend setup complete!\n";
