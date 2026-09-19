<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$old = <<<'HTML'
                            <div class="single-product" data-aos="fade-up" data-aos-offset="50">
                                  <div class="product-img">
                                      <a href="{{route('product-detail',$product->slug)}}">
                                          @php
                                          $photo=explode(',',$product->photo);
                                          // dd($photo);
                                          @endphp
                                          <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                          <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                          @if($product->stock<=0)
                                              <span class="out-of-stock">Sale out</span>
                                          @elseif($product->condition=='new')
                                              <span class="new">New</span
                                          @elseif($product->condition=='hot')
                                              <span class="hot">Hot</span>
                                          @else
                                              <span class="price-dec">{{$product->discount}}% Off</span>
                                          @endif
                                      </a>
                                      <div class="button-head">
                                          <div class="product-action">
                                              <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                              <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" class="wishlist" data-id="{{$product->id}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                          </div>
                                          <div class="product-action-2">
                                              <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}">Add to cart</a>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="product-content">
                                      <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                      <div class="product-price">
                                          @php
                                              $after_discount=($product->price-($product->price*$product->discount)/100);
                                          @endphp
                                          <span>Rs. {{number_format($after_discount,2)}}</span>
                                          <del style="padding-left:4%;">Rs. {{number_format($product->price,2)}}</del>
                                      </div>
                                  </div>
                              </div>
HTML;

$new = <<<'HTML'
                            <div class="single-product kfc-single-product" data-aos="fade-up" data-aos-offset="50">
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
HTML;

$c = str_replace($old, $new, $c);

// Add CSS
$kfc_css = <<<'CSS'
      /* === KFC STYLE PRODUCT CARD === */
      .single-product.kfc-single-product {
          background: #fdfdfd !important;
          border-radius: 10px !important;
          box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
          padding: 0 !important;
          margin-bottom: 30px !important;
          position: relative !important;
          overflow: hidden !important;
          display: flex !important;
          flex-direction: column !important;
          height: 100% !important;
          min-height: 400px;
          border: 1px solid #eee;
      }

      /* KFC Top Stripes */
      .single-product .kfc-stripes {
          position: absolute;
          top: 0;
          left: 50%;
          transform: translateX(-50%);
          display: flex;
          gap: 5px;
          z-index: 10;
      }
      .single-product .kfc-stripes span {
          width: 14px;
          height: 25px;
          background-color: #E4002B; /* KFC Red */
          display: block;
      }

      /* Wishlist Heart Icon Top Right */
      .single-product .kfc-wishlist {
          position: absolute;
          top: 15px;
          right: 15px;
          z-index: 10;
      }
      .single-product .kfc-wishlist a {
          color: #E4002B;
          font-size: 20px;
      }
      .single-product .kfc-wishlist a:hover {
          color: #b50020;
      }

      .single-product.kfc-single-product .product-img {
          width: 100% !important;
          height: 200px !important;
          padding: 30px 15px 10px 15px !important;
          background: transparent !important;
          display: flex;
          align-items: center;
          justify-content: center;
      }
      .single-product.kfc-single-product .product-img img {
          max-height: 100% !important;
          width: auto !important;
          object-fit: contain !important;
      }

      .single-product.kfc-single-product .product-content {
          padding: 10px 20px 70px 20px !important;
          text-align: left !important;
          display: flex !important;
          flex-direction: column !important;
          flex-grow: 1 !important;
      }

      .single-product.kfc-single-product .product-content h3 {
          margin-bottom: 5px !important;
      }

      .single-product.kfc-single-product .product-content h3 a {
          font-weight: 800 !important;
          font-size: 17px !important;
          color: #000 !important;
          text-transform: capitalize !important;
      }

      .single-product.kfc-single-product .product-content .product-desc {
          font-size: 13px !important;
          color: #555 !important;
          line-height: 1.4 !important;
          margin-bottom: 12px !important;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
      }

      .single-product.kfc-single-product .product-content .product-price {
          font-weight: 800 !important;
          font-size: 16px !important;
          color: #000 !important;
          margin-top: auto !important;
          display: flex;
          align-items: center;
      }

      /* Add to bucket button */
      .single-product.kfc-single-product .kfc-add-btn {
          position: absolute;
          bottom: 15px;
          left: 50%;
          transform: translateX(-50%);
          width: 80%;
          justify-content: center;
          background: #E4002B; /* KFC Red */
          color: #fff;
          font-weight: 800;
          font-size: 14px;
          text-transform: uppercase;
          padding: 10px 20px;
          border-radius: 6px;
          white-space: nowrap;
          border: 2px solid #fff;
          box-shadow: 0 2px 5px rgba(0,0,0,0.2);
          transition: 0.3s;
          display: flex;
          align-items: center;
          gap: 6px;
      }
      .single-product.kfc-single-product .kfc-add-btn:hover {
          background: #b50020;
          color: #fff;
      }
CSS;

$c = preg_replace('/(\/\* === EMERGENCY FIX FOR LAYOUT === \*\/)/s', $kfc_css . "\n      $1", $c);

// NOW CLEAN UP BANNER CSS
$c = preg_replace('/#Gslider \.carousel-item::after\s*{[^}]*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-inner\s*{\s*height:\s*85vh;\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-item\s*{\s*height:\s*100%;\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-inner img\s*{[^}]*}/s', "      #Gslider .carousel-inner img {\n          width: 100% !important;\n          height: auto !important;\n          display: block;\n      }", $c);
$c = preg_replace('/#Gslider \.carousel-item\.active img\s*{\s*transform:\s*scale\(1\.05\);\s*\/\* Slight zoom on active \*\/\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-item\.active img\s*{\s*transform:\s*scale\(1\.08\);\s*\/\* Slow zoom in \*\/\s*}/s', '', $c);
$c = preg_replace('/#Gslider \.carousel-item img\s*{\s*transition: transform 6s ease-in-out;\s*transform: scale\(1\);\s*}/s', '', $c);
$c = preg_replace('/section#Gslider \.carousel-inner\s*{\s*height:\s*85vh\s*!important;\s*}/i', '', $c);
$c = preg_replace('/section#Gslider \.carousel-item\s*{\s*height:\s*100%\s*!important;\s*}/i', '', $c);
$c = preg_replace('/section#Gslider \.carousel-inner img\.first-slide\s*{[^}]*}/i', '', $c);
$c = preg_replace('/@media\s*\(max-width:\s*768px\)\s*{\s*section#Gslider \.carousel-inner\s*{\s*height:\s*70vh\s*!important;\s*}\s*}/i', '', $c);
$c = preg_replace('/style="width: 100%; height: auto; object-fit: cover;"/i', 'style="width: 100%; height: auto;"', $c);

$bulletproof = <<<'CSS'
<style>
    /* Absolute Bulletproof overrides for Banner */
    #Gslider .carousel-item::after, 
    #Gslider .carousel-item::before {
        display: none !important;
        background: none !important;
    }
    #Gslider .carousel-inner img {
        opacity: 1 !important;
        transform: none !important;
        width: 100% !important;
        height: auto !important;
        max-height: none !important;
    }
    #Gslider .carousel-inner {
        height: auto !important;
        min-height: 0 !important;
    }
    #Gslider .carousel-item {
        height: auto !important;
    }
</style>
CSS;
$c = str_replace('<!-- Slider Area -->', '<!-- Slider Area -->' . "\n" . $bulletproof, $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Rebuilt all changes successfully.\n";
