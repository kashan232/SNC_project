<?php
$file = 'resources/views/frontend/layouts/location_modal.blade.php';
$content = file_get_contents($file);

$old_select = <<<HTML
                        <select id="branchSelect">
                            <option value="">Select Branch</option>
                            <option value="branch1">SNC Main Branch, Tariq Road</option>
                            <option value="branch2">SNC Branch 2, DHA Phase 6</option>
                            <option value="branch3">SNC Branch 3, North Nazimabad</option>
                        </select>
HTML;

$new_select = <<<HTML
                        <select id="branchSelect">
                            <option value="">Select Branch</option>
                            @php
                                \$pickupOutlets = \App\Models\Outlet::where('status', 'active')->get();
                            @endphp
                            @foreach(\$pickupOutlets as \$outlet)
                                <option value="{{\$outlet->id}}">{{\$outlet->name}}, {{\Illuminate\Support\Str::limit(\$outlet->address, 40)}}</option>
                            @endforeach
                        </select>
HTML;

$content = str_replace($old_select, $new_select, $content);
file_put_contents($file, $content);
echo "Pickup options updated.\n";
