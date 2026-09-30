<?php
$f = 'resources/views/frontend/layouts/footer.blade.php';
$c = file_get_contents($f);

// 1. Remove the old HTML I just added
$old_html = '<div class="bottom-links-inner">
                        POWERED BY <a href="#" style="text-decoration: underline;">PROWAVE TECHNOLOGIES</a> 
                        <span class="pipe">|</span> <a href="https://wa.me/923173836223"><i class="fa fa-whatsapp"></i> +92 317 3836223</a> 
                        <span class="pipe">|</span> <a href="#">PRIVACY POLICY</a> 
                        <span class="pipe">|</span> <a href="#">FAQS</a>
                    </div>';

$new_html = '<div class="bottom-links-inner">
                        <div class="footer-line-1">
                            POWERED BY <a href="#" style="text-decoration: underline;">PROWAVE TECHNOLOGIES</a> 
                            <span class="pipe desktop-only">|</span>
                        </div>
                        <div class="footer-line-2">
                            <a href="https://wa.me/923173836223"><i class="fa fa-whatsapp"></i> +92 317 3836223</a> 
                            <span class="pipe">|</span> <a href="#">PRIVACY POLICY</a> 
                            <span class="pipe">|</span> <a href="#">FAQS</a>
                        </div>
                    </div>';

$c = str_replace($old_html, $new_html, $c);

// 2. Fix the CSS I just appended. We will just append ANOTHER block that overrides it properly.
$append_css = '
<style>
.footer-line-1, .footer-line-2 {
    display: inline-block;
}
@media(max-width: 768px) {
    .footer .bottom-links {
        overflow-x: hidden !important;
        white-space: normal !important; /* ALLOW wrapping */
        padding-bottom: 0 !important;
    }
    .bottom-links-inner {
        display: block !important;
    }
    .footer-line-1, .footer-line-2 {
        display: block !important;
        text-align: center;
        margin: 4px 0;
        font-size: 11px !important;
    }
    .desktop-only { display: none !important; }
    .bottom-links-inner a {
        font-size: 11px !important;
    }
}
</style>
';

$c .= $append_css;
file_put_contents($f, $c);
echo "Fixed footer bottom links to be TWO lines on mobile.\n";
?>
