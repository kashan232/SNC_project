<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<CSS
<!-- OVERRIDE FOR QUICK VIEW MODAL -->
<style>
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    .modal-header {
        border-bottom: none;
        padding: 15px 20px 0;
    }
    .modal-header .close {
        background: #fff;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 1;
        color: #333;
        transition: all 0.3s ease;
    }
    .modal-header .close:hover {
        background: #c1540b;
        color: #fff;
    }
    .modal-body {
        padding: 0 30px 30px;
    }
    .quickview-content h2 {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 800;
        color: #4a2e2b;
        font-size: 24px;
        margin-bottom: 10px;
    }
    .quickview-content h3 {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 700;
        color: #c1540b;
        font-size: 22px;
        margin-bottom: 15px;
    }
    .quickview-content h3 del {
        color: #999;
        font-size: 16px;
        font-weight: 500;
    }
    .quickview-content .des {
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .quickview-content .add-to-cart .btn {
        background: #c1540b !important;
        color: #fff !important;
        border-radius: 30px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s ease;
    }
    .quickview-content .add-to-cart .btn:hover {
        background: #4a2e2b !important;
        transform: translateY(-2px);
    }
    .quickview-content .add-to-cart .min {
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f4f4f4;
        color: #333;
        margin-left: 10px;
        transition: all 0.3s ease;
    }
    .quickview-content .add-to-cart .min:hover {
        background: #c1540b;
        color: #fff;
    }
    
    /* Quantity input styling */
    .quickview-content .quantity {
        margin-right: 15px;
    }
    .quickview-content .input-number {
        border-radius: 30px;
        border: 1px solid #eee;
        height: 45px;
        padding: 0 15px;
        text-align: center;
    }
    .quickview-content .btn-primary {
        background: #c1540b;
        border: none;
    }
</style>
CSS;

$c = preg_replace('/(\<div class="modal fade")/i', $css . "\n$1", $c, 1);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Modal CSS injected!";
