<?php
$f = 'app/Http/Controllers/ProductController.php';
$c = file_get_contents($f);

// Fix in store method
$search1 = '$data = $request->all();';
$replace1 = '$data = $request->all();
        if (empty($data["discount"])) {
            $data["discount"] = 0;
        }';
if (strpos($c, $replace1) === false) {
    $c = str_replace($search1, $replace1, $c);
}

// Check if update method uses $data = $request->all(); too. Let's do regex to catch both.
// Wait, $data = $request->all(); is standard in Eshop.
// Let's just do it securely using preg_replace
$c = preg_replace('/(\$data = \$request->all\(\);)/', "$1\n        if (empty(\$data['discount'])) {\n            \$data['discount'] = 0;\n        }\n", file_get_contents($f));

file_put_contents($f, $c);
echo "Fixed discount null issue.";
?>
