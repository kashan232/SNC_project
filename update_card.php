<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$kfc_css = <<<'CSS'
      /* === KFC STYLE PRODUCT CARD === */
      .single-product {
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

      .single-product .product-img {
          width: 100% !important;
          height: 200px !important;
          padding: 30px 15px 10px 15px !important;
          background: transparent !important;
      }
      .single-product .product-img img {
          max-height: 100% !important;
          object-fit: contain !important;
      }

      .single-product .product-content {
          padding: 10px 20px 70px 20px !important;
          text-align: left !important;
          display: flex !important;
          flex-direction: column !important;
          flex-grow: 1 !important;
      }

      .single-product .product-content h3 {
          margin-bottom: 5px !important;
      }

      .single-product .product-content h3 a {
          font-weight: 800 !important;
          font-size: 17px !important;
          color: #000 !important;
          text-transform: capitalize !important;
      }

      .single-product .product-content .product-desc {
          font-size: 13px !important;
          color: #555 !important;
          line-height: 1.4 !important;
          margin-bottom: 12px !important;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
      }

      .single-product .product-content .product-price {
          font-weight: 800 !important;
          font-size: 16px !important;
          color: #000 !important;
          margin-top: auto !important; /* Push to bottom of content */
      }

      /* Add to bucket button */
      .single-product .kfc-add-btn {
          position: absolute;
          bottom: -20px; /* Overlap the bottom border */
          left: 50%;
          transform: translateX(-50%);
          background: #E4002B; /* KFC Red */
          color: #fff;
          font-weight: 800;
          font-size: 14px;
          text-transform: uppercase;
          padding: 10px 20px;
          border-radius: 6px;
          white-space: nowrap;
          border: 2px solid #fff; /* To stand out against background */
          box-shadow: 0 2px 5px rgba(0,0,0,0.2);
          transition: 0.3s;
          display: flex;
          align-items: center;
          gap: 6px;
      }
      
      .single-product:hover .kfc-add-btn {
          bottom: 15px; /* Slide up on hover or stay? Let's just keep it inside */
      }
      
      /* Better to keep it inside at bottom 15px always */
      .single-product .kfc-add-btn {
          position: absolute;
          bottom: 15px;
          left: 50%;
          transform: translateX(-50%);
          width: 80%;
          justify-content: center;
      }

      .single-product .kfc-add-btn:hover {
          background: #b50020;
          color: #fff;
      }

      /* Hide old buttons */
      .single-product .button-head {
          display: none !important;
      }
CSS;

$new_html = <<<'HTML'
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
HTML;

// Insert CSS before </style> in Start Product Area
$c = preg_replace('/(\/\* === EMERGENCY FIX FOR LAYOUT === \*\/)/s', $kfc_css . "\n      $1", $c);

// Replace the old single-product div
$c = preg_replace('/<div class="single-product" data-aos="fade-up".*?<\/div>\s*<\/div>/s', $new_html, $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Card updated.\n";
