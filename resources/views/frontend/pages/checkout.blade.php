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

<!-- Start Shop Services Area  -->
<section class="shop-services section home">
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
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over Rs:1000</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>7 Days Return</h4>
                    <p>Original box required</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Price</h4>
                    <p>Guaranteed price</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
    <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        <h4>Newsletter</h4>
                        <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                        <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                            <input name="EMAIL" placeholder="Your email address" required="" type="email">
                            <button class="btn">Subscribe</button>
                        </form>
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->
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
@endpush