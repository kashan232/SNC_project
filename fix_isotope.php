<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$new_html = <<<'HTML'
<div class="col-sm-12 col-md-6 col-lg-3 p-b-35 isotope-item {{$product->cat_id}}">
                            <div class="single-product" data-aos="fade-up" data-aos-offset="50">
                                <!-- KFC Stripes -->
                                <div class="kfc-stripes">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                
                                <!-- Wishlist -->
                                <div class="kfc-wishlist">
                                    <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class="ti-heart"></i></a>
                                </div>

                                <div class="product-img">
                                    <a href="{{route('product-detail',$product->slug)}}">
                                        @php
                                        $photo=explode(',',$product->photo);
                                        @endphp
                                        <img class="default-img" src="{{$photo[0]}}" alt="{{$product->title}}">
                                    </a>
                                </div>
                                
                                <div class="product-content">
                                    <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                    
                                    <div class="product-desc">
                                        {!! strip_tags($product->summary) !!}
                                    </div>
                                    
                                    <div class="product-price">
                                        @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                        @endphp
                                        <span>Rs {{number_format($after_discount,0)}}</span>
                                    </div>
                                </div>
                                
                                <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}" class="kfc-add-btn">
                                    <i class="ti-plus"></i> ADD TO BUCKET
                                </a>
                            </div>
                        </div>
HTML;

$c = preg_replace('/<div class="col-sm-12 col-md-6 col-lg-3 p-b-35 isotope-item \{\{\$product->cat_id\}\}">.*?<div class="product-content">.*?<\/div>\s*<\/div>\s*<\/div>/is', $new_html, $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Cleaned up isotope items.\n";
