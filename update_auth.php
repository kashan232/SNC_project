<?php

$files = [
    'c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/login.blade.php',
    'c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/register.blade.php'
];

$new_css = <<<CSS
<style>    /* Ultra Premium Split Layout for Auth Pages */
    .shop.login {
        background-color: #fcf8f2 !important;
        background-image: url('{{asset("frontend/img/food-pattern.png")}}') !important;
        background-size: 300px;
        background-repeat: repeat;
        background-blend-mode: multiply;
        padding: 80px 0 !important;
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
    }
    .shop.login .container {
        max-width: 950px !important;
    }
    .shop.login .col-lg-6.offset-lg-3 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-left: 0;
    }
    .shop.login .login-form {
        background: #fff !important;
        padding: 0 !important;
        border-radius: 20px !important;
        box-shadow: 0 25px 60px rgba(193, 84, 11, 0.15) !important;
        border: 1px solid rgba(193, 84, 11, 0.1) !important;
        display: flex !important;
        flex-direction: row !important;
        overflow: hidden;
    }
    .auth-left {
        width: 45%;
        background: linear-gradient(135deg, rgba(193, 84, 11, 0.85), rgba(74, 46, 43, 0.9)), url('{{asset('frontend/img/final-banner.jpg')}}') center/cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 50px 40px;
        color: #fff;
        position: relative;
    }
    .auth-left::before {
        content: '';
        position: absolute;
        top: 20px; bottom: 20px; left: 20px; right: 20px;
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 12px;
        pointer-events: none;
    }
    .auth-left h2 {
        font-family: 'Orbitron', sans-serif !important;
        font-size: 32px !important;
        font-weight: 800 !important;
        margin-bottom: 20px !important;
        color: #fff !important;
        line-height: 1.3 !important;
        text-align: left !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .shop.login .login-form h2:before {
        display: none !important;
    }
    .auth-left p {
        font-family: 'Poppins', sans-serif !important;
        font-size: 15px !important;
        line-height: 1.7 !important;
        color: #fff !important;
        margin-bottom: 0 !important;
        text-align: left !important;
        font-weight: 400 !important;
        opacity: 0.9;
    }
    .auth-right {
        width: 55%;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #fff;
    }
    .auth-right h2 {
        font-family: 'Orbitron', sans-serif !important;
        font-size: 28px !important;
        font-weight: 800 !important;
        color: var(--primary-color) !important;
        text-align: center !important;
        margin-bottom: 10px !important;
        line-height: 1.3 !important;
    }
    .auth-right > p {
        text-align: center !important;
        margin-bottom: 30px !important;
        color: #666 !important;
        font-size: 14px !important;
        font-family: 'Poppins', sans-serif !important;
    }
    .shop.login .form {
        margin-top: 0 !important;
    }
    .shop.login .form .form-group label {
        font-weight: 600 !important;
        color: #333 !important;
        margin-bottom: 8px !important;
    }
    .shop.login .form .form-group input {
        height: 50px !important;
        border-radius: 8px !important;
        border: 2px solid #eee !important;
        background: #fdfdfd !important;
        padding: 0 20px !important;
        margin-bottom: 8px !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 14px !important;
        transition: all 0.3s ease !important;
    }
    .shop.login .form .form-group input:focus {
        border-color: var(--primary-color) !important;
        background: #fff !important;
        box-shadow: 0 0 0 4px rgba(193, 84, 11, 0.1) !important;
    }
    .shop.login .form .login-btn {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        gap: 15px !important;
        margin-top: 20px !important;
    }
    .shop.login .form .btn {
        flex: 1 !important;
        height: 50px !important;
        line-height: 50px !important;
        border-radius: 8px !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        padding: 0 !important;
        text-align: center !important;
        background: var(--primary-color) !important;
        color: #fff !important;
        border: none !important;
        box-shadow: 0 8px 20px rgba(193, 84, 11, 0.25) !important;
        font-family: 'Poppins', sans-serif !important;
        transition: all 0.3s ease !important;
    }
    .shop.login .form .btn:hover {
        background: #4a2e2b !important;
        color: #fff !important;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(74, 46, 43, 0.3) !important;
    }
    .shop.login .form a.btn {
        background: #fff !important;
        color: var(--primary-color) !important;
        border: 2px solid var(--primary-color) !important;
        line-height: 46px !important; 
        box-shadow: none !important;
    }
    .shop.login .form a.btn:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        box-shadow: 0 8px 20px rgba(193, 84, 11, 0.25) !important;
    }
    @media (max-width: 768px) {
        .shop.login .login-form {
            flex-direction: column !important;
        }
        .auth-left, .auth-right {
            width: 100%;
        }
        .auth-left, .auth-right {
            padding: 40px 20px;
        }
    }
</style>
CSS;

foreach ($files as $file) {
    if (file_exists($file)) {
        $c = file_get_contents($file);
        
        // Remove old style block
        $c = preg_replace('/<style>\s*\/\*\s*Ultra Premium Split Layout.*?<\/style>/s', $new_css, $c);
        
        // Just in case it wasn't matched perfectly by the regex:
        if (strpos($c, 'Ultra Premium Split Layout') === false) {
             $c = str_replace('@endpush', $new_css . "\n@endpush", $c);
        }
        
        file_put_contents($file, $c);
    }
}
echo "Auth pages CSS updated!";
