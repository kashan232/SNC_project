<?php
$f = 'resources/views/backend/layouts/head.blade.php';
$c = file_get_contents($f);

$new = '
@php
    $settings = DB::table(\'settings\')->first();
    $themeColor = $settings->theme_color ?? \'#F7941D\';
@endphp
<style>
    :root {
        --primary-color: {{ $themeColor }};
    }
    .bg-gradient-primary {
        background-color: var(--primary-color) !important;
        background-image: none !important;
    }
    .text-primary {
        color: var(--primary-color) !important;
    }
    .btn-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
    }
    .btn-primary:hover {
        background-color: #e68a18 !important;
        border-color: #e68a18 !important;
    }
    .sidebar-dark .nav-item.active .nav-link {
        color: #fff;
        font-weight: 700;
    }
    .sidebar-dark .nav-item .nav-link:hover {
        color: rgba(255,255,255,0.8);
    }
</style>
</head>';

$c = str_replace('</head>', $new, $c);
file_put_contents($f, $c);
echo "Injected dynamic theme color CSS into admin head.\n";
?>
