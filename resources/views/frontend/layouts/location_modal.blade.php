<style>
    #locationModal .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    #locationModal .modal-header-custom {
        background-color: var(--primary-color);
        padding: 15px;
        text-align: center;
        position: relative;
    }
    #locationModal .modal-header-custom img {
        height: 60px;
        background: white;
        padding: 5px;
        border-radius: 10px;
    }
    #locationModal .delivery-pickup-toggle {
        display: flex;
        justify-content: center;
        background: #f1f1f1;
        border-radius: 30px;
        margin: 15px auto;
        width: max-content;
        padding: 5px;
    }
    #locationModal .toggle-btn {
        padding: 8px 25px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        color: #333;
        transition: 0.3s;
    }
    #locationModal .toggle-btn.active {
        background: var(--primary-color);
        color: white;
    }
    #locationModal .use-current-location {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        border-radius: 20px;
        padding: 8px 15px;
        width: max-content;
        margin: 10px auto;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        background: transparent;
        transition: 0.3s;
    }
    #locationModal .use-current-location:hover {
        background: var(--primary-color);
        color: white;
    }
    #locationModal .city-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        margin-top: 15px;
        justify-items: center;
    }
    #locationModal .city-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        padding: 5px;
        border: 1px dashed transparent;
        border-radius: 8px;
        transition: 0.2s;
    }
    #locationModal .city-item .icon-box {
        width: 50px;
        height: 50px;
        border: 1px dashed #ccc;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 5px;
        font-size: 24px;
        color: #666;
    }
    #locationModal .city-item.active .icon-box {
        border-color: var(--primary-color);
        border-style: solid;
        color: var(--primary-color);
    }
    #locationModal .city-item span {
        font-size: 11px;
        text-align: center;
        color: #333;
        font-weight: 500;
    }
    #locationModal .city-item.active span {
        color: var(--primary-color);
    }
    
    #locationModal .select-location-wrap {
        margin-top: 20px;
        text-align: left;
    }
    #locationModal .select-location-wrap label {
        font-size: 12px;
        font-weight: 600;
        color: #555;
    }
    #locationModal .select-location-wrap select {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 14px;
    }
    #locationModal .btn-select {
        background: var(--primary-color);
        color: white;
        border: none;
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        font-weight: bold;
        margin-top: 15px;
        font-size: 16px;
        transition: 0.3s;
    }
    #locationModal .btn-select:hover {
        background: #c91919;
    }
    #locationModal .modal-body {
        padding: 20px 30px;
    }
    .text-center-heading {
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        color: #666;
        margin-top: 15px;
        margin-bottom: 5px;
    }
</style>

<!-- Location Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header-custom">
                <!-- Close Button -->
                <button type="button" class="close" onclick="closeLocationModal()" aria-label="Close" style="position: absolute; right: 15px; top: 15px; color: white; opacity: 1; font-size: 24px; border: none; background: transparent; cursor: pointer;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Placeholder for Logo -->
                <div style="background: white; border-radius: 8px; padding: 10px; width: max-content; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                    <strong style="color: var(--primary-color); font-size: 18px; font-weight: 900; line-height: 1;">Shoukat<br>Nimco</strong>
                </div>
            </div>
            <div class="modal-body text-center">
                
                <div class="delivery-pickup-toggle">
                    <div class="toggle-btn active" onclick="setOrderType(this, 'delivery')">Delivery</div>
                    <div class="toggle-btn" onclick="setOrderType(this, 'pickup')">Pick-Up</div>
                </div>

                <div id="delivery-section">
                    <div class="text-center-heading">Please select your location</div>
                    
                    <button class="use-current-location" onclick="useCurrentLocation()">
                        <i class="fa fa-crosshairs"></i> Use Current Location
                    </button>

                    <div class="text-center-heading" style="margin-top: 20px;">Please Select City</div>

                    <div class="city-grid">
                        @php
                            $activeCities = \App\Models\City::where('status', 'active')->get();
                        @endphp
                        @foreach($activeCities as $key => $city)
                        <div class="city-item {{$key == 0 ? 'active' : ''}}" onclick="selectCity(this, '{{$city->name}}', {{$city->id}})">
                            <div class="icon-box"><i class="{{$city->icon}}"></i></div>
                            <span>{{$city->name}}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="select-location-wrap">
                        <label>Please select your area</label>
                        <select id="areaSelect">
                            <option value="">Select Area</option>
                        </select>
                    </div>
                </div>

                <div id="pickup-section" style="display: none;">
                    <div class="text-center-heading" style="margin-top: 20px;">Please Select Branch</div>
                    <div class="select-location-wrap">
                        <label>Choose a branch to pick up your order</label>
                        <select id="branchSelect">
                            <option value="">Select Branch</option>
                            @php
                                $pickupOutlets = \App\Models\Outlet::where('status', 'active')->get();
                            @endphp
                            @foreach($pickupOutlets as $outlet)
                                <option value="{{$outlet->id}}">{{$outlet->name}}, {{\Illuminate\Support\Str::limit($outlet->address, 40)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button class="btn-select" onclick="confirmLocation()">Select</button>

            </div>
        </div>
    </div>
</div>

<script>
    function setOrderType(element, type) {
        document.querySelectorAll('.toggle-btn').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        
        if(type === 'delivery') {
            document.getElementById('delivery-section').style.display = 'block';
            document.getElementById('pickup-section').style.display = 'none';
        } else {
            document.getElementById('delivery-section').style.display = 'none';
            document.getElementById('pickup-section').style.display = 'block';
        }
    }

    let selectedCityName = '';
    function selectCity(element, city, cityId) {
        document.querySelectorAll('.city-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        selectedCityName = city;
        
        let areaSelect = document.getElementById('areaSelect');
        areaSelect.innerHTML = '<option value="">Loading areas...</option>';
        
        fetch(`/api/areas/${cityId}`)
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

    // Load initial areas for the first active city if available
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            let activeCity = document.querySelector('.city-item.active');
            if(activeCity) {
                activeCity.click();
            }
        }, 500);
    });

    function closeLocationModal() {
        if (typeof jQuery !== 'undefined') {
            jQuery('#locationModal').modal('hide');
        } else {
            document.getElementById('locationModal').classList.remove('show');
            document.getElementById('locationModal').style.display = 'none';
            let backdrop = document.querySelector('.modal-backdrop');
            if(backdrop) backdrop.remove();
        }
    }

    function useCurrentLocation() {
        let btn = document.querySelector('.use-current-location');
        let originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Fetching...';
        btn.disabled = true;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                let lat = position.coords.latitude;
                let lon = position.coords.longitude;
                
                // Use OpenStreetMap Nominatim API for free reverse geocoding
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&accept-language=en`)
                    .then(response => response.json())
                    .then(data => {
                        let locName = "Current Location";
                        if(data && data.address) {
                            let area = data.address.residential || data.address.neighbourhood || data.address.suburb || data.address.village || data.address.road || '';
                            let city = data.address.city || data.address.town || data.address.state || '';
                            locName = (area ? area + ', ' : '') + city;
                            if(!locName.trim()) locName = "Current Location";

                            // AJAX call to autosave in DB
                            if (city) {
                                fetch('/api/save-location', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ city: city, area: area })
                                }).then(res => res.json()).then(data => {
                                    // Refresh page to load new city in modal if desired, or just quietly succeed
                                }).catch(err => console.error(err));
                            }
                        }
                        
                        localStorage.setItem('saved_location_name', locName);
                        let displayElem = document.getElementById('display-selected-location');
                        if(displayElem) {
                            displayElem.innerText = locName;
                        }
                        localStorage.setItem('location_selected', 'true');
                        closeLocationModal();
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Error fetching location details.");
                    })
                    .finally(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    });
            }, function() {
                alert("Geolocation failed or permission denied.");
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        } else {
            alert("Geolocation is not supported by this browser.");
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }

    function confirmLocation() {
        let isDelivery = document.querySelector('.toggle-btn.active').innerText.trim().toLowerCase() === 'delivery';
        let locName = 'Not Selected';

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
            let branchSelect = document.getElementById('branchSelect');
            if(branchSelect && branchSelect.selectedIndex > 0) {
                locName = branchSelect.options[branchSelect.selectedIndex].text;
            }
        }

        localStorage.setItem('saved_location_name', locName);
        let displayElem = document.getElementById('display-selected-location');
        if(displayElem) {
            displayElem.innerText = locName;
        }

        localStorage.setItem('location_selected', 'true');
        
        // Hide modal
        if (typeof jQuery !== 'undefined') {
            jQuery('#locationModal').modal('hide');
        } else {
            document.getElementById('locationModal').classList.remove('show');
            document.getElementById('locationModal').style.display = 'none';
            let backdrop = document.querySelector('.modal-backdrop');
            if(backdrop) backdrop.remove();
        }
    }

    // Show modal on page load
    document.addEventListener("DOMContentLoaded", function() {
        if(!localStorage.getItem('location_selected')) {
            setTimeout(function() {
                if (typeof jQuery !== 'undefined') {
                    jQuery('#locationModal').modal('show');
                } else {
                    document.getElementById('locationModal').classList.add('show');
                    document.getElementById('locationModal').style.display = 'block';
                }
            }, 500); // Slight delay for smoother appearance
        }
    });
</script>
