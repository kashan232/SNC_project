<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$banner_html = <<<HTML

<!-- Start Final Banner Section -->
<section class="final-banner-section" style="padding: 60px 0; background-color: #fcf8f2;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" data-aos="fade-up">
                <a href="#">
                    <img src="{{ asset('frontend/img/final-banner.jpg') }}" alt="Shoukat Nimco Banner" class="img-fluid w-100" style="border-radius: 15px; box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End Final Banner Section -->

HTML;

$c = str_replace(
    '<!-- End Our Outlets Section -->',
    '<!-- End Our Outlets Section -->' . "\n" . $banner_html,
    $c
);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Banner added!";
