<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$checkout_path = $base_dir . 'resources/views/frontend/pages/checkout.blade.php';
$checkout = file_get_contents($checkout_path);

// 1. Remove the duplicated php block at the bottom
$duplicated_block = <<<HTML
                                @php
                            \$firstName = old('first_name');
                            \$lastName = old('last_name');
                            \$email = old('email');
                            if (auth()->check()) {
                                if (!\$firstName && !\$lastName) {
                                    \$nameParts = explode(' ', auth()->user()->name, 2);
                                    \$firstName = \$nameParts[0] ?? '';
                                    \$lastName = \$nameParts[1] ?? '';
                                }
                                \$email = \$email ?? auth()->user()->email;
                            }
                        @endphp
                        <div class="row">
HTML;
// Replace the LAST occurrence of it (which is in Shop Services) with just <div class="row">
$pos = strrpos($checkout, $duplicated_block);
if ($pos !== false) {
    $checkout = substr_replace($checkout, '<div class="row">', $pos, strlen($duplicated_block));
}

// 2. Fix Nice-Select for City and Area
// Add custom class and override nice-select
$checkout = str_replace('<select name="city_id" id="checkoutCity" required onchange="fetchCheckoutAreas(this.value)">', '<select name="city_id" id="checkoutCity" class="form-control custom-select" required onchange="fetchCheckoutAreas(this.value)">', $checkout);
$checkout = str_replace('<select name="area_id" id="checkoutArea" required>', '<select name="area_id" id="checkoutArea" class="form-control custom-select" required>', $checkout);

// 3. Update JS to handle nice-select update if it exists, or just disable it
$new_js = <<<HTML
@push('scripts')
<script>
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
        let areaSelect = document.getElementById('checkoutArea');
        areaSelect.innerHTML = '<option value="">Loading areas...</option>';
        if(!cityId) {
            areaSelect.innerHTML = '<option value="">Select Area</option>';
            return;
        }
        fetch(`/api/areas/\${cityId}`)
            .then(res => res.json())
            .then(areas => {
                areaSelect.innerHTML = '<option value="">Select Area</option>';
                areas.forEach(area => {
                    let option = document.createElement('option');
                    option.value = area.id; 
                    option.textContent = area.name;
                    areaSelect.appendChild(option);
                });
            })
            .catch(err => {
                console.error(err);
                areaSelect.innerHTML = '<option value="">Failed to load areas</option>';
            });
    }
</script>
<style>
    /* Checkout Form Premium Redesign */
    .checkout .checkout-form {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }
    .checkout .checkout-form h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }
    .checkout .checkout-form p {
        margin-bottom: 30px;
        color: #777;
    }
    .checkout .form-group label {
        font-weight: 500;
        color: #333;
        margin-bottom: 10px;
    }
    .checkout .form-group input, 
    .checkout .form-group select.custom-select {
        height: 50px;
        border-radius: 5px;
        border: 1px solid #e6e6e6;
        box-shadow: none;
        padding: 0 20px;
        width: 100%;
        background: #f9f9f9;
        transition: all 0.3s ease;
    }
    .checkout .form-group input:focus, 
    .checkout .form-group select.custom-select:focus {
        border-color: var(--primary-color, #F7941D);
        background: #fff;
    }
    .checkout .order-details {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .checkout .single-widget h2 {
        font-size: 18px;
        font-weight: 600;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }
    .checkout .single-widget .content ul li {
        font-size: 15px;
        color: #333;
        margin-bottom: 15px;
        font-weight: 500;
    }
    .checkout .single-widget .content ul li span {
        float: right;
        font-weight: 600;
    }
    .checkout .single-widget .content ul li.last {
        border-top: 1px solid #eee;
        padding-top: 15px;
        font-size: 18px;
        color: var(--primary-color, #F7941D);
    }
    .checkout .get-button .btn {
        width: 100%;
        height: 50px;
        line-height: 50px;
        padding: 0;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>
@endpush
HTML;

$checkout = preg_replace('/@push\(\'scripts\'\).*?@endpush/s', $new_js, $checkout);

file_put_contents($checkout_path, $checkout);
echo "Checkout UI upgraded.\n";
