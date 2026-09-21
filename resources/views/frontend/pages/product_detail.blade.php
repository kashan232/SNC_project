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
		<section class="shop single section">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-lg-6 col-12">
										<!-- Product Slider -->
										<div class="product-gallery">
											<!-- Images slider -->
											<div class="flexslider-thumbnails">
												<ul class="slides">
													@php
														$photo=explode(',',$product_detail->photo);
													// dd($photo);
													@endphp
													@foreach($photo as $data)
														<li data-thumb="{{$data}}" rel="adjustX:10, adjustY:">
															<img src="{{$data}}" alt="{{$data}}">
														</li>
													@endforeach
												</ul>
											</div>
											<!-- End Images slider -->
										</div>
										<!-- End Product slider -->
									</div>
									<div class="col-lg-6 col-12">
										<div class="product-des">
											<!-- Description -->
											<div class="short">
												<h4>{{$product_detail->title}}</h4>
												<div class="rating-main">
													<ul class="rating">
														@php
															$rate=ceil($product_detail->getReview->avg('rate'))
														@endphp
															@for($i=1; $i<=5; $i++)
																@if($rate>=$i)
																	<li><i class="fa fa-star"></i></li>
																@else
																	<li><i class="fa fa-star-o"></i></li>
																@endif
															@endfor
													</ul>
													<a href="#" class="total-review">({{$product_detail['getReview']->count()}}) Review</a>
                                                </div>
                                                @php
                                                    $after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
                                                @endphp
												<p class="price"><span class="discount">Rs:{{number_format($after_discount,2)}}</span><s>Rs:{{number_format($product_detail->price,2)}}</s> </p>
												<p class="description">{!!($product_detail->summary)!!}</p>
											</div>
											<!--/ End Description -->
											<!-- Color -->
											{{-- <div class="color">
												<h4>Available Options <span>Color</span></h4>
												<ul>
													<li><a href="#" class="one"><i class="ti-check"></i></a></li>
													<li><a href="#" class="two"><i class="ti-check"></i></a></li>
													<li><a href="#" class="three"><i class="ti-check"></i></a></li>
													<li><a href="#" class="four"><i class="ti-check"></i></a></li>
												</ul>
											</div> --}}
											<!--/ End Color -->
											<!-- Size -->
											@if($product_detail->size)
												<div class="size mt-4">
													<h4>Size</h4>
													<ul>
														@php
															$sizes=explode(',',$product_detail->size);
															// dd($sizes);
														@endphp
														@foreach($sizes as $size)
														<li><a href="#" class="one">{{$size}}</a></li>
														@endforeach
													</ul>
												</div>
											@endif
											<!--/ End Size -->
											<!-- Product Buy -->
											<div class="product-buy">
												<form action="{{route('single-add-to-cart')}}" method="POST">
													@csrf
													<div class="quantity">
														<h6>Quantity :</h6>
														<!-- Input Order -->
														<div class="input-group">
															<div class="button minus">
																<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
																	<i class="ti-minus"></i>
																</button>
															</div>
															<input type="hidden" name="slug" value="{{$product_detail->slug}}">
															<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1" id="quantity">
															<div class="button plus">
																<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
																	<i class="ti-plus"></i>
																</button>
															</div>
														</div>
													<!--/ End Input Order -->
													</div>
													<div class="add-to-cart mt-4">
														<button type="submit" class="btn">Add to cart</button>
														<a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn min"><i class="ti-heart"></i></a>
													</div>
												</form>

												<p class="cat mt-3" style="font-weight:600; color:#444;">Category: <a href="{{route('product-cat',$product_detail->cat_info['slug'])}}" class="cat-badge">{{$product_detail->cat_info['title']}}</a></p>
												@if($product_detail->sub_cat_info)
												<p class="cat mt-2" style="font-weight:600; color:#444;">Sub Category: <a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}" class="cat-badge">{{$product_detail->sub_cat_info['title']}}</a></p>
												@endif
												<p class="availability mt-3" style="font-weight:600; color:#444;">Stock: 
													@if($product_detail->stock>0)
														<span class="badge badge-success" style="padding: 6px 12px; font-size:13px; border-radius:6px; margin-left:10px;">{{$product_detail->stock}} Available</span>
													@else 
														<span class="badge badge-danger" style="padding: 6px 12px; font-size:13px; border-radius:6px; margin-left:10px;">Out of Stock</span>  
													@endif
												</p>
											</div>
											<!--/ End Product Buy -->
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="product-info">
											<div class="nav-main">
												<!-- Tab Nav -->
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
													<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li>
												</ul>
												<!--/ End Tab Nav -->
											</div>
											<div class="tab-content" id="myTabContent">
												<!-- Description Tab -->
												<div class="tab-pane fade show active" id="description" role="tabpanel">
													<div class="tab-single">
														<div class="row">
															<div class="col-12">
																<div class="single-des">
																	<p>{!! ($product_detail->description) !!}</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--/ End Description Tab -->
												<!-- Reviews Tab -->
												<div class="tab-pane fade" id="reviews" role="tabpanel">
													<div class="tab-single review-panel">
														<div class="row">
															<div class="col-12">

																<!-- Review -->
																<div class="comment-review">
																	<div class="add-review">
																		<h5>Add A Review</h5>
																		<p>Your email address will not be published. Required fields are marked</p>
																	</div>
																	<h4>Your Rating <span class="text-danger">*</span></h4>
																	<div class="review-inner">
																			<!-- Form -->
																@auth
																<form class="form" method="post" action="{{route('review.store',$product_detail->slug)}}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="rating_box">
                                                                                  <div class="star-rating">
                                                                                    <div class="star-rating__wrap">
                                                                                      <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
																					  <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
																					  @error('rate')
																						<span class="text-danger">{{$message}}</span>
																					  @enderror
                                                                                    </div>
                                                                                  </div>
                                                                            </div>
                                                                        </div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group">
																				<label>Write a review</label>
																				<textarea name="review" rows="6" placeholder="" ></textarea>
																			</div>
																		</div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group button5">
																				<button type="submit" class="btn">Submit</button>
																			</div>
																		</div>
																	</div>
																</form>
																@else
																<p class="text-center p-5">
																	You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a>

																</p>
																<!--/ End Form -->
																@endauth
																	</div>
																</div>

																<div class="ratting-main">
																	<div class="avg-ratting">
																		{{-- @php
																			$rate=0;
																			foreach($product_detail->rate as $key=>$rate){
																				$rate +=$rate
																			}
																		@endphp --}}
																		<h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(Overall)</span></h4>
																		<span>Based on {{$product_detail->getReview->count()}} Comments</span>
																	</div>
																	@foreach($product_detail['getReview'] as $data)
																	<!-- Single Rating -->
																	<div class="single-rating">
																		<div class="rating-author">
																			@if($data->user_info['photo'])
																			<img src="{{$data->user_info['photo']}}" alt="{{$data->user_info['photo']}}">
																			@else
																			<img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">
																			@endif
																		</div>
																		<div class="rating-des">
																			<h6>{{$data->user_info['name']}}</h6>
																			<div class="ratings">

																				<ul class="rating">
																					@for($i=1; $i<=5; $i++)
																						@if($data->rate>=$i)
																							<li><i class="fa fa-star"></i></li>
																						@else
																							<li><i class="fa fa-star-o"></i></li>
																						@endif
																					@endfor
																				</ul>
																				<div class="rate-count">(<span>{{$data->rate}}</span>)</div>
																			</div>
																			<p>{{$data->review}}</p>
																		</div>
																	</div>
																	<!--/ End Single Rating -->
																	@endforeach
																</div>

																<!--/ End Review -->

															</div>
														</div>
													</div>
												</div>
												<!--/ End Reviews Tab -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		</section>
		<!--/ End Shop Single -->

		<!-- Start Most Popular -->
	<div class="product-area most-popular related-product section" style="background:#c1540b; padding-top: 60px; padding-bottom: 60px;">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title text-center" style="margin-bottom: 50px;">
<span style="color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Top Picks</span>
<h2 style="font-family: 'Orbitron', sans-serif; font-size: 32px; font-weight: 800; color: #fff; margin-top: 10px;">Related <span style="color: #fff;">Products</span></h2>
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
			color: #F7941D !important;
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
			background: #F7941D;
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
			background: #F7941D;
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
			color: #F7941D !important;
			border-bottom: 3px solid #F7941D !important;
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
			background: #F7941D;
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
        flex: 1;
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
        background: #F7941D;
        color: #ffffff !important;
    }
    
    .btn-cart i {
        color: #ffffff !important;
    }
    
    .btn-cart:hover {
        background: #F7941D;
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
		color: #F7941D !important;
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
    .product-des .short .price .discount, .price .discount, .price span.discount { color: #F7941D !important; }
    .rating i, .ratings i, .rating li i, .rating-main .rating li i, .single-rating .rating i { color: #F7941D !important; }
    .product-info .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active { color: #F7941D !important; border-bottom-color: #F7941D !important; background: transparent !important; background-color: transparent !important; }
    .total-review { color: #F7941D !important; }
    
    /* FORCE HOVER OVERRIDES */
    .product-info .nav-tabs .nav-link:hover, .nav-tabs .nav-item .nav-link:hover { color: #F7941D !important; background: transparent !important; background-color: transparent !important; border-bottom-color: #F7941D !important; }
    .btn:hover, .button .btn:hover, .reply .btn:hover { background: #F7941D !important; background-color: #F7941D !important; color: #fff !important; border-color: #F7941D !important; filter: brightness(0.9) !important; }
    a:hover { color: #F7941D !important; }
    
    /* FORCE HOVER OVERRIDES */
    .product-info .nav-tabs .nav-link:hover, .nav-tabs .nav-item .nav-link:hover { color: #F7941D !important; background: transparent !important; background-color: transparent !important; border-bottom-color: #F7941D !important; }
    .btn:hover, .button .btn:hover, .reply .btn:hover { background: #F7941D !important; background-color: #F7941D !important; color: #fff !important; border-color: #F7941D !important; filter: brightness(0.9) !important; }
    .product-des .short .price .discount, .price .discount, .price span.discount { color: #F7941D !important; }
    .rating i, .ratings i, .rating li i, .rating-main .rating li i, .single-rating .rating i { color: #F7941D !important; }
    .product-info .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active { color: #F7941D !important; border-bottom-color: #F7941D !important; background: transparent !important; background-color: transparent !important; }
    .total-review { color: #F7941D !important; }
    
    /* === OWL CAROUSEL IMAGE FIX === */
    .owl-carousel .owl-item .product-img-modern img { height: 200px !important; width: 100% !important; object-fit: contain !important; display: block !important; margin: 0 auto !important; }
    .card-badges { z-index: 10; }
    .btn-wishlist-modern { z-index: 10; }
    /* === OWL CAROUSEL ARROWS REDESIGN === */
    .related-product .owl-carousel { position: relative; }
    .related-product .owl-nav { margin: 0; }
    .related-product .owl-nav .owl-prev, .related-product .owl-nav .owl-next { position: absolute !important; top: 50% !important; transform: translateY(-50%) !important; width: 45px !important; height: 45px !important; background: #fff !important; color: #F7941D !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important; font-size: 24px !important; line-height: 1 !important; transition: all 0.3s ease !important; z-index: 99; margin: 0 !important; padding: 0 !important; border: 2px solid transparent !important; }
    .related-product .owl-nav .owl-prev { left: -15px !important; }
    .related-product .owl-nav .owl-next { right: -15px !important; }
    .related-product .owl-nav .owl-prev:hover, .related-product .owl-nav .owl-next:hover { background: #F7941D !important; color: #fff !important; border-color: #fff !important; }
    </style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}

@endpush
