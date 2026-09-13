<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Update location_modal.blade.php to save IDs
$modal_path = $base_dir . 'resources/views/frontend/layouts/location_modal.blade.php';
$modal = file_get_contents($modal_path);

$old_confirm = <<<JS
        if(isDelivery) {
            let areaSelect = document.getElementById('areaSelect');
            if(areaSelect && areaSelect.selectedIndex > 0) {
                locName = areaSelect.options[areaSelect.selectedIndex].text;
            } else {
                locName = document.querySelector('.city-item.active span') ? document.querySelector('.city-item.active span').innerText : 'Karachi';
            }
        } else {
JS;
$new_confirm = <<<JS
        if(isDelivery) {
            let areaSelect = document.getElementById('areaSelect');
            
            // Save City ID and Area ID for checkout page prefill
            let activeCityEl = document.querySelector('.city-item.active');
            if(activeCityEl) {
                let onClickStr = activeCityEl.getAttribute('onclick'); // selectCity(this, 'Name', ID)
                let matches = onClickStr.match(/,\s*(\d+)\s*\)/);
                if(matches && matches[1]) {
                    localStorage.setItem('checkout_city_id', matches[1]);
                }
            }

            if(areaSelect && areaSelect.selectedIndex > 0) {
                locName = areaSelect.options[areaSelect.selectedIndex].text;
                localStorage.setItem('checkout_area_id', areaSelect.options[areaSelect.selectedIndex].value); // Name or ID depending on how we set value
            } else {
                locName = activeCityEl ? activeCityEl.querySelector('span').innerText : 'Karachi';
                localStorage.removeItem('checkout_area_id');
            }
        } else {
            localStorage.removeItem('checkout_city_id');
            localStorage.removeItem('checkout_area_id');
JS;
$modal = str_replace($old_confirm, $new_confirm, $modal);

// also fix the area select value in modal. I previously set `option.value = area.name;` I should change it to `option.value = area.id;` so it matches checkout
$modal = str_replace("option.value = area.name;", "option.value = area.id;", $modal);
file_put_contents($modal_path, $modal);


// 2. Update checkout.blade.php to pre-select based on localStorage
$checkout_path = $base_dir . 'resources/views/frontend/pages/checkout.blade.php';
$checkout = file_get_contents($checkout_path);

$old_js = <<<JS
    $(document).ready(function() {
        // Destroy nice-select on these fields so default select works perfectly
        if ($('#checkoutCity').length) {
            $('#checkoutCity').niceSelect('destroy');
            $('#checkoutCity').css('display', 'block');
        }
        if ($('#checkoutArea').length) {
            $('#checkoutArea').niceSelect('destroy');
            $('#checkoutArea').css('display', 'block');
        }
    });

    function fetchCheckoutAreas(cityId) {
JS;

$new_js = <<<JS
    $(document).ready(function() {
        // Destroy nice-select on these fields so default select works perfectly
        if ($('#checkoutCity').length) {
            $('#checkoutCity').niceSelect('destroy');
            $('#checkoutCity').css('display', 'block');
        }
        if ($('#checkoutArea').length) {
            $('#checkoutArea').niceSelect('destroy');
            $('#checkoutArea').css('display', 'block');
        }

        // Pre-select city and area from modal localstorage
        let savedCityId = localStorage.getItem('checkout_city_id');
        let savedAreaId = localStorage.getItem('checkout_area_id');
        
        if (savedCityId) {
            $('#checkoutCity').val(savedCityId);
            fetchCheckoutAreas(savedCityId, savedAreaId);
        }
    });

    function fetchCheckoutAreas(cityId, autoSelectAreaId = null) {
JS;
$checkout = str_replace($old_js, $new_js, $checkout);

$old_fetch = <<<JS
                areas.forEach(area => {
                    let option = document.createElement('option');
                    option.value = area.id; // Backend needs ID
                    option.textContent = area.name;
                    areaSelect.appendChild(option);
                });
            })
JS;
$new_fetch = <<<JS
                areas.forEach(area => {
                    let option = document.createElement('option');
                    option.value = area.id; // Backend needs ID
                    option.textContent = area.name;
                    if(autoSelectAreaId && area.id == autoSelectAreaId) {
                        option.selected = true;
                    }
                    areaSelect.appendChild(option);
                });
            })
JS;
$checkout = str_replace($old_fetch, $new_fetch, $checkout);

file_put_contents($checkout_path, $checkout);

echo "Auto-select implemented.\n";
