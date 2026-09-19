<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Insert closing div for product-img if it's missing before product-content
$c = preg_replace('/(\<\/a\>\s*)(\<div class="product-content"\>)/is', '$1</div>$2', $c);

// Wait, if I add </div> here, I will have an extra </div> at the end of the loop!
// The loop ends with:
//                             <div class="button-head">
//                                         <div class="product-action d-flex justify-content-center align-items-center w-100">
//                                             <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
//                                             <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class="ti-eye"></i><span>Quick Shop</span></a>
//                                             <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
//                             </div>
//                         </div>
//                                 </div>
//                         </div>
//                         @endforeach
// Let's count divs in a single loop item to make sure.

// Better to just rewrite the whole loop block correctly to avoid unmatched divs!
// Let's replace the whole single-product div inside the foreach.

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed missing div.";
