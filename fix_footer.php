<?php
$f = 'resources/views/frontend/layouts/footer.blade.php';
$c = file_get_contents($f);

$old_html = 'POWERED BY <a href="#" style="text-decoration: underline;">PROWAVE TECHNOLOGIES</a> 
                        | <a href="https://wa.me/923173836223"><i class="fa fa-whatsapp"></i> +92 317 3836223</a> 
                        | <a href="#">PRIVACY POLICY</a> 
                        | <a href="#">FAQS</a>';

$new_html = '<div class="bottom-links-inner">
                        POWERED BY <a href="#" style="text-decoration: underline;">PROWAVE TECHNOLOGIES</a> 
                        <span class="pipe">|</span> <a href="https://wa.me/923173836223"><i class="fa fa-whatsapp"></i> +92 317 3836223</a> 
                        <span class="pipe">|</span> <a href="#">PRIVACY POLICY</a> 
                        <span class="pipe">|</span> <a href="#">FAQS</a>
                    </div>';

$c = str_replace($old_html, $new_html, $c);

$append_css = '
<style>
@media(max-width: 768px) {
    .footer .bottom-links {
        overflow-x: auto;
        white-space: nowrap;
        padding-bottom: 5px; /* for scrollbar if any */
    }
    .footer .bottom-links::-webkit-scrollbar {
        display: none; /* Hide scrollbar for clean look */
    }
    .bottom-links-inner {
        display: inline-block;
        font-size: 10px !important;
        letter-spacing: 0.5px !important;
    }
    .bottom-links-inner a {
        margin: 0 4px !important;
        font-size: 10px !important;
    }
    .bottom-links-inner .pipe {
        margin: 0 2px !important;
    }
}
</style>
';

$c .= $append_css;
file_put_contents($f, $c);
echo "Fixed footer bottom links to be one line on mobile.\n";
?>
