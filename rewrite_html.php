<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

// Replace Featured Products HTML block
$featured_old = <<<HTML
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-img">
                            <a href="{{route('product-detail',\$product->slug)}}">
                                @php
                                \$photo=explode(',',\$product->photo);
                                // dd(\$photo);
                                @endphp
                                <img class="default-img" src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                                <img class="hover-img" src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                                {{-- <span class="out-of-stock">Hot</span> --}}
                            </a>
                            <div class="button-head">
                                <div class="product-action d-flex justify-content-center align-items-center w-100">
                                            <a title="Add to cart" href="{{route('add-to-cart',\$product->slug)}}"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                                            <a data-toggle="modal" data-target="#{{\$product->id}}" title="Quick View" href="#"><i class="ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="{{route('add-to-wishlist',\$product->slug)}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                        </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{route('product-detail',\$product->slug)}}">{{\$product->title}}</a></h3>
                            <div class="product-price">
                                <span class="old">Rs:{{number_format(\$product->price,2)}}</span>
                                @php
                                \$after_discount=(\$product->price-(\$product->price*\$product->discount)/100)
                                @endphp
                                <span>Rs:{{number_format(\$after_discount,2)}}</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
HTML;

// Replace New Arrivals HTML block
$new_old = <<<HTML
                        <!-- Start Single List  -->
                        <div class="single-product">
                            <div class="product-img">
                                <a href="{{route('product-detail',\$product->slug)}}">
                                    @php
                                        \$photo=explode(',',\$product->photo);
                                    @endphp
                                    <img class="default-img" src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                                    <img class="hover-img" src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                                </a>
                                <div class="button-head">
                                    <div class="product-action d-flex justify-content-center align-items-center w-100">
                                            <a title="Add to cart" href="{{route('add-to-cart',\$product->slug)}}"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                                            <a data-toggle="modal" data-target="#{{\$product->id}}" title="Quick View" href="#"><i class="ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="{{route('add-to-wishlist',\$product->slug)}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                        </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{route('product-detail',\$product->slug)}}">{{\$product->title}}</a></h3>
                                <div class="product-price">
                                    @php
                                        \$after_discount=(\$product->price-(\$product->price*\$product->discount)/100);
                                    @endphp
                                    <span>Rs:{{number_format(\$after_discount,2)}}</span>
                                    @if(\$product->discount>0)
                                        <del style="padding-left:4%;">Rs:{{number_format(\$product->price,2)}}</del>
                                    @endif
                                </div>
                            </div>
                          </div>
                          <!-- End Single List  -->
HTML;

$clean_featured = <<<HTML
                    <!-- Start Clean Product Card -->
                    <div class="single-product clean-card">
                        <div class="product-img">
                            <a href="{{route('product-detail',\$product->slug)}}">
                                @php \$photo=explode(',',\$product->photo); @endphp
                                <img class="default-img" src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                            </a>
                            <a class="clean-wishlist" href="{{route('add-to-wishlist',\$product->slug)}}"><i class="ti-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{route('product-detail',\$product->slug)}}">{{\$product->title}}</a></h3>
                            <div class="price-container">
                                @php \$after_discount=(\$product->price-(\$product->price*\$product->discount)/100); @endphp
                                @if(\$product->discount>0)
                                    <del>Rs:{{number_format(\$product->price,2)}}</del>
                                @endif
                                <span class="current-price">Rs:{{number_format(\$after_discount,2)}}</span>
                            </div>
                            <a class="clean-add-cart" href="{{route('add-to-cart',\$product->slug)}}"><i class="ti-shopping-cart"></i></a>
                        </div>
                    </div>
                    <!-- End Clean Product Card -->
HTML;

$clean_new = <<<HTML
                        <!-- Start Clean Product Card -->
                        <div class="single-product clean-card">
                            <div class="product-img">
                                <a href="{{route('product-detail',\$product->slug)}}">
                                    @php \$photo=explode(',',\$product->photo); @endphp
                                    <img class="default-img" src="{{\$photo[0]}}" alt="{{\$photo[0]}}">
                                </a>
                                <a class="clean-wishlist" href="{{route('add-to-wishlist',\$product->slug)}}"><i class="ti-heart"></i></a>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{route('product-detail',\$product->slug)}}">{{\$product->title}}</a></h3>
                                <div class="price-container">
                                    @php \$after_discount=(\$product->price-(\$product->price*\$product->discount)/100); @endphp
                                    @if(\$product->discount>0)
                                        <del>Rs:{{number_format(\$product->price,2)}}</del>
                                    @endif
                                    <span class="current-price">Rs:{{number_format(\$after_discount,2)}}</span>
                                </div>
                                <a class="clean-add-cart" href="{{route('add-to-cart',\$product->slug)}}"><i class="ti-shopping-cart"></i></a>
                            </div>
                        </div>
                        <!-- End Clean Product Card -->
HTML;

$content = str_replace($featured_old, $clean_featured, $content);
$content = str_replace($new_old, $clean_new, $content);

file_put_contents($file, $content);
echo "HTML structure replaced.\n";
