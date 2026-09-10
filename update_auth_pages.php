<?php
$files = [
    'resources/views/frontend/pages/login.blade.php',
    'resources/views/frontend/pages/register.blade.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace text
    $content = str_replace(
        'Discover the finest premium furniture to elevate your space.',
        'Discover the finest Nimco, Bakery Items, and Sweets to delight your taste buds.',
        $content
    );
    
    // Replace CSS Block
    $old_css_start = '<style>    /* Ultra Premium Split Layout for Auth Pages */';
    $old_css_end = '</style>';
    
    // Find everything between these tags and replace
    // Actually we can just do a regex replace for the entire style block
    
    $new_css = <<<CSS
<style>    /* Ultra Premium Split Layout for Auth Pages (Red Theme) */
    .shop.login {
        background: #f4f7f6 !important;
        padding: 50px 0 !important;
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
    }
    .shop.login .container {
        max-width: 900px !important;
    }
    .shop.login .col-lg-6.offset-lg-3 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-left: 0;
    }
    .shop.login .login-form {
        background: #fff !important;
        padding: 0 !important;
        border-radius: 15px !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
        border: none !important;
        display: flex !important;
        flex-direction: row !important;
        overflow: hidden;
    }
    .auth-left {
        width: 45%;
        background: linear-gradient(135deg, rgba(230, 32, 32, 0.9), rgba(180, 15, 15, 0.9)), url('{{asset('images/banners/main_banner.jpg')}}') center/cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px 30px;
        color: #fff;
    }
    .auth-left h2 {
        font-family: 'Poppins', sans-serif !important;
        font-size: 28px !important;
        font-weight: 800 !important;
        margin-bottom: 15px !important;
        color: #fff !important;
        line-height: 1.4 !important;
        padding-bottom: 0 !important;
        text-align: left !important;
    }
    .shop.login .login-form h2:before {
        display: none !important;
    }
    .auth-left p {
        font-size: 15px !important;
        line-height: 1.6 !important;
        color: #fce8e8 !important;
        margin-bottom: 0 !important;
        text-align: left !important;
        font-weight: 400 !important;
    }
    .auth-right {
        width: 55%;
        padding: 40px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .auth-right h2 {
        font-family: 'Poppins', sans-serif !important;
        font-size: 26px !important;
        font-weight: 800 !important;
        color: #e62020 !important;
        text-align: center !important;
        margin-bottom: 5px !important;
        line-height: 1.3 !important;
        padding-bottom: 0 !important;
    }
    .auth-right > p {
        text-align: center !important;
        margin-bottom: 25px !important;
        color: #888 !important;
        font-size: 14px !important;
    }
    .shop.login .form {
        margin-top: 0 !important;
    }
    .shop.login .form .form-group input {
        height: 45px !important;
        border-radius: 6px !important;
        border: 2px solid #f0f0f0 !important;
        background: #fafafa !important;
        padding: 0 15px !important;
        margin-bottom: 5px !important;
        font-family: 'Poppins', sans-serif !important;
    }
    .shop.login .form .form-group input:focus {
        border-color: #e62020 !important;
        background: #fff !important;
        box-shadow: none !important;
    }
    .shop.login .form .login-btn {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        gap: 15px !important;
        margin-top: 15px !important;
    }
    .shop.login .form .btn {
        flex: 1 !important;
        height: 45px !important;
        line-height: 45px !important;
        border-radius: 6px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 0 !important;
        text-align: center !important;
        background: #e62020 !important;
        color: #fff !important;
        border: none !important;
        box-shadow: 0 4px 10px rgba(230,32,32,0.2) !important;
        font-family: 'Poppins', sans-serif !important;
    }
    .shop.login .form .btn:hover {
        background: #cc1818 !important;
        color: #fff !important;
        transform: translateY(-2px);
    }
    .shop.login .form a.btn {
        background: transparent !important;
        color: #e62020 !important;
        border: 2px solid #e62020 !important;
        line-height: 41px !important; /* adjust for border */
        box-shadow: none !important;
    }
    .shop.login .form a.btn:hover {
        background: #e62020 !important;
        color: #fff !important;
    }
    @media (max-width: 768px) {
        .shop.login .login-form {
            flex-direction: column !important;
        }
        .auth-left, .auth-right {
            width: 100%;
        }
        .auth-left {
            padding: 30px;
        }
    }</style>
CSS;

    $content = preg_replace('/<style>.*?\/\* Ultra Premium Split Layout for Auth Pages \*\/.*?<\/style>/s', $new_css, $content);
    
    file_put_contents($file, $content);
}

echo "Login and Register pages updated to Red theme with Nimco text.\n";
