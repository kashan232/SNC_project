@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection
@section('title','Shoukat Nimco Center ||  PRODUCT DETAIL')
@section('main-content')

		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="">Shop Details</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->

		<!-- Shop Single -->
		<section class="shop single section py-4">
			<div class="container">
				<div class="snc-product-detail-card mb-4 p-4">
					<div class="row align-items-center">
						<!-- Gallery Column -->
						<div class="col-lg-6 col-12 mb-4 mb-lg-0">
							<div class="snc-gallery-wrapper position-relative">
								<span class="badge-bestseller-floating"><i class="fa fa-star text-warning"></i> Best Seller</span>
								<a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn-wishlist-top-right"><i class="fa fa-heart-o"></i></a>
								
								<div class="snc-main-image-container mb-3 position-relative text-center">
									@php
										$photo=explode(',',$product_detail->photo);
									@endphp
									<img id="sncMainImage" src="{{$photo[0]}}" alt="{{$product_detail->title}}" class="img-fluid py-3">
								</div>
								
								<!-- Thumbnails Grid -->
								@if(count($photo) > 1)
									<div class="snc-thumbnails-grid">
										@foreach($photo as $key => $data)
											<div class="snc-thumb-item @if($key==0) active @endif" onclick="changeSncImage(this, '{{$data}}')">
												<img src="{{$data}}" alt="thumb" class="img-fluid">
											</div>
										@endforeach
									</div>
								@endif
							</div>
						</div>

						<!-- Info Column -->
						<div class="col-lg-6 col-12">
							<div class="snc-product-info-wrap">
								<div class="mb-2">
									<span class="snc-stock-badge">
										<i class="fa fa-check-circle mr-1"></i> In Stock
									</span>
								</div>

								<h2 class="snc-product-title">{{$product_detail->title}}</h2>

								<!-- Rating -->
								<div class="snc-rating-row mb-3">
									<div class="rating-stars text-warning">
										@php $rate=ceil($product_detail->getReview->avg('rate')) @endphp
										@for($i=1; $i<=5; $i++)
											@if($rate>=$i)<i class="fa fa-star"></i>@else<i class="fa fa-star-o text-muted"></i>@endif
										@endfor
									</div>
									<span class="text-muted small ml-2">({{$product_detail['getReview']->count()}} Reviews)</span>
								</div>

								<!-- Price Row -->
								@php
									$after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
								@endphp
								<div class="snc-price-row mb-3">
									<span class="snc-current-price">Rs: {{number_format($after_discount, 2)}}</span>
									@if($product_detail->discount > 0)
										<span class="snc-old-price ml-2">Rs: {{number_format($product_detail->price, 2)}}</span>
										<span class="snc-discount-badge ml-2">- {{$product_detail->discount}}% OFF</span>
									@endif
								</div>

								<!-- Short Summary -->
								<p class="snc-summary-text mb-4">{!! strip_tags($product_detail->summary) !!}</p>

								<!-- Size Selection -->
								@if($product_detail->size)
									<div class="snc-size-wrapper mb-4">
										<label class="snc-label">Size</label>
										<div class="d-flex flex-wrap">
											@php $sizes=explode(',',$product_detail->size); @endphp
											@foreach($sizes as $key => $size)
												<button type="button" class="snc-size-btn @if($key==0) active @endif" onclick="selectSncSize(this)">{{$size}}</button>
											@endforeach
										</div>
									</div>
								@endif

								<!-- Quantity & Cart Form -->
								<form action="{{route('single-add-to-cart')}}" method="POST" class="mb-4">
									@csrf
									<input type="hidden" name="slug" value="{{$product_detail->slug}}">
									<div class="snc-qty-row mb-4">
										<label class="snc-label mb-0 mr-3">Quantity</label>
										<div class="snc-qty-stepper">
											<button type="button" class="snc-qty-btn" onclick="decreaseQty()"><i class="fa fa-minus"></i></button>
											<input type="text" name="quant[1]" id="sncQtyInput" class="snc-qty-input" value="1" readonly>
											<button type="button" class="snc-qty-btn" onclick="increaseQty()"><i class="fa fa-plus"></i></button>
										</div>
									</div>

									<div class="d-flex align-items-center">
										<button type="submit" class="snc-add-cart-btn">
											<i class="fa fa-shopping-cart mr-2"></i> Add to Cart
										</button>
										<a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="snc-wishlist-circle-btn ml-3" title="Add to Wishlist">
											<i class="fa fa-heart-o"></i>
										</a>
									</div>
								</form>

								<!-- Meta Details -->
								<div class="row pt-3 border-top">
									<div class="col-6">
										<div class="snc-meta-box">
											<i class="fa fa-th-large snc-theme-color fs-5 mr-2"></i>
											<div>
												<span class="snc-meta-label">Category</span>
												<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}" class="snc-meta-value">{{$product_detail->cat_info['title']}}</a>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="snc-meta-box">
											<i class="fa fa-cubes snc-theme-color fs-5 mr-2"></i>
											<div>
												<span class="snc-meta-label">Stock</span>
												<span class="snc-stock-pill">{{$product_detail->stock}} Available</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Description / Feature Banner Section -->
				<div class="snc-tab-card mb-5">
					<div class="snc-tab-header">
						<ul class="nav nav-tabs border-0" id="productTabs">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#descTab">Description</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#reviewTab">Reviews ({{$product_detail['getReview']->count()}})</a>
							</li>
						</ul>
					</div>
					<div class="snc-tab-body">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="descTab">
								<div class="row align-items-center">
									<div class="col-md-6 border-right">
										<div class="d-flex align-items-center mb-3">
											<span class="snc-feature-icon-lg"><i class="fa fa-leaf"></i></span>
											<div class="ml-3">
												<h6 class="font-weight-bold mb-0 text-dark">Premium Quality Snacks</h6>
												<p class="text-muted small mb-0">Enjoy the best quality snacks from Shoukat Nimco Center.</p>
											</div>
										</div>
										<div class="text-muted small" style="line-height: 1.7;">
											{!! $product_detail->description !!}
										</div>
									</div>
									<div class="col-md-6 mt-4 mt-md-0">
										<div class="row">
											<div class="col-4 text-center">
												<div class="snc-feature-pill-card">
													<i class="fa fa-leaf snc-theme-color mb-2" style="font-size:24px;"></i>
													<h6 class="font-weight-bold small mb-1">100% Natural</h6>
													<span class="text-muted d-block" style="font-size: 10px;">Ingredients</span>
												</div>
											</div>
											<div class="col-4 text-center">
												<div class="snc-feature-pill-card">
													<i class="fa fa-shield snc-theme-color mb-2" style="font-size:24px;"></i>
													<h6 class="font-weight-bold small mb-1">Hygienically</h6>
													<span class="text-muted d-block" style="font-size: 10px;">Packed</span>
												</div>
											</div>
											<div class="col-4 text-center">
												<div class="snc-feature-pill-card">
													<i class="fa fa-truck snc-theme-color mb-2" style="font-size:24px;"></i>
													<h6 class="font-weight-bold small mb-1">Fast & Reliable</h6>
													<span class="text-muted d-block" style="font-size: 10px;">Delivery</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="reviewTab">
								<div class="comments-section">
									@foreach($product_detail['getReview'] as $rev)
										<div class="d-flex mb-3 p-3 bg-light rounded-16">
											<div class="font-weight-bold bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px;">
												{{ strtoupper(substr($rev->user_info['name'] ?? 'U', 0, 1)) }}
											</div>
											<div class="ml-3">
												<h6 class="font-weight-bold mb-1 small">{{ $rev->user_info['name'] ?? 'Anonymous' }}</h6>
												<div class="text-warning small mb-1">
													@for($i=1;$i<=5;$i++)
														@if($rev->rate>=$i)<i class="fa fa-star"></i>@else<i class="fa fa-star-o text-muted"></i>@endif
													@endfor
												</div>
												<p class="text-muted mb-0 small">{{ $rev->review }}</p>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Shop Single -->

		<!-- Start Most Popular -->
	<div class="product-area most-popular related-product section" style="background-color: var(--primary-color); background-image: url('{{ asset('frontend/img/leaves-pattern.jpg') }}'); background-blend-mode: overlay; background-size: cover; background-attachment: fixed; position: relative;">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title text-center" style="margin-bottom: 50px;">
<span style="color: #fff; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Top Picks</span>
<h2 style="font-family: 'Poppins', sans-serif; font-size: 32px; font-weight: 800; color: #fff; margin-top: 10px;">Related <span style="color: #fff;">Products</span></h2>
</div>
				</div>
            </div>
            <div class="row">
                {{-- {{$product_detail->rel_prods}} --}}
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        @foreach($product_detail->rel_prods as $data)
                            @if($data->id !==$product_detail->id)
                                <!-- Start Modern Product -->
                                <div class="modern-product-card @if($data->stock<=0) card-soldout @endif" style="margin: 10px 5px;">
                                    <!-- Top Badges -->
                                    <div class="card-badges">
                                        @if($data->condition=='hot')
                                            <span class="badge-bestseller"><i class="ti-star"></i> BESTSELLER</span>
                                        @endif
                                        @if($data->discount)
                                            <span class="badge-discount">{{$data->discount}}% OFF</span>
                                        @endif
                                        @if($data->stock<=0)
                                            <span class="badge-soldout">SOLD OUT</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Wishlist Button -->
                                    <a href="{{route('add-to-wishlist',$data->slug)}}" class="btn-wishlist-modern"><i class="ti-heart"></i></a>
                                    
                                    <div class="product-img-modern">
                                        <a href="{{route('product-detail',$data->slug)}}">
                                            @php $photo=explode(',',$data->photo); @endphp
                                            <img src="{{$photo[0]}}" alt="{{$data->title}}">
                                        </a>
                                    </div>
                                    
                                    <div class="product-info-modern">
                                        <h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>
                                        <p class="product-desc">{!! \Illuminate\Support\Str::limit(strip_tags($data->summary), 55) !!}</p>
                                        
                                        <div class="price-row">
                                            @php $after_discount=($data->price-($data->price*$data->discount)/100); @endphp
                                            <span class="current-price">Rs: {{number_format($after_discount,0)}}</span>
                                            @if($data->discount)
                                                <span class="old-price"><del>Rs: {{number_format($data->price,0)}}</del></span>
                                            @endif
                                        </div>
                                        
                                        @if($data->stock<=0)
                                            <button type="button" class="btn-action-modern btn-soldout" disabled style="width:100%; border:none; padding:10px; border-radius:8px;">OUT OF STOCK</button>
                                        @else
                                            <div class="product-action-modern">
                                                <a href="{{route('add-to-cart',$data->slug)}}" class="btn-action-modern btn-cart"><i class="ti-shopping-cart"></i> Cart</a>
                                                <a href="{{route('product-detail',$data->slug)}}" class="btn-action-modern btn-view"><i class="ti-eye"></i> View</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End Modern Product -->

                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->


  <!-- Modal -->
  <div class="modal fade" id="modelExample" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    <div class="single-slider">
                                        <img src="images/modal1.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal2.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal3.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal4.png" alt="#">
                                    </div>
                                </div>
                            </div>
                        <!-- End Product slider -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h2>Flared Shift Dress</h2>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                    <div class="quickview-ratting">
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="#"> (1 customer review)</a>
                                </div>
                                <div class="quickview-stock">
                                    <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                </div>
                            </div>
                            <h3>$29.00</h3>
                            <div class="quickview-peragraph">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                            </div>
                            <div class="size">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Size</h5>
                                        <select>
                                            <option selected="selected">s</option>
                                            <option>m</option>
                                            <option>l</option>
                                            <option>xl</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Color</h5>
                                        <select>
                                            <option selected="selected">orange</option>
                                            <option>purple</option>
                                            <option>black</option>
                                            <option>pink</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="quantity">
                                <!-- Input Order -->
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                            <i class="ti-minus"></i>
                                        </button>
									</div>
                                    <input type="text" name="qty" class="input-number"  data-min="1" data-max="1000" value="1">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </div>
                            <div class="add-to-cart">
                                <a href="#" class="btn">Add to cart</a>
                                <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                            </div>
                            <div class="default-social">
                                <h4 class="share-now">Share:</h4>
                                <ul>
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                    <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

@endsection
@push('styles')
	<style>
		/* Custom SNC Product Detail Layout & Styling */
		.snc-product-detail-card {
			background: #ffffff;
			border-radius: 24px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
			border: 1px solid #f0f0f0;
		}

		.badge-bestseller-floating {
			position: absolute;
			top: 15px;
			left: 15px;
			background: #fff8e7;
			color: #d97706;
			font-weight: 700;
			font-size: 11px;
			padding: 6px 14px;
			border-radius: 20px;
			border: 1px solid #fef3c7;
			z-index: 10;
		}

		.btn-wishlist-top-right {
			position: absolute;
			top: 15px;
			right: 15px;
			width: 36px;
			height: 36px;
			border-radius: 50%;
			background: #ffffff;
			box-shadow: 0 4px 12px rgba(0,0,0,0.1);
			display: flex;
			align-items: center;
			justify-content: center;
			color: #666;
			z-index: 10;
			transition: all 0.2s ease;
		}

		.btn-wishlist-top-right:hover {
			color: #e11d48;
			background: #fff1f2;
		}

		.snc-main-image-container {
			background: #f8fafc;
			border-radius: 20px;
			padding: 20px;
			min-height: 340px;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.snc-main-image-container img {
			width: 100%; max-height: 450px;
			object-fit: contain;
		}

		.snc-thumbnails-grid {
			display: flex;
			gap: 10px;
			justify-content: center;
			flex-wrap: wrap;
		}

		.snc-thumb-item {
			width: 65px;
			height: 65px;
			border-radius: 12px;
			border: 2px solid #e2e8f0;
			padding: 4px;
			cursor: pointer;
			background: #fff;
			transition: all 0.2s ease;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.snc-thumb-item.active {
			border-color: var(--primary-color) !important;
		}

		.snc-thumb-item img {
			max-height: 100%;
			max-width: 100%;
			object-fit: contain;
		}

		.snc-stock-badge {
			display: inline-block;
			background: #dcfce7;
			color: var(--primary-color);
			font-weight: 700;
			font-size: 11px;
			padding: 4px 12px;
			border-radius: 20px;
		}

		.snc-product-title {
			font-size: 28px;
			font-weight: 900;
			color: #1e293b;
			margin-bottom: 8px;
			line-height: 1.3;
		}

		.snc-rating-row {
			display: flex;
			align-items: center;
		}

		.snc-price-row {
			display: flex;
			align-items: baseline;
		}

		.snc-current-price {
			font-size: 32px;
			font-weight: 900;
			color: var(--primary-color) !important;
		}

		.snc-old-price {
			font-size: 18px;
			color: #94a3b8;
			text-decoration: line-through;
		}

		.snc-discount-badge {
			background: #dcfce7;
			color: var(--primary-color);
			font-weight: 700;
			font-size: 11px;
			padding: 4px 10px;
			border-radius: 20px;
		}

		.snc-summary-text {
			color: #64748b;
			font-size: 13px;
			line-height: 1.6;
		}

		.snc-label {
			font-size: 12px;
			font-weight: 700;
			color: #1e293b;
			display: block;
			margin-bottom: 6px;
		}

		.snc-size-btn {
			background: #ffffff;
			border: 1px solid #cbd5e1;
			color: #334155;
			padding: 6px 16px;
			border-radius: 8px;
			font-weight: 700;
			font-size: 13px;
			margin-right: 8px;
			margin-bottom: 8px;
			cursor: pointer;
			transition: all 0.2s ease;
		}

		.snc-size-btn.active, .snc-size-btn:hover {
			background: #1e293b;
			color: #ffffff;
			border-color: #1e293b;
		}

		.snc-qty-row {
			display: flex;
			align-items: center;
		}

		.snc-qty-stepper {
			display: inline-flex;
			align-items: center;
			border: 1px solid #cbd5e1;
			border-radius: 30px;
			overflow: hidden;
			background: #f8fafc;
		}

		.snc-qty-btn {
			border: none;
			background: transparent;
			padding: 6px 14px;
			color: #334155;
			cursor: pointer;
			transition: background 0.2s;
		}

		.snc-qty-btn:hover {
			background: #e2e8f0;
		}

		.snc-qty-input {
			width: 45px;
			border: none;
			background: transparent;
			text-align: center;
			font-weight: 700;
			color: #1e293b;
		}

		.snc-add-cart-btn {
			background: var(--primary-color) !important;
			color: #ffffff !important;
			border: none;
			padding: 12px 28px;
			border-radius: 30px;
			font-weight: 700;
			font-size: 15px;
			cursor: pointer;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
			transition: all 0.2s ease;
			
		}

		.snc-add-cart-btn:hover {
			filter: brightness(0.85);
			transform: translateY(-2px);
			box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
		}

		.snc-wishlist-circle-btn {
			width: 44px;
			height: 44px;
			border-radius: 50%;
			border: 1px solid #cbd5e1;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			color: #64748b;
			font-size: 18px;
			text-decoration: none !important;
			transition: all 0.2s ease;
		}

		.snc-wishlist-circle-btn:hover {
			color: #e11d48;
			border-color: #fda4af;
			background: #fff1f2;
		}

		.snc-meta-box {
			background: #f8fafc;
			padding: 10px 14px;
			border-radius: 12px;
			display: flex;
			align-items: center;
		}

		.snc-meta-label {
			display: block;
			font-size: 10px;
			color: #94a3b8;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.snc-meta-value {
			font-weight: 700;
			font-size: 12px;
			color: #1e293b;
			text-decoration: none !important;
		}

		.snc-stock-pill {
			background: var(--primary-color);
			color: #fff;
			font-size: 10px;
			font-weight: 700;
			padding: 2px 8px;
			border-radius: 10px;
		}

		.snc-tab-card {
			background: #fff;
			border-radius: 20px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
			border: 1px solid #f0f0f0;
			overflow: hidden;
		}

		.snc-tab-header {
			background: #fff;
			border-bottom: 1px solid #f1f5f9;
			padding: 10px 20px 0 20px;
		}

		.snc-tab-header .nav-link {
			border: none !important;
			font-weight: 700;
			color: #64748b !important;
			padding: 12px 24px;
			font-size: 14px;
			background: transparent !important;
			border-bottom: 3px solid transparent !important;
		}

		.snc-tab-header .nav-link.active {
			color: var(--primary-color) !important;
			border-bottom-color: var(--primary-color) !important;
		}

		.snc-tab-body {
			padding: 24px;
		}

		.snc-feature-icon-lg {
			width: 44px;
			height: 44px;
			border-radius: 50%;
			background: #dcfce7;
			color: var(--primary-color);
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 20px;
		}

		.snc-feature-pill-card {
			background: #f8fafc;
			border-radius: 16px;
			padding: 16px 8px;
		}

		/* Modern Product Detail Styles */
		.shop.single.section {
			background: #fdfdfd;
			padding-bottom: 80px;
		}
		.product-gallery {
			background: #fff;
			border-radius: 20px;
			padding: 20px;
			box-shadow: 0 10px 40px rgba(0,0,0,0.04);
		}
		.product-gallery img {
			border-radius: 12px;
		}
		.product-des {
			background: #fff;
			border-radius: 20px;
			padding: 40px;
			box-shadow: 0 10px 40px rgba(0,0,0,0.04);
			height: 100%;
		}
		.product-des .short h4 {
			font-size: 28px;
			font-weight: 800;
			color: #111;
			margin-bottom: 15px;
			line-height: 1.3;
		}
		.product-des .short .price {
			margin-top: 25px;
			margin-bottom: 25px;
			display: flex;
			align-items: center;
			gap: 15px;
			border-bottom: 1px solid #f0f0f0;
			padding-bottom: 25px;
		}
		.product-des .short .price .discount {
			font-size: 32px;
			font-weight: 900;
			color: var(--primary-color) !important;
		}
		.product-des .short .price s {
			font-size: 18px;
			color: #999;
		}
		.product-des .description {
			font-size: 15px;
			line-height: 1.8;
			color: #666;
		}
		.product-buy .quantity {
			display: flex;
			align-items: center;
			gap: 20px;
			margin-bottom: 25px;
		}
		.product-buy .quantity h6 {
			font-weight: 700;
			margin: 0;
			font-size: 16px;
		}
		.add-to-cart .btn {
			background: var(--primary-color);
			color: #fff;
			border-radius: 12px;
			padding: 15px 40px;
			font-weight: 700;
			font-size: 16px;
			box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
			transition: all 0.3s ease;
			border: none;
		}
		.add-to-cart .btn:hover {
			transform: translateY(-3px);
			box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
			background: var(--primary-color);
			filter: brightness(0.85);
		}
		.add-to-cart .btn.min {
			background: #f4f5f7;
			color: #ff4757;
			padding: 15px 20px;
			box-shadow: none;
		}
		.add-to-cart .btn.min:hover {
			background: #ff4757;
			color: #fff;
			box-shadow: 0 8px 20px rgba(255, 71, 87, 0.3);
		}
		
		.product-info {
			background: #fff;
			border-radius: 20px;
			padding: 30px;
			margin-top: 40px;
			box-shadow: 0 10px 40px rgba(0,0,0,0.04);
		}
		.product-info .nav-tabs {
			border-bottom: 2px solid #f0f0f0;
		}
		.product-info .nav-tabs .nav-link {
			border: none;
			color: #777;
			font-weight: 700;
			font-size: 16px;
			padding: 15px 30px;
		}
		.product-info .nav-tabs .nav-link.active {
			color: var(--primary-color) !important;
			border-bottom: 3px solid var(--primary-color) !important;
			background: transparent;
		}
		
		.cat-badge {
			display: inline-block;
			background: #f4f5f7;
			padding: 5px 12px;
			border-radius: 6px;
			color: #333;
			font-weight: 600;
			font-size: 13px;
			text-decoration: none;
			margin-left: 10px;
		}
		.cat-badge:hover {
			background: var(--primary-color);
			color: #fff;
		}

		/* Product Cards */
    .modern-product-card {
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        position: relative;
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .modern-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    }
    .card-soldout {
        opacity: 0.6;
    }
    
    .card-badges {
        position: absolute;
        top: 20px;
        left: 20px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        z-index: 5;
    }
    .card-badges span {
        font-size: 9px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 6px;
        color: #fff;
        letter-spacing: 0.5px;
    }
    .badge-bestseller { background: #fdb813; color: #fff; }
    .badge-discount { background: #111; color: #fff; }
    .badge-soldout { background: #6c757d; color: #fff; }
    
    .btn-wishlist-modern {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ff4757;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        font-size: 16px;
        font-weight: bold;
        z-index: 5;
        transition: all 0.3s ease;
    }
    .btn-wishlist-modern:hover {
        background: #ff4757;
        color: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(255, 71, 87, 0.3);
    }
    
    .product-img-modern {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 25px;
    }
    .product-img-modern img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    .modern-product-card:not(.card-soldout):hover .product-img-modern img {
        transform: scale(1.08);
    }
    
    .product-info-modern {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .product-info-modern h3 {
        margin: 0 0 8px 0;
    }
    .product-info-modern h3 a {
        font-size: 16px;
        font-weight: 800;
        color: #111;
        text-decoration: none;
        line-height: 1.4;
    }
    .product-desc {
        font-size: 12px;
        color: #888;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
    }
    
    .price-row {
        margin-top: auto;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .current-price {
        font-size: 22px;
        font-weight: 900;
        color: #111;
    }
    .old-price del {
        font-size: 13px;
        font-weight: 600;
        color: #aaa;
    }
    
    .product-action-modern {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    .btn-action-modern {
        
        text-align: center;
        padding: 10px 5px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    
    .btn-cart {
        background: var(--primary-color);
        color: #ffffff !important;
    }
    
    .btn-cart i {
        color: #ffffff !important;
    }
    
    .btn-cart:hover {
        background: var(--primary-color);
        filter: brightness(0.85);
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    
    .btn-view {
        background: #f4f5f7;
        color: #333 !important;
    }
    
    .btn-view i {
        color: #333 !important;
    }
    
    .btn-view:hover {
        background: #e2e4e8;
        color: #111 !important;
        transform: translateY(-2px);
    }
    
    .btn-soldout {
        background: #e9ecef !important;
        color: #888 !important;
        cursor: not-allowed;
        width: 100%;
        padding: 12px;
        border-radius: 8px;
    }
    .btn-soldout:hover {
        transform: none;
        box-shadow: none;
    }
    

		/* Rating */
		.rating_box {
		display: inline-flex;
		}

		.star-rating {
		font-size: 0;
		padding-left: 10px;
		padding-right: 10px;
		}

		.star-rating__wrap {
		display: inline-block;
		font-size: 1rem;
		}

		.star-rating__wrap:after {
		content: "";
		display: table;
		clear: both;
		}

		.star-rating__ico {
		float: right;
		padding-left: 2px;
		cursor: pointer;
		color: var(--primary-color) !important;
		font-size: 16px;
		margin-top: 5px;
		}

		.star-rating__ico:last-child {
		padding-left: 0;
		}

		.star-rating__input {
		display: none;
		}

		.star-rating__ico:hover:before,
		.star-rating__ico:hover ~ .star-rating__ico:before,
		.star-rating__input:checked ~ .star-rating__ico:before {
		content: "\F005";
		}

	
    /* FORCE THEME ORANGE OVERRIDES */
    .product-des .short .price .discount, .price .discount, .price span.discount { color: var(--primary-color) !important; }
    .rating i, .ratings i, .rating li i, .rating-main .rating li i, .single-rating .rating i { color: var(--primary-color) !important; }
    .product-info .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active { color: var(--primary-color) !important; border-bottom-color: var(--primary-color) !important; background: transparent !important; background-color: transparent !important; }
    .total-review { color: var(--primary-color) !important; }
    
    /* FORCE HOVER OVERRIDES */
    .product-info .nav-tabs .nav-link:hover, .nav-tabs .nav-item .nav-link:hover { color: var(--primary-color) !important; background: transparent !important; background-color: transparent !important; border-bottom-color: var(--primary-color) !important; }
    .btn:hover, .button .btn:hover, .reply .btn:hover { background: var(--primary-color) !important; background-color: var(--primary-color) !important; color: #fff !important; border-color: var(--primary-color) !important; filter: brightness(0.9) !important; }
    a:hover { color: var(--primary-color) !important; }
    
    /* FORCE HOVER OVERRIDES */
    .product-info .nav-tabs .nav-link:hover, .nav-tabs .nav-item .nav-link:hover { color: var(--primary-color) !important; background: transparent !important; background-color: transparent !important; border-bottom-color: var(--primary-color) !important; }
    .btn:hover, .button .btn:hover, .reply .btn:hover { background: var(--primary-color) !important; background-color: var(--primary-color) !important; color: #fff !important; border-color: var(--primary-color) !important; filter: brightness(0.9) !important; }
    .product-des .short .price .discount, .price .discount, .price span.discount { color: var(--primary-color) !important; }
    .rating i, .ratings i, .rating li i, .rating-main .rating li i, .single-rating .rating i { color: var(--primary-color) !important; }
    .product-info .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active { color: var(--primary-color) !important; border-bottom-color: var(--primary-color) !important; background: transparent !important; background-color: transparent !important; }
    .total-review { color: var(--primary-color) !important; }
    
    /* === OWL CAROUSEL IMAGE FIX === */
    .owl-carousel .owl-item .product-img-modern img { height: 200px !important; width: 100% !important; object-fit: contain !important; display: block !important; margin: 0 auto !important; }
    .card-badges { z-index: 10; }
    .btn-wishlist-modern { z-index: 10; }
    /* === OWL CAROUSEL ARROWS REDESIGN === */
    .related-product .owl-carousel { position: relative; }
    .related-product .owl-nav { margin: 0; }
    .related-product .owl-nav .owl-prev, .related-product .owl-nav .owl-next { position: absolute !important; top: 50% !important; transform: translateY(-50%) !important; width: 45px !important; height: 45px !important; background: #fff !important; color: var(--primary-color) !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important; font-size: 24px !important; line-height: 1 !important; transition: all 0.3s ease !important; z-index: 99; margin: 0 !important; padding: 0 !important; border: 2px solid transparent !important; }
    .related-product .owl-nav .owl-prev { left: -15px !important; }
    .related-product .owl-nav .owl-next { right: -15px !important; }
    .related-product .owl-nav .owl-prev:hover, .related-product .owl-nav .owl-next:hover { background: var(--primary-color) !important; color: #fff !important; border-color: #fff !important; }
    </style>

<style>
/* Mobile specific image adjustments */
@media (max-width: 768px) {
    .snc-main-image-container img {
        max-height: 300px !important;
        width: 100% !important;
        object-fit: contain;
    }
}
</style>


<style>
.snc-theme-color { color: var(--primary-color) !important; }
</style>

@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
	function changeSncImage(element, src) {
		$('#sncMainImage').attr('src', src);
		$('.snc-thumb-item').removeClass('active border-success').addClass('border');
		$(element).addClass('active border-success').removeClass('border');
	}

	function selectSncSize(element) {
		$('.snc-size-btn').removeClass('active btn-dark').addClass('btn-outline-dark');
		$(element).addClass('active btn-dark').removeClass('btn-outline-dark');
	}

	function increaseQty() {
		var input = $('#sncQtyInput');
		var currentVal = parseInt(input.val()) || 1;
		input.val(currentVal + 1);
	}

	function decreaseQty() {
		var input = $('#sncQtyInput');
		var currentVal = parseInt(input.val()) || 1;
		if (currentVal > 1) {
			input.val(currentVal - 1);
		}
	}
</script>

<style>
/* Mobile specific image adjustments */
@media (max-width: 768px) {
    .snc-main-image-container img {
        max-height: 300px !important;
        width: 100% !important;
        object-fit: contain;
    }
}
</style>


<style>
.snc-theme-color { color: var(--primary-color) !important; }
</style>

@endpush
