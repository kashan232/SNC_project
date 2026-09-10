@extends('frontend.layouts.master')

@section('title','Shoukat Nimco Center ||  FAQs')

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
<!-- End Breadcrumbs -->

<section class="faq-section section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center mb-5">
				<h2 class="font-weight-bold">Frequently Asked Questions</h2>
				<p class="text-muted">Find answers to the most common questions below</p>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="accordion" id="faqAccordion">

					<!-- FAQ 1 -->
					<div class="card faq-card">
						<div class="card-header" id="faqOne">
							<h5 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne">
									<i class="ti-search mr-2"></i> How can I track my order?
								</button>
							</h5>
						</div>
						<div id="collapseOne" class="collapse show" data-parent="#faqAccordion">
							<div class="card-body">
								You can track your order by logging into your account and visiting the <strong>My Orders</strong> section. Real-time tracking details are available once your order has been shipped.
							</div>
						</div>
					</div>

					<!-- FAQ 2 -->
					<div class="card faq-card">
						<div class="card-header" id="faqTwo">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo">
									<i class="ti-reload mr-2"></i> What is your return policy?
								</button>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse" data-parent="#faqAccordion">
							<div class="card-body">
								We accept returns within <strong>7 working days</strong> of delivery, provided the item is unused, unwashed, and in its original packaging. Refunds are issued after quality checks.
							</div>
						</div>
					</div>

					<!-- FAQ 3 -->
					<div class="card faq-card">
						<div class="card-header" id="faqThree">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree">
									<i class="ti-exchange-vertical mr-2"></i> Can I exchange an item I purchased?
								</button>
							</h5>
						</div>
						<div id="collapseThree" class="collapse" data-parent="#faqAccordion">
							<div class="card-body">
								Yes, items can be exchanged within <strong>7 days</strong> if they are in their original condition. Exchange requests can be made from your account under <strong>My Orders</strong>.
							</div>
						</div>
					</div>

					<!-- FAQ 4 -->
					<div class="card faq-card">
						<div class="card-header" id="faqFour">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour">
									<i class="ti-timer mr-2"></i> How long does delivery take?
								</button>
							</h5>
						</div>
						<div id="collapseFour" class="collapse" data-parent="#faqAccordion">
							<div class="card-body">
								Standard delivery usually takes <strong>3–5 business days</strong> depending on your location. Delays may occur during holidays or sale events.
							</div>
						</div>
					</div>

					<!-- FAQ 5 -->
					<div class="card faq-card">
						<div class="card-header" id="faqFive">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive">
									<i class="ti-wallet mr-2"></i> Is Cash on Delivery available?
								</button>
							</h5>
						</div>
						<div id="collapseFive" class="collapse" data-parent="#faqAccordion">
							<div class="card-body">
								Yes, we offer <strong>Cash on Delivery</strong> across Pakistan. Please make sure your shipping information is correct before placing the order.
							</div>
						</div>
					</div>

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
	.faq-card {
		border: none;
		margin-bottom: 15px;
		box-shadow: 0 4px 12px rgba(0,0,0,0.08);
		border-radius: 10px;
		overflow: hidden;
	}
	.faq-card .card-header {
		background: #f9f9f9;
		padding: 0;
	}
	.faq-card .btn-link {
		display: block;
		width: 100%;
		text-align: left;
		padding: 15px 20px;
		font-size: 16px;
		font-weight: 600;
		color: #fff;
		text-decoration: none;
		transition: all 0.3s ease;
	}
	.faq-card .btn-link:hover {
		color: #4ba064;
	}
	.faq-card .card-body {
		padding: 20px;
		font-size: 15px;
		color: #555;
		line-height: 1.7;
		text-align: justify;
	}
	.faq-card i {
		color: #4ba064;
		font-size: 18px;
	}
</style>
@endsection
