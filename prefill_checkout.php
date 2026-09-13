<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$checkout_blade = $base_dir . 'resources/views/frontend/pages/checkout.blade.php';

$content = file_get_contents($checkout_blade);

$prefill_logic = <<<HTML
                        @php
                            \$firstName = old('first_name');
                            \$lastName = old('last_name');
                            \$email = old('email');
                            if (auth()->check()) {
                                if (!\$firstName && !\$lastName) {
                                    \$nameParts = explode(' ', auth()->user()->name, 2);
                                    \$firstName = \$nameParts[0] ?? '';
                                    \$lastName = \$nameParts[1] ?? '';
                                }
                                \$email = \$email ?? auth()->user()->email;
                            }
                        @endphp
                        <div class="row">
HTML;

$content = str_replace('<div class="row">', $prefill_logic, $content);

// Replace inputs to use the new variables
$content = str_replace(
    '<input type="text" name="first_name" placeholder="" value="{{old(\'first_name\')}}" value="{{old(\'first_name\')}}">',
    '<input type="text" name="first_name" placeholder="" value="{{\$firstName}}" required>',
    $content
);
$content = str_replace(
    '<input type="text" name="last_name" placeholder="" value="{{old(\'lat_name\')}}">',
    '<input type="text" name="last_name" placeholder="" value="{{\$lastName}}" required>',
    $content
);
$content = str_replace(
    '<input type="email" name="email" placeholder="Hafizansari@yahoo.com" value="{{ old(\'email\') }}"',
    '<input type="email" name="email" placeholder="Email" value="{{\$email}}"',
    $content
);

file_put_contents($checkout_blade, $content);
echo "Checkout pre-fill added.\n";
