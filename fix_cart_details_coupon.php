<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// We need to replace the old ul block:
/*
<ul>
    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Cart Subtotal<span>Rs:{{number_format(Helper::totalCartPrice(),2)}}</span></li>

    @if(session()->has('coupon'))
    <li class="coupon_price" data-price="{{Session::get('coupon')['value']}}">You Save<span>Rs:{{number_format(Session::get('coupon')['value'],2)}}</span></li>
    @endif
    @php
        $total_amount=Helper::totalCartPrice();
        if(session()->has('coupon')){
            $total_amount=$total_amount-Session::get('coupon')['value'];
        }
    @endphp
    @if(session()->has('coupon'))
        <li class="last" id="order_total_price">You Pay<span>Rs:{{number_format($total_amount,2)}}</span></li>
    @else
        <li class="last" id="order_total_price">You Pay<span>Rs:{{number_format($total_amount,2)}}</span></li>
    @endif
</ul>
*/

$new_ul = '<ul>
    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">
        Cart Subtotal
        <span>Rs:{{number_format(Helper::totalCartPrice(),2)}}</span>
    </li>

    @if(session()->has(\'coupon\'))
        @php
            $couponId = session()->get(\'coupon\')[\'id\'];
            $couponModel = \App\Models\Coupon::find($couponId);
        @endphp
        
        <li class="coupon_price" data-price="{{Session::get(\'coupon\')[\'value\']}}" style="color: #27ae60 !important; font-weight: 600;">
            Coupon Discount
            @if($couponModel)
                <br>
                <small style="color: #777; font-size: 12px; font-weight: normal; margin-top: 5px; display: block;">
                    Code: <strong style="color:var(--primary-color);">{{$couponModel->code}}</strong> 
                    @if($couponModel->type == \'percent\')
                        ({{$couponModel->value}}% OFF)
                    @elseif($couponModel->type == \'fixed\')
                        (Flat Rs:{{$couponModel->value}} OFF)
                    @endif
                </small>
            @endif
            <span style="color: #27ae60 !important;">-Rs:{{number_format(Session::get(\'coupon\')[\'value\'],2)}}</span>
        </li>
    @endif
    
    @php
        $total_amount=Helper::totalCartPrice();
        if(session()->has(\'coupon\')){
            $total_amount=$total_amount-Session::get(\'coupon\')[\'value\'];
        }
    @endphp
    <li class="last" id="order_total_price">
        Net Amount
        <span>Rs:{{number_format($total_amount,2)}}</span>
    </li>
</ul>';

// Regex replacement
$c = preg_replace('/<ul>\s*<li class="order_subtotal".*?<\/ul>/is', $new_ul, $c);

// Also let's ensure the CSS inside style handles the new <small> nicely if needed.
// It will be fine as display: block inside an li.

file_put_contents($f, $c);
echo "Coupon details properly updated!";
?>
