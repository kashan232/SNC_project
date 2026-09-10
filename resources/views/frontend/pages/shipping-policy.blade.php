@extends('frontend.layouts.master')
@section('title', 'Shoukat Nimco Center || Shipping Policy')
@section('main-content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0);">Shipping Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="policy-page section" style="padding: 80px 0; background: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-12">
                <div class="policy-content" style="background: #fbfbfb; padding: 50px; border-radius: 12px; border-top: 5px solid #036b41; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <h2 style="font-family: 'Orbitron', sans-serif; font-size: 32px; font-weight: 800; color: #222; margin-bottom: 30px;">Shipping Policy</h2>
                    
                    <p style="color: #555; line-height: 1.8; margin-bottom: 20px;">Thank you for visiting and shopping at Shoukat Nimco Center. Following are the terms and conditions that constitute our Shipping Policy.</p>
                    
                    <h4 style="font-size: 20px; font-weight: 700; color: #333; margin: 30px 0 15px;">1. Shipment Processing Time</h4>
                    <p style="color: #555; line-height: 1.8; margin-bottom: 20px;">All orders are processed within 2-3 business days. Orders are not shipped or delivered on weekends or holidays. If we are experiencing a high volume of orders, shipments may be delayed by a few days. Please allow additional days in transit for delivery.</p>
                    
                    <h4 style="font-size: 20px; font-weight: 700; color: #333; margin: 30px 0 15px;">2. Shipping Rates & Delivery Estimates</h4>
                    <p style="color: #555; line-height: 1.8; margin-bottom: 10px;">Shipping charges for your order will be calculated and displayed at checkout.</p>
                    <ul style="color: #555; line-height: 1.8; margin-bottom: 20px; padding-left: 20px;">
                        <li><strong>Standard Delivery:</strong> Free on orders over Rs: 1000. Delivery typically takes 3-5 business days.</li>
                        <li><strong>Express Delivery:</strong> Available for select items at an additional cost. Delivery typically takes 1-2 business days.</li>
                    </ul>
                    
                    <h4 style="font-size: 20px; font-weight: 700; color: #333; margin: 30px 0 15px;">3. Shipment Confirmation & Order Tracking</h4>
                    <p style="color: #555; line-height: 1.8; margin-bottom: 20px;">You will receive a Shipment Confirmation email once your order has shipped containing your tracking number(s). You can also track your order directly on our website using the "Track Order" page.</p>
                    
                    <h4 style="font-size: 20px; font-weight: 700; color: #333; margin: 30px 0 15px;">4. Damages</h4>
                    <p style="color: #555; line-height: 1.8; margin-bottom: 20px;">Shoukat Nimco Center is not liable for any products damaged or lost during shipping. If you received your order damaged, please contact the shipment carrier to file a claim. Please save all packaging materials and damaged goods before filing a claim.</p>
                    
                    <h4 style="font-size: 20px; font-weight: 700; color: #333; margin: 30px 0 15px;">Contact Us</h4>
                    <p style="color: #555; line-height: 1.8; margin-bottom: 0;">If you have any questions regarding your shipment or delivery schedule, please reach out to our support team.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection