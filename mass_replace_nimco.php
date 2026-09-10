<?php
$directory = new RecursiveDirectoryIterator('resources/views');
$iterator = new RecursiveIteratorIterator($directory);

$replacements = [
    // Old Names
    'UMQ AL WADI FURNITURE TRADING' => 'Shoukat Nimco Center',
    'UMQ AL WADI' => 'Shoukat Nimco Center',
    
    // Some common emails and phones that might be in the template
    '0345-0997103' => '(022) 3641641', // Just guessing old phone if any
    '+92 345 0997103' => '(022) 3641641',
    '+923450997103' => '(022) 3641641',
    'umqalwadi@gmail.com' => 'Hafizansari@yahoo.com',
    'support@shopgrids.com' => 'Hafizansari@yahoo.com',
    'support@umqalwadi.com' => 'Hafizansari@yahoo.com',
    'info@umqalwadi.com' => 'Hafizansari@yahoo.com',
];

// Look for address patterns
// Old address might be: "Memon Foundation Building, Korangi 4, Karachi" or something else

foreach ($iterator as $info) {
    if ($info->isFile() && $info->getExtension() == 'php') {
        $path = $info->getPathname();
        $content = file_get_contents($path);
        $original = $content;
        
        foreach ($replacements as $search => $replace) {
            $content = str_ireplace($search, $replace, $content);
        }

        // We can do regex for emails, phones and addresses to be sure
        $content = preg_replace('/[a-zA-Z0-9._%+-]+@(?:umqalwadi|gmail)\.com/i', 'Hafizansari@yahoo.com', $content);
        $content = preg_replace('/03\d{2}-\d{7}/', '(022) 3641641', $content);
        $content = preg_replace('/\+92 3\d{2} \d{7}/', '(022) 3641641', $content);

        // Address (trying to find common address strings in footer/header)
        // I'll manually check footer and contact pages.

        if ($content !== $original) {
            file_put_contents($path, $content);
            echo "Updated: $path\n";
        }
    }
}
echo "Done replacing general strings.\n";
