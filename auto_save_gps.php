<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Add route
$routes = file_get_contents($base_dir . 'routes/web.php');
if (strpos($routes, "Route::post('/api/save-location'") === false) {
    $routes = str_replace(
        "Route::get('/api/areas/{city_id}', 'App\Http\Controllers\AreaController@getAreasByCity');",
        "Route::get('/api/areas/{city_id}', 'App\Http\Controllers\AreaController@getAreasByCity');\nRoute::post('/api/save-location', 'App\Http\Controllers\AreaController@autoSaveLocation');",
        $routes
    );
    file_put_contents($base_dir . 'routes/web.php', $routes);
}

// 2. Add method in AreaController
$area_controller = file_get_contents($base_dir . 'app/Http/Controllers/AreaController.php');
if (strpos($area_controller, 'public function autoSaveLocation') === false) {
    $method = <<<PHP
    
    // Auto save location from GPS
    public function autoSaveLocation(Request \$request)
    {
        \$city_name = \$request->city;
        \$area_name = \$request->area;

        if (empty(\$city_name)) {
            return response()->json(['success' => false, 'message' => 'City is empty']);
        }

        // Find or create city
        \$city = City::firstOrCreate(
            ['name' => \$city_name],
            ['icon' => 'fa fa-map-marker', 'status' => 'active']
        );

        if (!empty(\$area_name)) {
            // Find or create area
            Area::firstOrCreate(
                ['city_id' => \$city->id, 'name' => \$area_name],
                ['delivery_charges' => 0, 'status' => 'active']
            );
        }

        return response()->json(['success' => true]);
    }
}
PHP;
    $area_controller = preg_replace('/\}\s*$/', $method, $area_controller);
    file_put_contents($base_dir . 'app/Http/Controllers/AreaController.php', $area_controller);
}

// 3. Update Javascript in modal
$modal = file_get_contents($base_dir . 'resources/views/frontend/layouts/location_modal.blade.php');
$old_js = <<<JS
                            let area = data.address.suburb || data.address.neighbourhood || data.address.road || '';
                            let city = data.address.city || data.address.town || data.address.state || '';
                            locName = (area ? area + ', ' : '') + city;
                            if(!locName.trim()) locName = "Current Location";
                        }
                        
                        localStorage.setItem('saved_location_name', locName);
JS;

$new_js = <<<JS
                            let area = data.address.suburb || data.address.neighbourhood || data.address.road || '';
                            let city = data.address.city || data.address.town || data.address.state || '';
                            locName = (area ? area + ', ' : '') + city;
                            if(!locName.trim()) locName = "Current Location";

                            // AJAX call to autosave in DB
                            if (city) {
                                fetch('/api/save-location', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ city: city, area: area })
                                }).then(res => res.json()).then(data => {
                                    // Refresh page to load new city in modal if desired, or just quietly succeed
                                }).catch(err => console.error(err));
                            }
                        }
                        
                        localStorage.setItem('saved_location_name', locName);
JS;

$modal = str_replace($old_js, $new_js, $modal);
file_put_contents($base_dir . 'resources/views/frontend/layouts/location_modal.blade.php', $modal);

echo "Auto-save implemented.\n";
