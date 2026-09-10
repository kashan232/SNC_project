@extends('frontend.layouts.master')

@section('title','Shoukat Nimco Center ||  Track Order')

@section('main-content')
<!-- Courier Style Tracking Section -->
<section class="tcs-tracking-section">
    <div class="tracking-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-white text-center">Track Your Shipment</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container tracking-container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="tcs-track-card">
                    <form action="{{route('product.track.order')}}" method="post">
                        @csrf
                        <div class="tcs-input-group">
                            <input type="text" name="order_number" placeholder="Enter Tracking Number (e.g. ORD-123456)" required>
                            <button type="submit">TRACK <i class="ti-arrow-right"></i></button>
                        </div>
                        <p class="track-hint">Separate multiple tracking numbers with a comma (Coming soon)</p>
                    </form>

                    @if(session('order_details'))
                        @php
                            $order = session('order_details');
                            $status = $order->status;
                        @endphp
                        
                        <div class="tcs-result-area mt-5">
                            <h3 class="result-heading">Shipment Details</h3>
                            
                            <div class="row">
                                <!-- Order Info Box -->
                                <div class="col-md-5">
                                    <div class="tcs-info-box">
                                        <div class="info-row">
                                            <span>Tracking No:</span>
                                            <strong>{{ $order->order_number }}</strong>
                                        </div>
                                        <div class="info-row">
                                            <span>Booking Date:</span>
                                            <strong>{{ $order->created_at->format('d M Y, h:i A') }}</strong>
                                        </div>
                                        <div class="info-row">
                                            <span>Amount:</span>
                                            <strong>Rs. {{ number_format($order->total_amount, 2) }}</strong>
                                        </div>
                                        <div class="info-row">
                                            <span>Payment:</span>
                                            <strong>{{ strtoupper($order->payment_method) }}</strong>
                                        </div>
                                        <div class="info-row">
                                            <span>Current Status:</span>
                                            @if($status == 'cancel')
                                                <strong class="text-danger">CANCELLED</strong>
                                            @elseif($status == 'new')
                                                <strong class="text-warning">ORDER PLACED</strong>
                                            @elseif($status == 'process')
                                                <strong class="text-primary">PROCESSING / IN TRANSIT</strong>
                                            @elseif($status == 'delivered')
                                                <strong class="text-success">DELIVERED</strong>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Vertical Timeline -->
                                <div class="col-md-7">
                                    <div class="tcs-timeline-box">
                                        <h4>Tracking History</h4>
                                        <ul class="tcs-timeline">
                                            @if($status == 'cancel')
                                                <li class="timeline-item danger">
                                                    <div class="time">{{ $order->updated_at->format('d M Y') }}<br>{{ $order->updated_at->format('h:i A') }}</div>
                                                    <div class="status">
                                                        <h5>Shipment Cancelled</h5>
                                                        <p>Order has been cancelled by the system or user.</p>
                                                    </div>
                                                </li>
                                            @else
                                                @if($status == 'delivered')
                                                <li class="timeline-item success">
                                                    <div class="time">{{ $order->updated_at->format('d M Y') }}<br>{{ $order->updated_at->format('h:i A') }}</div>
                                                    <div class="status">
                                                        <h5>Delivered</h5>
                                                        <p>Shipment has been successfully delivered to the consignee.</p>
                                                    </div>
                                                </li>
                                                @endif
                                                
                                                @if(in_array($status, ['process', 'delivered']))
                                                <li class="timeline-item active">
                                                    <div class="time">Update</div>
                                                    <div class="status">
                                                        <h5>In Transit / Processing</h5>
                                                        <p>Shipment is being processed and is on its way.</p>
                                                    </div>
                                                </li>
                                                @endif
                                                
                                                <li class="timeline-item">
                                                    <div class="time">{{ $order->created_at->format('d M Y') }}<br>{{ $order->created_at->format('h:i A') }}</div>
                                                    <div class="status">
                                                        <h5>Order Placed / Booked</h5>
                                                        <p>Shipment information received.</p>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Order Items Details -->
                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="tcs-info-box" style="padding: 0; overflow: hidden;">
                                        <h4 style="background: var(--primary-color); color: #fff; padding: 15px 20px; font-size: 16px; font-weight: 700; margin: 0;">Order Items</h4>
                                        <div class="table-responsive">
                                            <table class="table" style="margin-bottom: 0;">
                                                <thead style="background: #f4f6f9;">
                                                    <tr>
                                                        <th style="border-bottom: 1px solid #eee; font-weight: 600; padding: 15px 20px; color: #555;">Product</th>
                                                        <th style="border-bottom: 1px solid #eee; font-weight: 600; padding: 15px 20px; color: #555;">Rate</th>
                                                        <th style="border-bottom: 1px solid #eee; font-weight: 600; padding: 15px 20px; color: #555;">Qty</th>
                                                        <th style="border-bottom: 1px solid #eee; font-weight: 600; padding: 15px 20px; color: #555; text-align: right;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->cart_info as $cart)
                                                    @php
                                                        $photo = explode(',',$cart->product['photo']);
                                                    @endphp
                                                    <tr>
                                                        <td style="padding: 15px 20px; border-bottom: 1px solid #eee; display: flex; align-items: center;">
                                                            <img src="{{$photo[0]}}" alt="{{$cart->product['title']}}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px; border: 1px solid #ddd;">
                                                            <span style="font-weight: 600; color: #333;">{{$cart->product['title']}}</span>
                                                        </td>
                                                        <td style="padding: 15px 20px; border-bottom: 1px solid #eee; vertical-align: middle;">Rs. {{number_format($cart->price, 2)}}</td>
                                                        <td style="padding: 15px 20px; border-bottom: 1px solid #eee; vertical-align: middle;">{{$cart->quantity}}</td>
                                                        <td style="padding: 15px 20px; border-bottom: 1px solid #eee; vertical-align: middle; text-align: right; font-weight: 700; color: var(--primary-color);">Rs. {{number_format($cart->amount, 2)}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot style="background: #fdfdfd;">
                                                    <tr>
                                                        <td colspan="3" style="padding: 15px 20px; text-align: right; font-weight: 600; color: #555; border-top: 2px solid #ddd;">Subtotal</td>
                                                        <td style="padding: 15px 20px; text-align: right; font-weight: 700; color: #333; border-top: 2px solid #ddd;">Rs. {{number_format($order->sub_total, 2)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="padding: 15px 20px; text-align: right; font-weight: 600; color: #555;">Shipping</td>
                                                        <td style="padding: 15px 20px; text-align: right; font-weight: 700; color: #333;">Rs. {{number_format($order->shipping->price ?? 0, 2)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="padding: 15px 20px; text-align: right; font-weight: 800; color: var(--hover-color); font-size: 16px;">Grand Total</td>
                                                        <td style="padding: 15px 20px; text-align: right; font-weight: 800; color: var(--primary-color); font-size: 16px;">Rs. {{number_format($order->total_amount, 2)}}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .tcs-tracking-section {
        background-color: #f4f6f9;
        padding-bottom: 80px;
    }
    .tracking-banner {
        background: var(--primary-color);
        padding: 60px 0 100px;
    }
    .tracking-banner h1 {
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .tracking-container {
        margin-top: -60px;
    }
    .tcs-track-card {
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        padding: 40px;
    }
    
    /* Input Group */
    .tcs-input-group {
        display: flex;
        border: 2px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }
    .tcs-input-group input {
        flex: 1;
        border: none;
        padding: 20px 25px;
        font-size: 18px;
        color: #333;
        outline: none;
        background: #fff;
    }
    .tcs-input-group input:focus {
        background: #fafafa;
    }
    .tcs-input-group button {
        background: var(--primary-color);
        color: #fff;
        border: none;
        padding: 0 40px;
        font-size: 18px;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .tcs-input-group button:hover {
        background: var(--hover-color);
    }
    .track-hint {
        color: #888;
        font-size: 13px;
        margin-top: 10px;
        text-align: left;
    }

    /* Results */
    .result-heading {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 10px;
        margin-bottom: 25px;
        display: inline-block;
    }
    
    /* Info Box */
    .tcs-info-box {
        background: #f9f9f9;
        border: 1px solid #eee;
        padding: 20px;
        border-radius: 4px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed #ddd;
        font-size: 14px;
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-row span {
        color: #666;
    }
    .info-row strong {
        color: #333;
        text-align: right;
    }

    /* Vertical Timeline */
    .tcs-timeline-box {
        padding-left: 20px;
    }
    .tcs-timeline-box h4 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }
    .tcs-timeline {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
    }
    .tcs-timeline::before {
        content: '';
        position: absolute;
        left: 80px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #ddd;
    }
    .timeline-item {
        display: flex;
        margin-bottom: 30px;
        position: relative;
    }
    .timeline-item .time {
        width: 80px;
        padding-right: 15px;
        text-align: right;
        font-size: 12px;
        color: #777;
        font-weight: 600;
        line-height: 1.4;
    }
    .timeline-item .status {
        flex: 1;
        padding-left: 30px;
        position: relative;
    }
    .timeline-item .status::before {
        content: '';
        position: absolute;
        left: -6px;
        top: 0;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #ddd;
        border: 3px solid #fff;
    }
    .timeline-item.active .status::before,
    .timeline-item.success .status::before {
        background: var(--primary-color);
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary-color) 20%, transparent);
    }
    .timeline-item.danger .status::before {
        background: #ea4335;
    }
    .timeline-item h5 {
        font-size: 15px;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }
    .timeline-item p {
        font-size: 13px;
        color: #666;
        margin: 0;
    }
</style>
@endpush