<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Remove from index
$index = file_get_contents($base_dir . 'resources/views/backend/area/index.blade.php');
$index = str_replace('<th>Delivery Charges</th>', '', $index);
$index = str_replace('<td>{{$area->delivery_charges}}</td>', '', $index);
file_put_contents($base_dir . 'resources/views/backend/area/index.blade.php', $index);

// 2. Remove from create
$create = file_get_contents($base_dir . 'resources/views/backend/area/create.blade.php');
$create = preg_replace('/<div class="form-group">\s*<label>Delivery Charges<\/label>\s*<input type="number" name="delivery_charges" class="form-control" value="0" step="0\.01">\s*<\/div>/', '', $create);
file_put_contents($base_dir . 'resources/views/backend/area/create.blade.php', $create);

// 3. Remove from edit
$edit = file_get_contents($base_dir . 'resources/views/backend/area/edit.blade.php');
$edit = preg_replace('/<div class="form-group">\s*<label>Delivery Charges<\/label>\s*<input type="number" name="delivery_charges" class="form-control" value="\{\{\$area->delivery_charges\}\}" step="0\.01">\s*<\/div>/', '', $edit);
file_put_contents($base_dir . 'resources/views/backend/area/edit.blade.php', $edit);

// 4. Remove from frontend JS in location_modal.blade.php
$modal = file_get_contents($base_dir . 'resources/views/frontend/layouts/location_modal.blade.php');
// The JS was: option.textContent = area.name + (area.delivery_charges > 0 ? ' (Rs ' + area.delivery_charges + ')' : '');
$modal = str_replace("option.textContent = area.name + (area.delivery_charges > 0 ? ' (Rs ' + area.delivery_charges + ')' : '');", "option.textContent = area.name;", $modal);
file_put_contents($base_dir . 'resources/views/frontend/layouts/location_modal.blade.php', $modal);

echo "Delivery charges removed.\n";
