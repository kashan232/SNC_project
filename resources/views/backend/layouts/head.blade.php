<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shoukat Nimco Center ||  DASHBOARD</title>
  
    <!-- Custom fonts for this template-->
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @stack('styles')
  

@php
    $settings = DB::table('settings')->first();
    $themeColor = $settings->theme_color ?? '#F7941D';
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
</head>