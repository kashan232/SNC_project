@extends('frontend.layouts.master')

@section('title','Shoukat Nimco Center ||  Exchange & Return Policy')

@section('main-content')

<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="{{ url()->previous() }}">Back</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="about-us section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center mb-5">
				<h2 class="font-weight-bold">Exchange & Return Policy</h2>
				<p class="text-muted">Please read our return and exchange process carefully</p>
			</div>
		</div>

		<div class="row">
			<!-- Return Policy -->
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="policy-card h-100">
					<div class="icon-circle"><i class="ti-reload"></i></div>
					<h4 class="card-title">Return Policy</h4>
					<p>
						You can return items within <strong>7 working days</strong> of delivery if they’re unused, unwashed,
						and in their original packaging. Please ensure the tags are intact. Refunds will be processed
						once the item is received and inspected.
					</p>
				</div>
			</div>

			<!-- Exchange Process -->
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="policy-card h-100">
					<div class="icon-circle"><i class="ti-exchange-vertical"></i></div>
					<h4 class="card-title">Exchange Process</h4>
					<p>
						If you received the wrong size or a defective item, you may request an exchange within
						<strong>7 days</strong>. Products must be in original condition and exchange is subject to availability.
						We’ll ship the replacement after inspecting the returned product.
					</p>
				</div>
			</div>

			<!-- Conditions -->
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="policy-card h-100">
					<div class="icon-circle"><i class="ti-check-box"></i></div>
					<h4 class="card-title">Conditions</h4>
					<ul class="pl-3">
						<li>Items must be unused and in original condition.</li>
						<li>Must include all original tags and packaging.</li>
						<li>Final sale products are not eligible.</li>
						<li>Change of mind returns not accepted.</li>
					</ul>
				</div>
			</div>
		</div>

		<!-- How to Initiate -->
		<div class="row mt-5">
			<div class="col-lg-12">
				<div class="policy-card">
					<div class="icon-circle"><i class="ti-direction"></i></div>
					<h4 class="card-title">How to Initiate a Return or Exchange</h4>
					<ol>
						<li>Log in to your account and go to <strong>My Orders</strong>.</li>
						<li>Select the item and choose “Return” or “Exchange”.</li>
						<li>Follow the instructions and submit your request.</li>
						<li>Print the return label and securely pack the item.</li>
						<li>Drop off at your nearest courier point.</li>
						<li>Track the return status from your account dashboard.</li>
					</ol>
				</div>
			</div>
		</div>

		<!-- Note Section -->
		<div class="row mt-4">
			<div class="col-lg-12">
				<div class="note-box">
					<i class="ti-info-alt mr-2"></i>
					<strong>Need more help?</strong> Visit our
					<a href="{{ url('/contact') }}">Contact Page</a>
					and our team will assist you.
				</div>
			</div>
		</div>
	</div>
</section>

<section class="shop-services section">
	<div class="container">
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

@include('frontend.layouts.newsletter')

<!-- Custom CSS -->
<style>
	.policy-card {
		background: #fff;
		border-radius: 14px;
		padding: 25px 20px;
		box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
		transition: all 0.3s ease;
		text-align: justify;
	}

	.policy-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
	}

	.icon-circle {
		width: 60px;
		height: 60px;
		background: #000;
		color: #fff;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 26px;
		border-radius: 50%;
		margin-bottom: 15px;
	}

	.card-title {
		font-weight: 600;
		margin-bottom: 15px;
		color: #333;
	}

	.policy-card p,
	.policy-card li {
		color: #555;
		font-size: 15px;
		line-height: 1.7;
	}

	.note-box {
		background: #f4fdf8;
		border: 1px solid #d6f0e0;
		padding: 15px 20px;
		border-radius: 8px;
		font-size: 15px;
		color: #2c3e50;
		display: inline-flex;
		width: 100%;
		align-items: center;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
	}

	.note-box a {
		color: #4ba064;
		font-weight: 500;
		text-decoration: underline;
	}
</style>
@endsection