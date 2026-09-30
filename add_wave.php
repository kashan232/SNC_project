<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$wave = '
        <!-- Bottom Wave SVG to match mockup exactly -->
        <div class="hero-wave" style="position: absolute; bottom: -2px; left: 0; width: 100%; overflow: hidden; line-height: 0; z-index: 10;">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="display: block; width: 100%; height: 70px;">
                <!-- Orange Outline Wave -->
                <path d="M0,60 C320,120 420,0 720,40 C1020,80 1120,-20 1440,60 L1440,120 L0,120 Z" fill="var(--primary-color)" transform="translate(0, -6)"></path>
                <!-- White Fill Wave -->
                <path d="M0,60 C320,120 420,0 720,40 C1020,80 1120,-20 1440,60 L1440,120 L0,120 Z" fill="#fcf9f2"></path>
            </svg>
        </div>
</section>';

// Find the section close for Gslider
// Look for `<section id="Gslider"...` then the matching `</section>`
// A simple way is to replace the specific `</section>` that comes right before `@endif <!--/ End Slider Area -->`
$c = preg_replace('/<\/section>\s*@endif\s*<!--\/ End Slider Area -->/s', $wave . "\n@endif\n<!--/ End Slider Area -->", $c);

// Also add a mobile responsive style for the wave to the very end of the file
$style = '
<style>
@media (max-width: 768px) {
    #Gslider .hero-wave svg {
        height: 40px !important;
    }
}
</style>
';
$c .= $style;

file_put_contents($f, $c);
echo "Wave added successfully.\n";
?>
