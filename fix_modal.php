<?php
$file = 'c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/location_modal.blade.php';
$content = file_get_contents($file);

// Replace static city grid with dynamic
$static_cities = <<<HTML
                    <div class="city-grid">
                        <div class="city-item active" onclick="selectCity(this, 'Karachi')">
                            <div class="icon-box"><i class="fa fa-building"></i></div>
                            <span>Karachi</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Hyderabad')">
                            <div class="icon-box"><i class="fa fa-building-o"></i></div>
                            <span>Hyderabad</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Lahore')">
                            <div class="icon-box"><i class="fa fa-university"></i></div>
                            <span>Lahore</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Islamabad')">
                            <div class="icon-box"><i class="fa fa-tree"></i></div>
                            <span>Islamabad</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Multan')">
                            <div class="icon-box"><i class="fa fa-fort-awesome"></i></div>
                            <span>Multan</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Gujranwala')">
                            <div class="icon-box"><i class="fa fa-industry"></i></div>
                            <span>Gujranwala</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Sialkot')">
                            <div class="icon-box"><i class="fa fa-futbol-o"></i></div>
                            <span>Sialkot</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Faisalabad')">
                            <div class="icon-box"><i class="fa fa-industry"></i></div>
                            <span>Faisalabad</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Rahim Yar Khan')">
                            <div class="icon-box"><i class="fa fa-map-marker"></i></div>
                            <span>Rahim Yar<br>Khan</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Bahawalpur')">
                            <div class="icon-box"><i class="fa fa-university"></i></div>
                            <span>Bahawalpur</span>
                        </div>
                        <div class="city-item" onclick="selectCity(this, 'Larkana')">
                            <div class="icon-box"><i class="fa fa-map-marker"></i></div>
                            <span>Larkana</span>
                        </div>
                    </div>
HTML;

$dynamic_cities = <<<HTML
                    <div class="city-grid">
                        @php
                            \$activeCities = \App\Models\City::where('status', 'active')->get();
                        @endphp
                        @foreach(\$activeCities as \$key => \$city)
                        <div class="city-item {{\$(key) == 0 ? 'active' : ''}}" onclick="selectCity(this, '{{\$city->name}}', {{\$city->id}})">
                            <div class="icon-box"><i class="{{\$city->icon}}"></i></div>
                            <span>{{\$city->name}}</span>
                        </div>
                        @endforeach
                    </div>
HTML;
$content = str_replace($static_cities, $dynamic_cities, $content);

// Replace static select
$static_area = <<<HTML
                    <div class="select-location-wrap">
                        <label>Please select your area</label>
                        <select id="areaSelect">
                            <option value="">Select Area</option>
                            <option value="clifton">Clifton</option>
                            <option value="dha">DHA</option>
                            <option value="gulshan">Gulshan-e-Iqbal</option>
                        </select>
                    </div>
HTML;
$dynamic_area = <<<HTML
                    <div class="select-location-wrap">
                        <label>Please select your area</label>
                        <select id="areaSelect">
                            <option value="">Select Area</option>
                        </select>
                    </div>
HTML;
$content = str_replace($static_area, $dynamic_area, $content);

// Replace JS function
$static_js = <<<JS
    function selectCity(element, city) {
        document.querySelectorAll('.city-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        // Logic for fetching areas based on city
        console.log("Selected city:", city);
    }
JS;
$dynamic_js = <<<JS
    let selectedCityName = '';
    function selectCity(element, city, cityId) {
        document.querySelectorAll('.city-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        selectedCityName = city;
        
        let areaSelect = document.getElementById('areaSelect');
        areaSelect.innerHTML = '<option value="">Loading areas...</option>';
        
        fetch(`/api/areas/\${cityId}`)
            .then(res => res.json())
            .then(areas => {
                areaSelect.innerHTML = '<option value="">Select Area</option>';
                areas.forEach(area => {
                    let option = document.createElement('option');
                    option.value = area.name;
                    option.textContent = area.name + (area.delivery_charges > 0 ? ' (Rs ' + area.delivery_charges + ')' : '');
                    areaSelect.appendChild(option);
                });
            })
            .catch(err => {
                console.error(err);
                areaSelect.innerHTML = '<option value="">Failed to load areas</option>';
            });
    }

    // Load initial areas for the first active city if available
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            let activeCity = document.querySelector('.city-item.active');
            if(activeCity) {
                activeCity.click();
            }
        }, 500);
    });
JS;
$content = str_replace($static_js, $dynamic_js, $content);

// Replace confirm logic to use selectedCityName
$content = str_replace(
    "let selectedCity = document.querySelector('.city-item.active span').innerText;",
    "let selectedCity = selectedCityName || (document.querySelector('.city-item.active span') ? document.querySelector('.city-item.active span').innerText : '');",
    $content
);

file_put_contents($file, $content);
echo "Frontend modal updated dynamically.\n";
