<?php
$f = 'app/Http/Controllers/ProductController.php';
$c = file_get_contents($f);

// Store method
$store_logic = '
        if ($request->has(\'size\')) {
            $validatedData[\'size\'] = implode(\',\', $request->input(\'size\'));
        } else {
            $validatedData[\'size\'] = \'\';
        }
        
        if ($request->has(\'size_prices\')) {
            $validatedData[\'size_prices\'] = json_encode(array_filter($request->input(\'size_prices\'), function($value) {
                return !is_null($value) && $value !== \'\';
            }));
        } else {
            $validatedData[\'size_prices\'] = null;
        }
';
$c = preg_replace('/if \(\$request->has\(\'size\'\)\) \{\s*\$validatedData\[\'size\'\] = implode\(\',\', \$request->input\(\'size\'\)\);\s*\} else \{\s*\$validatedData\[\'size\'\] = \'\';\s*\}/', $store_logic, $c);

// Also need to allow `size_prices` in validation.
// Wait, validate doesn't strictly strip non-validated fields unless we are strictly using $validatedData as the ONLY input, but wait, $request->input('size_prices') is fine, we just assign it to $validatedData.
// To be safe, we add 'size_prices' to validate array just in case Laravel strips it later or throws error.
$c = str_replace("'size' => 'nullable',", "'size' => 'nullable',\n            'size_prices' => 'nullable|array',", $c);


file_put_contents($f, $c);
echo "ProductController updated!";
?>
