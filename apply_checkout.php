<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Migration
$date = date('Y_m_d_His');
$migration_content = <<<PHP
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint \$table) {
            \$table->unsignedBigInteger('city_id')->nullable()->after('status');
            \$table->unsignedBigInteger('area_id')->nullable()->after('city_id');
            
            \$table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            \$table->foreign('area_id')->references('id')->on('areas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint \$table) {
            \$table->dropForeign(['city_id']);
            \$table->dropForeign(['area_id']);
            \$table->dropColumn(['city_id', 'area_id']);
        });
    }
};
PHP;
if (empty(glob($base_dir . 'database/migrations/*_add_city_area_to_orders_table.php'))) {
    file_put_contents($base_dir . "database/migrations/{$date}_add_city_area_to_orders_table.php", $migration_content);
}


// 2. Order Model
$order_model = file_get_contents($base_dir . 'app/Models/Order.php');
$order_model = str_replace(
    "'status','first_name','last_name','email','phone','country','post_code','address1','address2'",
    "'status','city_id','area_id','first_name','last_name','email','phone','country','post_code','address1','address2'",
    $order_model
);
if (strpos($order_model, 'public function city') === false) {
    $relations = <<<PHP
    public function city()
    {
        return \$this->belongsTo(City::class, 'city_id');
    }

    public function area()
    {
        return \$this->belongsTo(Area::class, 'area_id');
    }
PHP;
    $order_model = preg_replace('/\}\s*$/', $relations . "\n}", $order_model);
    file_put_contents($base_dir . 'app/Models/Order.php', $order_model);
}


// 3. OrderController
$order_controller = file_get_contents($base_dir . 'app/Http/Controllers/OrderController.php');
// The checkout validation uses 'country' and 'post_code' which we are removing from the form.
// Let's make them nullable, and require city_id and area_id
$order_controller = str_replace(
    "'country'=>'string|required',",
    "'country'=>'string|nullable',\n            'city_id'=>'required|exists:cities,id',\n            'area_id'=>'required|exists:areas,id',",
    $order_controller
);
$order_controller = str_replace(
    "'post_code'=>'string|nullable',",
    "'post_code'=>'string|nullable',", // leave it alone
    $order_controller
);
// Assign in store method
if (strpos($order_controller, '$order->city_id=$request->city_id;') === false) {
    $order_controller = str_replace(
        "\$order->country=\$request->country;",
        "\$order->country='PK';\n        \$order->city_id=\$request->city_id;\n        \$order->area_id=\$request->area_id;",
        $order_controller
    );
    file_put_contents($base_dir . 'app/Http/Controllers/OrderController.php', $order_controller);
}


// 4. Checkout Blade
$checkout = file_get_contents($base_dir . 'resources/views/frontend/pages/checkout.blade.php');

// Remove Country, Post Code, Address Line 2
$checkout = preg_replace('/<div class="col-lg-6 col-md-6 col-12">\s*<div class="form-group">\s*<label>Country<span>\*<\/span><\/label>\s*<select name="country" id="country">\s*<option value="PK">Pakistan<\/option>\s*<\/select>\s*<\/div>\s*<\/div>/', '', $checkout);
$checkout = preg_replace('/<div class="col-lg-6 col-md-6 col-12">\s*<div class="form-group">\s*<label>Address Line 2<\/label>.*?<\/div>\s*<\/div>/s', '', $checkout);
$checkout = preg_replace('/<div class="col-lg-6 col-md-6 col-12">\s*<div class="form-group">\s*<label>Postal Code<\/label>.*?<\/div>\s*<\/div>/s', '', $checkout);

// Add City and Area
$city_area_fields = <<<HTML
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>City<span>*</span></label>
                                    <select name="city_id" id="checkoutCity" required onchange="fetchCheckoutAreas(this.value)">
                                        <option value="">Select City</option>
                                        @php
                                            \$checkoutCities = \App\Models\City::where('status', 'active')->get();
                                        @endphp
                                        @foreach(\$checkoutCities as \$c)
                                            <option value="{{\$c->id}}">{{\$c->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                    <span class='text-danger'>{{\$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Area<span>*</span></label>
                                    <select name="area_id" id="checkoutArea" required>
                                        <option value="">Select Area</option>
                                    </select>
                                    @error('area_id')
                                    <span class='text-danger'>{{\$message}}</span>
                                    @enderror
                                </div>
                            </div>
HTML;

$checkout = str_replace('<label>Address Line 1<span>*</span></label>', '<label>House No. / Street Address<span>*</span></label>', $checkout);
$checkout = preg_replace('/(<div class="col-lg-6 col-md-6 col-12">\s*<div class="form-group">\s*<label>House No\. \/ Street Address<span>\*<\/span><\/label>.*?<\/div>\s*<\/div>)/s', $city_area_fields . "\n$1", $checkout);

// Add JS
$js = <<<HTML
@push('scripts')
<script>
    function fetchCheckoutAreas(cityId) {
        let areaSelect = document.getElementById('checkoutArea');
        areaSelect.innerHTML = '<option value="">Loading areas...</option>';
        if(!cityId) {
            areaSelect.innerHTML = '<option value="">Select Area</option>';
            return;
        }
        fetch(`/api/areas/\${cityId}`)
            .then(res => res.json())
            .then(areas => {
                areaSelect.innerHTML = '<option value="">Select Area</option>';
                areas.forEach(area => {
                    let option = document.createElement('option');
                    option.value = area.id; // Backend needs ID
                    option.textContent = area.name;
                    areaSelect.appendChild(option);
                });
            })
            .catch(err => {
                console.error(err);
                areaSelect.innerHTML = '<option value="">Failed to load areas</option>';
            });
    }
</script>
@endpush
HTML;
if (strpos($checkout, 'fetchCheckoutAreas') === false) {
    $checkout = str_replace('@endsection', $js . "\n@endsection", $checkout);
}

// Remove newsletter
$checkout = str_replace("@include('frontend.layouts.newsletter')", "<!-- @include('frontend.layouts.newsletter') -->", $checkout);

file_put_contents($base_dir . 'resources/views/frontend/pages/checkout.blade.php', $checkout);


// 5. Admin Order Show
$show_blade = file_get_contents($base_dir . 'resources/views/backend/order/show.blade.php');
$show_blade = str_replace(
    '<tr>
                        <td>Country</td>
                        <td> : {{$order->country}}</td>
                    </tr>',
    '<tr>
                        <td>City</td>
                        <td> : {{$order->city ? $order->city->name : "N/A"}}</td>
                    </tr>
                    <tr>
                        <td>Area</td>
                        <td> : {{$order->area ? $order->area->name : "N/A"}}</td>
                    </tr>',
    $show_blade
);
$show_blade = preg_replace('/<tr>\s*<td>Post Code<\/td>\s*<td> : \{\{\$order->post_code\}\}<\/td>\s*<\/tr>/', '', $show_blade);
file_put_contents($base_dir . 'resources/views/backend/order/show.blade.php', $show_blade);

echo "Implementation complete!\n";
