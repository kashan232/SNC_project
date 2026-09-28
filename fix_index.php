<?php
$f = 'resources/views/backend/product/index.blade.php';
$c = file_get_contents($f);

$search = '<td>{{$product->size}}</td>';
$replace = '<td>
                        @if($product->size)
                            @php 
                                $sizes = explode(\',\', $product->size);
                                $szPrices = $product->size_prices ? json_decode($product->size_prices, true) : [];
                            @endphp
                            @foreach($sizes as $sz)
                                @php $sz = trim($sz); @endphp
                                @if($sz !== "")
                                    <span class="badge badge-info" style="font-size:12px; margin-bottom:2px;">
                                        {{$sz}} 
                                        @if(is_array($szPrices) && isset($szPrices[$sz]) && $szPrices[$sz] !== "")
                                            (Rs. {{$szPrices[$sz]}})
                                        @endif
                                    </span><br>
                                @endif
                            @endforeach
                        @endif
                      </td>';

if (strpos($c, 'badge-info') === false) {
    $c = str_replace($search, $replace, $c);
    file_put_contents($f, $c);
    echo "Fixed index sizes.";
} else {
    echo "Already fixed index sizes.";
}
?>
