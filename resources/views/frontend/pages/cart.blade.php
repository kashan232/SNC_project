@extends('frontend.layouts.master')
@section('title','Cart Page')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody id="cart_item_list">
							<form action="{{route('cart.update')}}" method="POST">
								@csrf
								@if(Helper::getAllProductFromCart())
									@foreach(Helper::getAllProductFromCart() as $key=>$cart)
										<tr>
											@php
											$photo=explode(',',$cart->product['photo']);
											@endphp
											<td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
											<td class="product-des" data-title="Description">
												<p class="product-name"><a href="{{route('product-detail',$cart->product['slug'])}}" target="_blank">{{$cart->product['title']}}</a></p>
												<p class="product-des">{!!($cart['summary']) !!}</p>
											</td>
											<td class="price" data-title="Price"><span>Rs:{{number_format($cart['price'],2)}}</span></td>
											<td class="qty" data-title="Qty"><!-- Input Order -->
												<div class="input-group">
													<div class="button minus">
														<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[{{$key}}]">
															<i class="ti-minus"></i>
														</button>
													</div>
													<input type="text" name="quant[{{$key}}]" class="input-number"  data-min="1" data-max="100" value="{{$cart->quantity}}">
													<input type="hidden" name="qty_id[]" value="{{$cart->id}}">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{$key}}]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
												<!--/ End Input Order -->
											</td>
											<td class="total-amount cart_single_price" data-title="Total"><span class="money">Rs:{{$cart['amount']}}</span></td>

											<td class="action" data-title="Remove"><a href="{{route('cart-delete',$cart->id)}}"><i class="ti-trash remove-icon"></i></a></td>
										</tr>
									@endforeach
									<track>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="float-right">
											<button class="btn float-right" type="submit">Update</button>
										</td>
									</track>
								@else
										<tr>
											<td class="text-center">
												Your cart is empty. <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>

											</td>
										</tr>
								@endif

							</form>
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<div class="left">
									
									{{-- <div class="checkbox">`
										@php
											$shipping=DB::table('shippings')->where('status','active')->limit(1)->get();
										@endphp
										<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox" onchange="showMe('shipping');"> Shipping</label>
									</div> --}}
								</div>
							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">
        Cart Subtotal
        <span>Rs:{{number_format(Helper::totalCartPrice(),2)}}</span>
    </li>

    @if(session()->has('coupon'))
        @php
            $couponId = session()->get('coupon')['id'];
            $couponModel = \App\Models\Coupon::find($couponId);
        @endphp
        <li class="coupon_price" data-price="{{Session::get('coupon')['value']}}" style="display: flex !important; justify-content: space-between !important; align-items: flex-start !important;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <strong style="color: var(--primary-color); font-size: 15px; font-weight: 700;">Coupon Discount</strong>
                @if($couponModel)
                    <small style="color: #888; font-size: 12px; margin-top: 2px;">
                        Code: <span style="color: var(--primary-color); font-weight: 600;">{{$couponModel->code}}</span>
                        @if($couponModel->type == 'percent')
                            ({{(float)$couponModel->value}}% OFF)
                        @elseif($couponModel->type == 'fixed')
                            (Flat Rs:{{(float)$couponModel->value}} OFF)
                        @endif
                    </small>
                @endif
            </div>
            <span style="color: var(--primary-color) !important; font-weight: 700 !important;">-Rs:{{number_format(Session::get('coupon')['value'],2)}}</span>
        </li>
    @endif
    
    @php
        $total_amount=Helper::totalCartPrice();
        if(session()->has('coupon')){
            $total_amount=$total_amount-Session::get('coupon')['value'];
        }
    @endphp
    <li class="last" id="order_total_price">
        Net Amount
        <span>Rs:{{number_format($total_amount,2)}}</span>
    </li>
</ul>
									<div class="coupon">
    <form action="{{route('coupon-store')}}" method="POST">
        @csrf
        @if(session()->has('coupon'))
            <!-- Disabled State -->
            <input name="code" value="{{session()->get('coupon')['code']}}" disabled style="background: #f4f5f7 !important; border-color: #eaeaea !important; color: #888 !important; box-shadow: none !important; font-weight: 600;">
            <button type="button" class="btn" disabled style="background: #b2bec3 !important; color: #fff !important; cursor: not-allowed; pointer-events: none; transform: none !important; box-shadow: none !important;">APPLIED</button>
        @else
            <!-- Active State -->
            <input name="code" placeholder="Enter Your Coupon">
            <button class="btn">Apply</button>
        @endif
    </form>
</div>
									<div class="button5">
										<a href="{{route('checkout')}}" class="btn">Checkout</a>
										<a href="{{route('product-grids')}}" class="btn">Continue shopping</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->

	
	<!-- End Shop Newsletter -->

	<!-- Start Shop Newsletter  -->
	@include('frontend.layouts.newsletter')
	<!-- End Shop Newsletter -->

@endsection
@push('styles')
	<style>
		li.shipping{
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
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:var(--primary-color) !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>

<style>
    .total-amount .right .coupon {
        width: 100% !important;
        max-width: 100% !important;
        margin-top: 15px !important;
        margin-bottom: 20px !important;
        padding-top: 20px !important;
        border-top: 1px dashed #eee !important;
    }
    .total-amount .right .coupon form {
        display: flex !important;
        position: relative !important;
        width: 100% !important;
    }
    .total-amount .right .coupon form input {
        width: 100% !important;
        height: 46px !important;
        padding: 0 100px 0 20px !important;
        border-radius: 30px !important;
        border: 1px solid #ddd !important;
        font-size: 13px !important;
        background: #fdfdfd !important;
        box-shadow: none !important;
    }
    .total-amount .right .coupon form input:focus {
        background: #fff !important;
    }
    .total-amount .right .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 38px !important;
        border-radius: 30px !important;
        padding: 0 18px !important;
        font-size: 12px !important;
    }
</style>


<style>
    /* Final reset for the right box */
    .total-amount .right {
        padding: 30px !important;
        box-sizing: border-box !important;
        width: 100% !important;
    }
    .total-amount .right * {
        box-sizing: border-box !important;
    }
    
    .total-amount .right ul {
        padding: 0 !important;
        margin: 0 0 20px 0 !important;
        width: 100% !important;
    }
    .total-amount .right ul li {
        padding: 0 0 12px 0 !important;
        margin: 0 0 12px 0 !important;
        width: 100% !important;
        text-align: left !important;
        position: relative !important;
    }
    .total-amount .right ul li::before {
        display: none !important; /* hide any stray icons */
    }
    
    .total-amount .right .coupon {
        padding: 20px 0 0 0 !important;
        margin: 0 0 20px 0 !important;
        width: 100% !important;
    }
    .total-amount .right .coupon form {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        display: block !important;
        position: relative !important;
    }
    .total-amount .right .coupon form input {
        width: 100% !important;
        padding-left: 20px !important;
        padding-right: 110px !important; /* space for the button */
        height: 48px !important;
        border-radius: 30px !important;
        margin: 0 !important;
    }
    .total-amount .right .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 40px !important;
        width: 100px !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        font-size: 13px !important;
    }

    .total-amount .right .button5 {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }
    .total-amount .right .button5 .btn {
        margin: 0 0 10px 0 !important;
        width: 100% !important;
        display: block !important;
        box-sizing: border-box !important;
    }
</style>

@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') );
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>














<style>
    /* ========================================= */
    /* CART PAGE UNIFIED MODERN STYLES */
    /* ========================================= */

    /* 1. Main Table Styling */
    .shopping-summery {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-bottom: 30px;
        overflow: hidden;
    }
    .shopping-summery thead {
        background: var(--primary-color) !important;
    }
    .shopping-summery thead tr th {
        color: #fff !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        padding: 18px 20px;
        border: none;
    }
    .shopping-summery thead .remove-icon {
        color: #fff !important;
    }
    .shopping-summery tbody tr {
        border-bottom: 1px solid #f5f5f5;
    }
    .shopping-summery tbody tr:last-child {
        border-bottom: none;
    }
    .shopping-summery tbody tr td {
        vertical-align: middle;
        padding: 20px;
        border: none;
    }
    
    /* Product Info in Table */
    .shopping-summery .cart-img img,
    .shopping-summery .image img {
        border-radius: 8px;
        width: 80px;
        height: 80px;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .shopping-summery .product-name a {
        font-size: 15px;
        font-weight: 700;
        color: #333;
    }
    .shopping-summery .product-name a:hover {
        color: var(--primary-color);
    }
    .shopping-summery .amount, .shopping-summery .money {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary-color);
    }
    
    /* Trash Icon */
    .shopping-summery .action a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 35px;
        height: 35px;
        background: #fff5f5;
        border-radius: 50%;
        color: #ff4757;
        transition: all 0.3s;
    }
    .shopping-summery .action a:hover {
        background: #ff4757;
        color: #fff;
    }

    /* Update Button */
    .btn.float-right {
        background: #f4f5f7 !important;
        color: #333 !important;
        border: none !important;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn.float-right:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }

    /* 2. Quantity Input Redesign */
    .shopping-summery .qty {
        width: 140px;
        text-align: center;
    }
    .shopping-summery .qty .input-group {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;
        width: 110px !important;
        margin: 0 auto !important;
        background: #f8f9fa !important;
        border: 1px solid #e9ecef !important;
        border-radius: 30px !important;
        padding: 3px !important;
    }
    .shopping-summery .qty .input-group .button {
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
    }
    .shopping-summery .qty .input-group .button .btn {
        background: #fff !important;
        color: #333 !important;
        border: none !important;
        border-radius: 50% !important;
        width: 30px !important;
        height: 30px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
        padding: 0 !important;
        transition: all 0.2s !important;
    }
    .shopping-summery .qty .input-group .button .btn:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }
    .shopping-summery .qty .input-group .input-number {
        width: 35px !important;
        height: 30px !important;
        border: none !important;
        background: transparent !important;
        text-align: center !important;
        font-weight: 700 !important;
        color: #333 !important;
        margin: 0 4px !important;
        padding: 0 !important;
    }

    /* 3. Coupon Form Redesign */
    .total-amount .left {
        margin-top: 15px;
    }
    .total-amount .right .coupon {
        width: 100%;
        max-width: 400px;
    }
    .total-amount .right .coupon form {
        display: flex !important;
        position: relative !important;
        width: 100% !important;
    }
    .total-amount .right .coupon form input {
        width: 100% !important;
        height: 48px !important;
        padding: 0 110px 0 20px !important;
        border-radius: 30px !important;
        border: 1px solid #ddd !important;
        font-size: 14px !important;
        background: #fff !important;
        color: #333 !important;
    }
    .total-amount .right .coupon form input:focus {
        border-color: var(--primary-color) !important;
        outline: none !important;
    }
    .total-amount .right .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 40px !important;
        border-radius: 30px !important;
        padding: 0 20px !important;
        background: var(--primary-color) !important;
        color: #fff !important;
        border: none !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.2s !important;
    }
    .total-amount .right .coupon form .btn:hover {
        filter: brightness(0.9) !important;
    }

    /* 4. Subtotal / Total Card Layout */
    .total-amount .right {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-top: 15px;
    }
    .total-amount .right ul {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 0 20px 0 !important;
    }
    .total-amount .right ul li {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        font-size: 15px !important;
        color: #555 !important;
        margin-bottom: 12px !important;
        padding-bottom: 12px !important;
        border-bottom: 1px dashed #eee !important;
    }
    .total-amount .right ul li span {
        font-weight: 700 !important;
        color: #333 !important;
    }
    .total-amount .right ul li.last {
        border: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
        font-size: 16px !important;
        color: #222 !important;
        font-weight: 700 !important;
    }
    .total-amount .right ul li.last span {
        color: var(--primary-color) !important;
        font-size: 22px !important;
    }

    /* Checkout & Continue Shopping Buttons */
    .button5 {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .button5 .btn {
        width: 100% !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        padding: 12px 20px !important;
        background: var(--primary-color) !important;
        border: none !important;
        color: #fff !important;
        text-align: center !important;
        transition: all 0.3s !important;
    }
    .button5 .btn:last-child {
        background: #f4f5f7 !important;
        color: #333 !important;
    }
    .button5 .btn:hover {
        filter: brightness(0.9) !important;
    }
</style>


<style>
    .total-amount .right .coupon {
        width: 100% !important;
        max-width: 100% !important;
        margin-top: 15px !important;
        margin-bottom: 20px !important;
        padding-top: 20px !important;
        border-top: 1px dashed #eee !important;
    }
    .total-amount .right .coupon form {
        display: flex !important;
        position: relative !important;
        width: 100% !important;
    }
    .total-amount .right .coupon form input {
        width: 100% !important;
        height: 46px !important;
        padding: 0 100px 0 20px !important;
        border-radius: 30px !important;
        border: 1px solid #ddd !important;
        font-size: 13px !important;
        background: #fdfdfd !important;
        box-shadow: none !important;
    }
    .total-amount .right .coupon form input:focus {
        background: #fff !important;
    }
    .total-amount .right .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 38px !important;
        border-radius: 30px !important;
        padding: 0 18px !important;
        font-size: 12px !important;
    }
</style>


<style>
    /* Final reset for the right box */
    .total-amount .right {
        padding: 30px !important;
        box-sizing: border-box !important;
        width: 100% !important;
    }
    .total-amount .right * {
        box-sizing: border-box !important;
    }
    
    .total-amount .right ul {
        padding: 0 !important;
        margin: 0 0 20px 0 !important;
        width: 100% !important;
    }
    .total-amount .right ul li {
        padding: 0 0 12px 0 !important;
        margin: 0 0 12px 0 !important;
        width: 100% !important;
        text-align: left !important;
        position: relative !important;
    }
    .total-amount .right ul li::before {
        display: none !important; /* hide any stray icons */
    }
    
    .total-amount .right .coupon {
        padding: 20px 0 0 0 !important;
        margin: 0 0 20px 0 !important;
        width: 100% !important;
    }
    .total-amount .right .coupon form {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        display: block !important;
        position: relative !important;
    }
    .total-amount .right .coupon form input {
        width: 100% !important;
        padding-left: 20px !important;
        padding-right: 110px !important; /* space for the button */
        height: 48px !important;
        border-radius: 30px !important;
        margin: 0 !important;
    }
    .total-amount .right .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 40px !important;
        width: 100px !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        font-size: 13px !important;
    }

    .total-amount .right .button5 {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }
    .total-amount .right .button5 .btn {
        margin: 0 0 10px 0 !important;
        width: 100% !important;
        display: block !important;
        box-sizing: border-box !important;
    }
</style>

@endpush

<style>
    /* ========================================= */
    /* CART PAGE UNIFIED MODERN STYLES */
    /* ========================================= */

    /* 1. Main Table Styling */
    .shopping-summery {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-bottom: 30px;
        overflow: hidden;
    }
    .shopping-summery thead {
        background: var(--primary-color) !important;
    }
    .shopping-summery thead tr th {
        color: #fff !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        padding: 18px 20px;
        border: none;
    }
    .shopping-summery thead .remove-icon {
        color: #fff !important;
    }
    .shopping-summery tbody tr {
        border-bottom: 1px solid #f5f5f5;
    }
    .shopping-summery tbody tr:last-child {
        border-bottom: none;
    }
    .shopping-summery tbody tr td {
        vertical-align: middle;
        padding: 20px;
        border: none;
    }
    
    /* Product Info in Table */
    .shopping-summery .cart-img img,
    .shopping-summery .image img {
        border-radius: 8px;
        width: 80px;
        height: 80px;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .shopping-summery .product-name a {
        font-size: 15px;
        font-weight: 700;
        color: #333;
    }
    .shopping-summery .product-name a:hover {
        color: var(--primary-color);
    }
    .shopping-summery .amount, .shopping-summery .money {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary-color);
    }
    
    /* Trash Icon */
    .shopping-summery .action a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 35px;
        height: 35px;
        background: #fff5f5;
        border-radius: 50%;
        color: #ff4757;
        transition: all 0.3s;
    }
    .shopping-summery .action a:hover {
        background: #ff4757;
        color: #fff;
    }

    /* Update Button */
    .btn.float-right {
        background: #f4f5f7 !important;
        color: #333 !important;
        border: none !important;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s;
        margin-top: 20px;
    }
    .btn.float-right:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }

    /* 2. Quantity Input Redesign */
    .shopping-summery .qty {
        width: 140px;
        text-align: center;
    }
    .shopping-summery .qty .input-group {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;
        width: 110px !important;
        margin: 0 auto !important;
        background: #f8f9fa !important;
        border: 1px solid #e9ecef !important;
        border-radius: 30px !important;
        padding: 3px !important;
    }
    .shopping-summery .qty .input-group .button {
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
    }
    .shopping-summery .qty .input-group .button .btn {
        background: #fff !important;
        color: #333 !important;
        border: none !important;
        border-radius: 50% !important;
        width: 30px !important;
        height: 30px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
        padding: 0 !important;
        transition: all 0.2s !important;
    }
    .shopping-summery .qty .input-group .button .btn:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }
    .shopping-summery .qty .input-group .input-number {
        width: 35px !important;
        height: 30px !important;
        border: none !important;
        background: transparent !important;
        text-align: center !important;
        font-weight: 700 !important;
        color: #333 !important;
        margin: 0 4px !important;
        padding: 0 !important;
    }

    /* 3. Coupon Form Redesign */
    .total-amount .left {
        margin-top: 15px;
    }
    .total-amount .right .coupon {
        width: 100%;
        max-width: 400px;
    }
    .total-amount .right .coupon form {
        display: flex !important;
        position: relative !important;
        width: 100% !important;
    }
    .total-amount .right .coupon form input {
        width: 100% !important;
        height: 48px !important;
        padding: 0 110px 0 20px !important;
        border-radius: 30px !important;
        border: 1px solid #ddd !important;
        font-size: 14px !important;
        background: #fff !important;
        color: #333 !important;
    }
    .total-amount .right .coupon form input:focus {
        border-color: var(--primary-color) !important;
        outline: none !important;
    }
    .total-amount .right .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 40px !important;
        border-radius: 30px !important;
        padding: 0 20px !important;
        background: var(--primary-color) !important;
        color: #fff !important;
        border: none !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.2s !important;
    }
    .total-amount .right .coupon form .btn:hover {
        filter: brightness(0.9) !important;
    }

    /* 4. Subtotal / Total Card Layout */
    .total-amount .right {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-top: 15px;
    }
    .total-amount .right ul {
        display: block !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 0 0 20px 0 !important;
    }
    .total-amount .right ul li {
        display: block !important;
        width: 100% !important;
        overflow: hidden !important;
        font-size: 15px !important;
        color: #555 !important;
        margin-bottom: 12px !important;
        padding-bottom: 12px !important;
        border-bottom: 1px dashed #eee !important;
        line-height: 24px !important;
        text-align: left !important;
    }
    .total-amount .right ul li span {
        float: right !important;
        font-weight: 700 !important;
        color: #333 !important;
    }
    .total-amount .right ul li.last {
        border: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
        font-size: 16px !important;
        color: #222 !important;
        font-weight: 700 !important;
    }
    .total-amount .right ul li.last span {
        color: var(--primary-color) !important;
        font-size: 22px !important;
    }

    /* Checkout & Continue Shopping Buttons */
    .button5 {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .button5 .btn {
        width: 100% !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        padding: 12px 20px !important;
        background: var(--primary-color) !important;
        border: none !important;
        color: #fff !important;
        text-align: center !important;
        transition: all 0.3s !important;
    }
    .button5 .btn.checkout {
        background: var(--primary-color) !important;
        color: #fff !important;
    }
    .button5 .btn:last-child {
        background: #f4f5f7 !important;
        color: #333 !important;
    }
    .button5 .btn:hover {
        filter: brightness(0.9) !important;
    }
</style>
