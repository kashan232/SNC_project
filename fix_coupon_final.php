<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// 1. Replace the weird flexbox coupon li
$old_coupon_li = '/@if\(session\(\)->has\(\'coupon\'\)\).*?<li class="coupon_price".*?<\/li>\s*@endif/is';

$new_coupon_li = '@if(session()->has(\'coupon\'))
        @php
            $couponId = session()->get(\'coupon\')[\'id\'];
            $couponModel = \App\Models\Coupon::find($couponId);
        @endphp
        <li class="coupon_price" data-price="{{Session::get(\'coupon\')[\'value\']}}" style="display: flex !important; justify-content: space-between !important; align-items: flex-start !important;">
            <div style="display: flex; flex-direction: column; text-align: left;">
                <strong style="color: #27ae60; font-size: 15px; font-weight: 700;">Coupon Discount</strong>
                @if($couponModel)
                    <small style="color: #888; font-size: 12px; margin-top: 2px;">
                        Code: <span style="color: var(--primary-color); font-weight: 600;">{{$couponModel->code}}</span>
                        @if($couponModel->type == \'percent\')
                            ({{(float)$couponModel->value}}% OFF)
                        @elseif($couponModel->type == \'fixed\')
                            (Flat Rs:{{(float)$couponModel->value}} OFF)
                        @endif
                    </small>
                @endif
            </div>
            <span style="color: #27ae60 !important; font-weight: 700 !important;">-Rs:{{number_format(Session::get(\'coupon\')[\'value\'],2)}}</span>
        </li>
    @endif';

$c = preg_replace($old_coupon_li, $new_coupon_li, $c);


// 2. Replace the coupon form block
$old_coupon_form = '/<div class="coupon">\s*<form action="\{\{route\(\'coupon-store\'\)\}\}" method="POST">\s*@csrf\s*<input name="code" placeholder="Enter Your Coupon">\s*<button class="btn">Apply<\/button>\s*<\/form>\s*<\/div>/is';

$new_coupon_form = '<div class="coupon">
    <form action="{{route(\'coupon-store\')}}" method="POST">
        @csrf
        @if(session()->has(\'coupon\'))
            <!-- Disabled State -->
            <input name="code" value="{{session()->get(\'coupon\')[\'code\']}}" disabled style="background: #f4f5f7 !important; border-color: #eaeaea !important; color: #888 !important; box-shadow: none !important; font-weight: 600;">
            <button type="button" class="btn" disabled style="background: #b2bec3 !important; color: #fff !important; cursor: not-allowed; pointer-events: none; transform: none !important; box-shadow: none !important;">APPLIED</button>
        @else
            <!-- Active State -->
            <input name="code" placeholder="Enter Your Coupon">
            <button class="btn">Apply</button>
        @endif
    </form>
</div>';

$c = preg_replace($old_coupon_form, $new_coupon_form, $c);

file_put_contents($f, $c);
echo "Coupon list and form disabled state fixed!";
?>
