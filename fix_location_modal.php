<?php
$f = 'resources/views/frontend/layouts/location_modal.blade.php';
$c = file_get_contents($f);

// 1. Remove opacity: 0 and animation from .modal-body
$old_body_anim = '#locationModal .modal-body {
        animation: slideUpFade 0.6s ease-out forwards;
        animation-delay: 0.2s;
        opacity: 0;
    }';
$new_body_anim = '#locationModal .modal-body {
        /* Removed animation to prevent blank screen bug on mobile */
        opacity: 1;
    }';
$c = str_replace($old_body_anim, $new_body_anim, $c);

// 2. Add extremely high z-index to modal so it covers the header cart/logo
$old_modal = '<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">';
$new_modal = '<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="z-index: 99999999 !important;">';
$c = str_replace($old_modal, $new_modal, $c);

file_put_contents($f, $c);
echo "Fixed location modal blank body and z-index.\n";
?>
