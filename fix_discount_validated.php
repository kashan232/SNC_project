<?php
$f = 'app/Http/Controllers/ProductController.php';
$c = file_get_contents($f);

// Check if discount is empty and set to 0 in both store and update where $validatedData is used
$c = str_replace(
    '$validatedData[\'is_featured\'] = $request->input(\'is_featured\', 0);',
    '$validatedData[\'is_featured\'] = $request->input(\'is_featured\', 0);
        if (empty($validatedData[\'discount\'])) {
            $validatedData[\'discount\'] = 0;
        }',
    $c
);

file_put_contents($f, $c);
echo "Fixed discount via validatedData.\n";
?>
