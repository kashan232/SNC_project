@extends('frontend.layouts.master')

@section('title', 'Shoukat Nimco Center ||  PRODUCT PAGE')

@section('main-content')
	<!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
						    <li class="active"><a href="{{ url()->previous() }}">Back</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Product Style -->
    <form action="{{route('shop.filter')}}" method="POST">
        @csrf
        <section class="product-area shop-sidebar shop section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="shop-sidebar">
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Categories</h3>
                                    <ul class="categor-list">
										@php
											$menu=App\Models\Category::getAllParentWithChild();
										@endphp
										@if($menu)
										<li>
											@foreach($menu as $cat_info)
													@if($cat_info->child_cat->count()>0)
														<li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
															<ul>
																@foreach($cat_info->child_cat as $sub_menu)
																	<li><a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">{{$sub_menu->title}}</a></li>
																@endforeach
															</ul>
														</li>
													@else
														<li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a></li>
													@endif
											@endforeach
										</li>
										@endif
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Shop By Price -->
                                    <div class="single-widget range">
                                        <h3 class="title">Shop by Price</h3>
                                        <div class="price-filter">
                                            <div class="price-filter-inner">
                                                @php
                                                    $max=DB::table('products')->max('price');
                                                @endphp
                                                <div id="slider-range" data-min="0" data-max="{{$max}}"></div>
                                                <div class="product_filter">
                                                <button type="submit" class="filter_button">Filter</button>
                                                <div class="label-input">
                                                    <span>Range:</span>
                                                    <input style="" type="text" id="amount" readonly/>
                                                    <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif"/>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Shop By Price -->
                                <!-- Single Widget -->
                                <div class="single-widget recent-post">
                                    <h3 class="title">Recent post</h3>
                                    @foreach($recent_products as $product)
                                        <!-- Single Post -->
                                        @php
                                            $photo=explode(',',$product->photo);
                                        @endphp
                                        <div class="single-post first">
                                            <div class="image">
                                                <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                            </div>
                                            <div class="content">
                                                <h5><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h5>
                                                @php
                                                    $org=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <p class="price"><del class="text-muted">Rs:{{number_format($product->price,2)}}</del>   Rs:{{number_format($org,2)}}  </p>
                                            </div>
                                        </div>
                                        <!-- End Single Post -->
                                    @endforeach
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Brands</h3>
                                    <ul class="categor-list">
                                        @php
                                            $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                                        @endphp
                                        @foreach($brands as $brand)
                                            <li><a href="{{route('product-brand',$brand->slug)}}">{{$brand->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title" style="margin-bottom: 25px; text-align: left;">
                                    <h2 style="font-family: 'Orbitron', sans-serif; font-size: 32px; font-weight: 800; color: #111; border-bottom: 3px solid #036b41; display: inline-block; padding-bottom: 5px;">Our <span style="color: #036b41;">Products</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Shop Top -->
                                <div class="shop-top">
                                    <div class="shop-shorter">
                                        <div class="single-shorter">
                                            <label>Show :</label>
                                            <select class="show" name="show" onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9') selected @endif>09</option>
                                                <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
                                                <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
                                                <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
                                            </select>
                                        </div>
                                        <div class="single-shorter">
                                            <label>Sort By :</label>
                                            <select class='sortBy' name='sortBy' onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title') selected @endif>Name</option>
                                                <option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Price</option>
                                                <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Category</option>
                                                <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand') selected @endif>Brand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <ul class="view-mode">
                                        <li class="active"><a href="javascript:void(0)"><i class="fa fa-th-large"></i></a></li>
                                        <li><a href="{{route('product-lists')}}"><i class="fa fa-th-list"></i></a></li>
                                    </ul>
                                </div>
                                <!--/ End Shop Top -->
                            </div>
                        </div>
                        <div class="row">
                            @if(count($products)>0)
                                @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{route('product-detail',$product->slug)}}">
                                                    @php
                                                        $photo=explode(',',$product->photo);
                                                    @endphp
                                                    <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                    <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                    @if($product->discount)
                                                        <span class="price-dec">{{$product->discount}} % Off</span>
                                                    @endif
                                                </a>
                                                <div class="button-head">
                                                    <div class="product-action d-flex justify-content-center align-items-center w-100">
                                                        <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                                                        <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                                        <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" class="wishlist" data-id="{{$product->id}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                                @php
                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <div class="product-price">
                                                    <span>Rs:{{number_format($after_discount,2)}}</span>
                                                    <del>Rs:{{number_format($product->price,2)}}</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                    <h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12 justify-content-center d-flex">
                                {{$products->appends($_GET)->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    @if($products)
        @foreach($products as $key=>$product)
            <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
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
                                                @php
                                                    $photo=explode(',',$product->photo);
                                                @endphp
                                                @foreach($photo as $data)
                                                    <div class="single-slider">
                                                        <img src="{{$data}}" alt="{{$data}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    <!-- End Product slider -->
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="quickview-content">
                                        <h2>{{$product->title}}</h2>
                                        <div class="quickview-ratting-review">
                                            <div class="quickview-ratting-wrap">
                                                <div class="quickview-ratting">
                                                    @php
                                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                                            <i class="yellow fa fa-star"></i>
                                                        @else
                                                        <i class="fa fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <a href="#"> ({{$rate_count}} customer review)</a>
                                            </div>
                                            <div class="quickview-stock">
                                                @if($product->stock >0)
                                                <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
                                                @else
                                                <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out stock</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                        @endphp
                                        <h3><small><del class="text-muted">Rs:{{number_format($product->price,2)}}</del></small>    Rs:{{number_format($after_discount,2)}}  </h3>
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if($product->size)
                                            <div class="size">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <h5 class="title">Size</h5>
                                                        <select>
                                                            @php
                                                            $sizes=explode(',',$product->size);
                                                            @endphp
                                                            @foreach($sizes as $size)
                                                                <option>{{$size}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <form action="{{route('single-add-to-cart')}}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="quantity">
                                                <!-- Input Order -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="slug" value="{{$product->slug}}">
                                                    <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--/ End Input Order -->
                                            </div>
                                            <div class="add-to-cart">
                                                <button type="submit" class="btn">Add to cart</button>
                                                <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i class="ti-heart"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@push('styles')
<style>
    /* Clean Product Card */
    .single-product {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        background: #fff;
        margin-bottom: 30px;
        position: relative;
    }
    .single-product:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    
    /* Image Area */
    .single-product .product-img {
        position: relative;
        width: 100%;
        background: #f9f9f9;
        text-align: center;
        overflow: hidden;
        border-bottom: 1px solid #eee;
    }
    .single-product .product-img a {
        display: block;
        padding: 20px;
    }
    .single-product .product-img a img {
        width: 100%;
        height: 250px; /* Fixed height for uniformity instead of padding trick */
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    .single-product:hover .product-img a img {
        transform: scale(1.08);
    }

    /* Diagonal Ribbon */
    .single-product .product-img .price-dec {
        position: absolute !important;
        top: 20px !important;
        left: -8px !important;
        background: #ea4335 !important;
        color: #fff !important;
        padding: 5px 15px !important;
        border-radius: 0 4px 4px 0 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        z-index: 9 !important;
        text-align: center !important;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.2) !important;
        margin: 0 !important;
    }
    .single-product .product-img .price-dec::before {
        content: '' !important;
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        border-top: 8px solid #c83025 !important;
        border-left: 8px solid transparent !important;
    }

    /* Action Buttons */
    .product-img .button-head {
        background: transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 0;
        position: absolute;
        bottom: 10px;
        left: 0;
        width: 100%;
        transition: all 0.4s ease;
        z-index: 9;
        border: none;
    }
    .product-action {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row !important;
    }
    .product-action a {
        color: #333 !important;
        font-size: 18px !important;
        margin: 0 5px !important;
        width: 40px !important;
        height: 40px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        background: #fff !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
    }
    .product-action a:hover {
        background: #036b41 !important;
        color: #fff !important;
    }
    .product-action a span {
        display: none !important; /* Hide text */
    }

    /* Product Content (Title & Price) */
    .single-product .product-content {
        padding: 20px;
        text-align: center;
    }
    .single-product .product-content h3 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .single-product .product-content h3 a {
        color: #222;
        transition: color 0.3s ease;
        text-decoration: none;
    }
    .single-product .product-content h3 a:hover {
        color: #036b41;
    }
    .single-product .product-content .product-price {
        font-size: 16px;
        font-weight: 700;
        color: #036b41;
        margin: 0;
        padding: 0;
    }
    .single-product .product-content .product-price del,
    .single-product .product-content .product-price span.old {
        text-decoration: line-through;
        color: #999;
        font-weight: 400;
        margin-right: 8px;
        font-size: 14px;
    }
    .single-product .product-content .product-price span {
        color: #036b41;
        font-weight: 700;
    }
    
    /* Shop Sidebar Improvements */
    .shop-sidebar .single-widget {
        background: #fbfbfb;
        padding: 30px;
        border-radius: 8px;
        margin-bottom: 30px;
        border: 1px solid #eee;
    }
    .shop-sidebar .single-widget .title {
        font-size: 18px;
        font-weight: 700;
        color: #222;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #036b41;
        text-transform: uppercase;
    }
    .shop-sidebar .categor-list li {
        margin-bottom: 10px;
    }
    .shop-sidebar .categor-list li a {
        color: #555;
        font-size: 15px;
        transition: all 0.3s ease;
        display: block;
        text-decoration: none;
    }
    .shop-sidebar .categor-list li a:hover {
        color: #036b41;
        padding-left: 5px;
    }
    .shop-sidebar .categor-list li ul {
        margin-left: 15px;
        margin-top: 10px;
        border-left: 2px solid #eee;
        padding-left: 15px;
    }
    
    /* Filter Price */
    .shop-sidebar .range .price-filter {
        display: block;
        margin-bottom: 20px;
    }
    .ui-slider-horizontal .ui-slider-range {
        background: #036b41 !important;
    }
    .ui-slider .ui-slider-handle {
        border-color: #036b41 !important;
        background: #fff !important;
    }
    .filter_button {
        background: #036b41 !important;
        color: #fff !important;
        padding: 10px 25px !important;
        border-radius: 4px !important;
        border: none !important;
        text-transform: uppercase !important;
        font-weight: 600 !important;
        letter-spacing: 1px !important;
        transition: all 0.3s ease !important;
    }
    .filter_button:hover {
        background: #023a23 !important;
    }

    /* Top Bar Improvements */
    .shop-top {
        background: #fbfbfb;
        padding: 15px 20px;
        border-radius: 8px;
        border: 1px solid #eee;
        margin-bottom: 30px;
    }
    .shop-shorter select {
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        outline: none;
    }
    .pagination {
        display:inline-flex;
    }
</style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500000;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const curr_min = parseInt($("#amount").val()) || min_value;
            const curr_max = parseInt($("#amount").val()) || max_value;
            
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: [curr_min, curr_max],
                slide: function (event, ui) {
                    $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
        }
        });
    </script>
@endpush