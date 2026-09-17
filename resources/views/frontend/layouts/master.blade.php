<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('frontend.layouts.head')	

@php
    $settings = DB::table('settings')->first();
    $themeColor = $settings->theme_color ?? 'var(--primary-color)';
    // Function to calculate hover color (darker version of theme color)
    $hoverColor = 'var(--hover-color)';
    if(preg_match('/^#([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/', $themeColor, $matches)) {
        $r = max(0, hexdec($matches[1]) - 43);
        $g = max(0, hexdec($matches[2]) - 17);
        $b = max(0, hexdec($matches[3]) - 0); // Simplified darkening
        $hoverColor = sprintf("#%02x%02x%02x", $r, $g, $b);
    }
@endphp
<style>
    :root {
        --primary-color: {{\str_replace(';', '', $themeColor)}} !important;
        --hover-color: {{\str_replace(';', '', $hoverColor)}} !important;
    }
</style>
</head>
<body class="js">
	
	<!-- Preloader -->
	<style>
		.preloader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: #ffffff;
			z-index: 999999;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}
		.preloader .logo-loader {
			font-family: 'Poppins', sans-serif;
			font-size: 36px;
			font-weight: 800;
			color: #111;
			text-align: center;
			line-height: 1.2;
			animation: pulse-logo 1.5s ease-in-out infinite;
			letter-spacing: 1px;
		}
		.preloader .logo-loader span {
			color: var(--primary-color);
		}
		.preloader .loader-spinner {
			margin-top: 30px;
			width: 45px;
			height: 45px;
			border: 4px solid rgba(0,0,0,0.05);
			border-top: 4px solid var(--primary-color);
			border-right: 4px solid var(--primary-color);
			border-radius: 50%;
			animation: spin 1s linear infinite;
		}
		.preloader .loader-text {
			margin-top: 15px;
			font-family: 'Poppins', sans-serif;
			font-size: 14px;
			color: #666;
			font-weight: 500;
			letter-spacing: 2px;
			text-transform: uppercase;
		}
		@keyframes pulse-logo {
			0% { transform: scale(1); }
			50% { transform: scale(1.05); }
			100% { transform: scale(1); }
		}
		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
	</style>
	<div class="preloader">
		<div class="logo-loader">SHOUKAT<br><span>NIMCO CENTER</span></div>
		<div class="loader-spinner"></div>
		<div class="loader-text">Loading deliciousness...</div>
	</div>
	<!-- End Preloader -->
	
	@include('frontend.layouts.notification')
	<!-- Header -->
	@include('frontend.layouts.header')
	<!--/ End Header -->
	@yield('main-content')
	
	@include('frontend.layouts.footer')
	
	@include('frontend.layouts.location_modal')
<style>
    /* Floating WhatsApp Icon */
    .float-wa {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 25px;
        left: 25px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
        text-decoration: none !important;
        animation: pulseWa 2s infinite;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
    }
    .float-wa.show-wa {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .float-wa:hover {
        transform: scale(1.1);
        color: #fff;
    }
    @keyframes pulseWa {
        0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }
    @media (max-width: 768px) {
        .float-wa {
            width: 50px;
            height: 50px;
            bottom: 20px;
            left: 20px;
            font-size: 24px;
        }
    }
</style>

<!-- Floating WhatsApp -->
@php
    $wa_settings = DB::table('settings')->first();
    $wa_phone = $wa_settings ? preg_replace('/\D/', '', $wa_settings->phone) : '923173836223';
@endphp
<a href="https://wa.me/{{ $wa_phone }}" class="float-wa" target="_blank" id="wa-btn">
    <i class="bi bi-whatsapp"></i>
</a>
<script>
    window.addEventListener('scroll', function() {
        var waBtn = document.getElementById('wa-btn');
        if (window.scrollY > 200) {
            waBtn.classList.add('show-wa');
        } else {
            waBtn.classList.remove('show-wa');
        }
    });
</script>
</body>
</html>