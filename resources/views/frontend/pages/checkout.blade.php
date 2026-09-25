@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
                                @php
                            $firstName = old('first_name');
                            $lastName = old('last_name');
                            $email = old('email');
                            if (auth()->check()) {
                                if (!$firstName && !$lastName) {
                                    $nameParts = explode(' ', auth()->user()->name, 2);
                                    $firstName = $nameParts[0] ?? '';
                                    $lastName = $nameParts[1] ?? '';
                                }
                                $email = $email ?? auth()->user()->email;
                            }
                        @endphp
                        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <form class="form" method="POST" action="{{route('cart.order')}}">
            @csrf
                                    @php
                            $firstName = old('first_name');
                            $lastName = old('last_name');
                            $email = old('email');
                            if (auth()->check()) {
                                if (!$firstName && !$lastName) {
                                    $nameParts = explode(' ', auth()->user()->name, 2);
                                    $firstName = $nameParts[0] ?? '';
                                    $lastName = $nameParts[1] ?? '';
                                }
                                $email = $email ?? auth()->user()->email;
                            }
                        @endphp
                        <div class="row">

                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Make Your Checkout Here</h2>
                        <p>Please register in order to checkout more quickly</p>
                        <!-- Form -->
                                                @php
                            $firstName = old('first_name');
                            $lastName = old('last_name');
                            $email = old('email');
                            if (auth()->check()) {
                                if (!$firstName && !$lastName) {
                                    $nameParts = explode(' ', auth()->user()->name, 2);
                                    $firstName = $nameParts[0] ?? '';
                                    $lastName = $nameParts[1] ?? '';
                                }
                                $email = $email ?? auth()->user()->email;
                            }
                        @endphp
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>First Name<span>*</span></label>
                                    <input type="text" name="first_name" placeholder="" value="{{$firstName}}" required>
                                    @error('first_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Last Name<span>*</span></label>
                                    <input type="text" name="last_name" placeholder="" value="{{$lastName}}" required>
                                    @error('last_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email Address<span>*</span></label>
                                    <input type="email" name="email" placeholder="Email" value="{{$email}}"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                    @error('email')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Phone Number <span>*</span></label>
                                    <input type="number" name="phone" placeholder="" required value="{{old('phone')}}">
                                    @error('phone')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            
                                                        <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>City<span>*</span></label>
                                    <select name="city_id" id="checkoutCity" class="form-control custom-select" required onchange="fetchCheckoutAreas(this.value)">
                                        <option value="">Select City</option>
                                        @php
                                            $checkoutCities = \App\Models\City::where('status', 'active')->get();
                                        @endphp
                                        @foreach($checkoutCities as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Area<span>*</span></label>
                                    <select name="area_id" id="checkoutArea" class="form-control custom-select" required>
                                        <option value="">Select Area</option>
                                    </select>
                                    @error('area_id')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
<div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>House No. / Street Address<span>*</span></label>
                                    <input type="text" name="address1" placeholder="" value="{{old('address1')}}">
                                    @error('address1')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            

                        </div>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>CART TOTALS</h2>
                            <div class="content">
                                <ul>
                                    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Cart Subtotal<span>Rs:{{number_format(Helper::totalCartPrice(),2)}}</span></li>
                                    <li class="shipping">
                                        Shipping Cost
                                        @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                        <select name="shipping" class="nice-select">
                                            <option value="">Select your address</option>
                                            @foreach(Helper::shipping() as $shipping)
                                            <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: Rs:{{$shipping->price}}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <span>Free</span>
                                        @endif
                                    </li>

                                    @if(session('coupon'))
                                    <li class="coupon_price" data-price="{{session('coupon')['value']}}">You Save<span>Rs:{{number_format(session('coupon')['value'],2)}}</span></li>
                                    @endif
                                    @php
                                    $total_amount=Helper::totalCartPrice();
                                    if(session('coupon')){
                                    $total_amount=$total_amount-session('coupon')['value'];
                                    }
                                    @endphp
                                    @if(session('coupon'))
                                    <li class="last" id="order_total_price">Total<span>Rs:{{number_format($total_amount,2)}}</span></li>
                                    @else
                                    <li class="last" id="order_total_price">Total<span>Rs:{{number_format($total_amount,2)}}</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!--/ End Order Widget -->
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>Payments</h2>
                            <div class="content">
                                <div class="checkbox">
                                    <form-group>
                                        <input name="payment_method" type="radio" value="cod"> <label> Cash On Delivery</label><br>
                                    </form-group>

                                </div>
                            </div>
                        </div>
                        <div class="single-widget get-button">
                            <div class="content">
                                <div class="button">
                                    <button type="submit" class="btn">proceed to checkout</button>
                                </div>
                            </div>
                        </div>
                        <!--/ End Button Widget -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!--/ End Checkout -->


<!-- End Shop Services -->


@endsection
@push('styles')
<style>
    li.shipping {
        display: inline-flex;
        width: 100%;
        font-size: 14px;
    }

    li.shipping .input-group-icon {
        width: 100%;
        margin-left: 10px;
    }

    .input-group-icon .icon {
        position: absolute;
        left: 20px;
        top: 0;
        line-height: 40px;
        z-index: 3;
    }

    .form-select {
        height: 30px;
        width: 100%;
    }

    .form-select .nice-select {
        border: none;
        border-radius: 0px;
        height: 40px;
        background: #f6f6f6 !important;
        padding-left: 45px;
        padding-right: 40px;
        width: 100%;
    }

    .list li {
        margin-bottom: 0 !important;
    }

    .list li:hover {
        background: #F7941D !important;
        color: white !important;
    }

    .form-select .nice-select::after {
        top: 14px;
    }
</style>

<style>
    /* ========================================= */
    /* CHECKOUT PAGE MODERN PREMIUM REDESIGN     */
    /* ========================================= */
    
    .shop.checkout {
        background: #fdfdfd;
        padding: 60px 0;
    }
    
    /* Left Column: Form Styling */
    .checkout-form {
        background: #fff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1); border: none;
        border: 1px solid #f0f0f0;
        margin-bottom: 30px;
    }
    .checkout-form h2 {
        font-size: 24px;
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
        text-transform: capitalize;
    }
    .checkout-form p {
        color: #777;
        font-size: 14px;
        margin-bottom: 30px;
    }
    .checkout-form .form-group {
        margin-bottom: 25px;
    }
    .checkout-form .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }
    .checkout-form .form-group label span {
        color: #ff4757;
        margin-left: 3px;
    }
    .checkout-form .form-group input, 
    .checkout-form .form-group select {
        width: 100%;
        height: 52px;
        border-radius: 8px;
        border: 1px solid #e5e5e5;
        padding: 0 15px;
        font-size: 15px;
        background: #fafafa;
        color: #333;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.02);
    }
    .checkout-form .form-group input:focus, 
    .checkout-form .form-group select:focus {
        border-color: var(--primary-color);
        background: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
    }
    .checkout-form .nice-select {
        display: none !important; /* Force hide nice-select if initialized here */
    }
    .checkout-form select.form-control {
        display: block !important; /* Force native select for better mobile UX */
        -webkit-appearance: auto;
    }
    
    /* Right Column: Order Details */
    .order-details {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1); border: none;
        border: 1px solid #f0f0f0;
    }
    .order-details .single-widget {
        margin-bottom: 30px;
    }
    .order-details .single-widget:last-child {
        margin-bottom: 0;
    }
    .order-details .single-widget h2 {
        background: var(--primary-color) !important; color: #fff !important;
        color: #fff !important;
        font-size: 15px;
        font-weight: 700;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .order-details .single-widget .content ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .order-details .single-widget .content ul li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px dashed #eee;
        font-size: 15px;
        color: #555;
    }
    .order-details .single-widget .content ul li span {
        font-weight: 700;
        color: #333;
    }
    .order-details .single-widget .content ul li.last {
        font-size: 18px;
        color: #222;
        font-weight: 800;
        border: none;
        padding-top: 20px;
    }
    .order-details .single-widget .content ul li.last span {
        font-size: 24px;
        color: var(--primary-color);
    }
    
    /* Shipping row customization */
    .order-details .single-widget .content ul li.shipping {
        flex-direction: column;
        align-items: flex-start;
    }
    .order-details .single-widget .content ul li.shipping select {
        width: 100%;
        height: 45px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        margin-top: 10px;
        padding: 0 15px;
        font-size: 14px;
        background: #fdfdfd;
        color: #333;
        display: block !important;
    }
    .order-details .single-widget .content ul li.shipping .nice-select {
        display: none !important;
    }
    
    /* Payment Checkbox */
    .order-details .single-widget .content .checkbox {
        padding: 15px 20px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #eee;
        margin-top: -5px;
    }
    .order-details .single-widget .content .checkbox label {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    .order-details .single-widget .content .checkbox input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-color);
        cursor: pointer;
    }
    
    /* Checkout Button */
    .single-widget.get-button .btn {
        width: 100%;
        height: 55px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: var(--primary-color) !important;
        border: none !important;
        color: #fff !important;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .single-widget.get-button .btn:hover {
        filter: brightness(0.85) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
</style>

@endpush
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

        // Pre-select city and area from modal localstorage
        let savedCityId = localStorage.getItem('checkout_city_id');
        let savedAreaId = localStorage.getItem('checkout_area_id');
        
        if (savedCityId) {
            $('#checkoutCity').val(savedCityId);
            fetchCheckoutAreas(savedCityId, savedAreaId);
        }
    });

    function fetchCheckoutAreas(cityId, autoSelectAreaId = null) {
        let areaSelect = document.getElementById('checkoutArea');
        areaSelect.innerHTML = '<option value="">Loading areas...</option>';
        if(!cityId) {
            areaSelect.innerHTML = '<option value="">Select Area</option>';
            return;
        }
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

<style>
    /* ========================================= */
    /* CHECKOUT PAGE MODERN PREMIUM REDESIGN     */
    /* ========================================= */
    
    .shop.checkout {
        background: #fdfdfd;
        padding: 60px 0;
    }
    
    /* Left Column: Form Styling */
    .checkout-form {
        background: #fff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1); border: none;
        border: 1px solid #f0f0f0;
        margin-bottom: 30px;
    }
    .checkout-form h2 {
        font-size: 24px;
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
        text-transform: capitalize;
    }
    .checkout-form p {
        color: #777;
        font-size: 14px;
        margin-bottom: 30px;
    }
    .checkout-form .form-group {
        margin-bottom: 25px;
    }
    .checkout-form .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }
    .checkout-form .form-group label span {
        color: #ff4757;
        margin-left: 3px;
    }
    .checkout-form .form-group input, 
    .checkout-form .form-group select {
        width: 100%;
        height: 52px;
        border-radius: 8px;
        border: 1px solid #e5e5e5;
        padding: 0 15px;
        font-size: 15px;
        background: #fafafa;
        color: #333;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.02);
    }
    .checkout-form .form-group input:focus, 
    .checkout-form .form-group select:focus {
        border-color: var(--primary-color);
        background: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
    }
    .checkout-form .nice-select {
        display: none !important; /* Force hide nice-select if initialized here */
    }
    .checkout-form select.form-control {
        display: block !important; /* Force native select for better mobile UX */
        -webkit-appearance: auto;
    }
    
    /* Right Column: Order Details */
    .order-details {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1); border: none;
        border: 1px solid #f0f0f0;
    }
    .order-details .single-widget {
        margin-bottom: 30px;
    }
    .order-details .single-widget:last-child {
        margin-bottom: 0;
    }
    .order-details .single-widget h2 {
        background: var(--primary-color) !important; color: #fff !important;
        color: #fff !important;
        font-size: 15px;
        font-weight: 700;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .order-details .single-widget .content ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .order-details .single-widget .content ul li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px dashed #eee;
        font-size: 15px;
        color: #555;
    }
    .order-details .single-widget .content ul li span {
        font-weight: 700;
        color: #333;
    }
    .order-details .single-widget .content ul li.last {
        font-size: 18px;
        color: #222;
        font-weight: 800;
        border: none;
        padding-top: 20px;
    }
    .order-details .single-widget .content ul li.last span {
        font-size: 24px;
        color: var(--primary-color);
    }
    
    /* Shipping row customization */
    .order-details .single-widget .content ul li.shipping {
        flex-direction: column;
        align-items: flex-start;
    }
    .order-details .single-widget .content ul li.shipping select {
        width: 100%;
        height: 45px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        margin-top: 10px;
        padding: 0 15px;
        font-size: 14px;
        background: #fdfdfd;
        color: #333;
        display: block !important;
    }
    .order-details .single-widget .content ul li.shipping .nice-select {
        display: none !important;
    }
    
    /* Payment Checkbox */
    .order-details .single-widget .content .checkbox {
        padding: 15px 20px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #eee;
        margin-top: -5px;
    }
    .order-details .single-widget .content .checkbox label {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    .order-details .single-widget .content .checkbox input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-color);
        cursor: pointer;
    }
    
    /* Checkout Button */
    .single-widget.get-button .btn {
        width: 100%;
        height: 55px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: var(--primary-color) !important;
        border: none !important;
        color: #fff !important;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .single-widget.get-button .btn:hover {
        filter: brightness(0.85) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
</style>

@endpush