@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Order #{{$order->order_number}} Details</h6>
    <a href="{{route('order.index')}}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Orders</a>
  </div>
  <div class="card-body">
    @if($order)

    <!-- Order Status & Basic Info Row -->
    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="p-3 bg-light rounded border h-100">
            <p class="text-muted mb-1 small text-uppercase font-weight-bold">Order Status</p>
            <h5 class="font-weight-bold mb-0">
                @if($order->status=='new')
                <span class="badge badge-primary px-3 py-2">{{$order->status}}</span>
                @elseif($order->status=='process')
                <span class="badge badge-warning px-3 py-2">{{$order->status}}</span>
                @elseif($order->status=='delivered')
                <span class="badge badge-success px-3 py-2">{{$order->status}}</span>
                @else
                <span class="badge badge-danger px-3 py-2">{{$order->status}}</span>
                @endif
            </h5>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="p-3 bg-light rounded border h-100">
            <p class="text-muted mb-1 small text-uppercase font-weight-bold">Date Placed</p>
            <h5 class="font-weight-bold mb-0 text-gray-800">{{$order->created_at->format('D d M, Y')}} <br><small class="text-muted">{{$order->created_at->format('g:i a')}}</small></h5>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="p-3 bg-light rounded border h-100">
            <p class="text-muted mb-1 small text-uppercase font-weight-bold">Total Amount</p>
            <h5 class="font-weight-bold mb-0 text-primary" style="font-size: 24px;">Rs. {{number_format($order->total_amount,2)}}</h5>
        </div>
      </div>
    </div>

    <!-- Details Row -->
    <div class="row">
      <!-- Left Column: Items -->
      <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-header bg-white py-3">
            <h6 class="mb-0 font-weight-bold text-gray-800">Products Ordered</h6>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0">Product</th>
                      <th class="border-0 text-center">Qty</th>
                      <th class="border-0 text-right">Unit Price</th>
                      <th class="border-0 text-right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($order->carts as $cart)
                    <tr>
                      <td class="p-3 border-bottom">
                        <div class="d-flex align-items-center">
                            @if($cart->product->photo)
                            @php
                            $photo = explode(',', $cart->product->photo);
                            @endphp
                            <img src="{{ $photo[0] }}"
                              alt="{{ $cart->product->title }}"
                              class="img-thumbnail mr-3"
                              style="width:70px; height:70px; object-fit:cover; border-radius:8px;">
                            @else
                            <img src="{{ asset('images/no-image.png') }}"
                              alt="No Image"
                              class="img-thumbnail mr-3"
                              style="width:70px; height:70px; object-fit:cover; border-radius:8px;">
                            @endif
                            <div>
                              <h6 class="mb-1 font-weight-bold text-gray-800">{{ $cart->product->title }}</h6>
                              @if($cart->size)
                                <span class="badge badge-secondary" style="font-size:12px;">Size: {{ $cart->size }}</span>
                              @endif
                            </div>
                        </div>
                      </td>
                      <td class="text-center align-middle font-weight-bold border-bottom">{{ $cart->quantity }}</td>
                      <td class="text-right align-middle text-muted border-bottom">Rs. {{ number_format($cart->price,2) }}</td>
                      <td class="text-right align-middle font-weight-bold text-primary border-bottom">Rs. {{ number_format($cart->amount,2) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>
          <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Subtotal ({{$order->quantity}} items)</span>
                <span class="font-weight-bold text-gray-800">Rs. {{ number_format($order->total_amount - ($order->shipping->price ?? 0), 2) }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="text-muted">Shipping Charge</span>
                <span class="font-weight-bold text-gray-800">Rs. {{ number_format($order->shipping->price ?? 0, 2) }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold text-gray-800 mb-0">Grand Total</h5>
                <h5 class="font-weight-bold text-primary mb-0">Rs. {{ number_format($order->total_amount,2) }}</h5>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Shipping & Payment -->
      <div class="col-lg-4 mb-4">
        <!-- Shipping Card -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-header bg-white py-3">
            <h6 class="mb-0 font-weight-bold text-gray-800">Shipping Details</h6>
          </div>
          <div class="card-body">
            <h6 class="font-weight-bold text-gray-800 mb-2">{{ $order->first_name }} {{ $order->last_name }}</h6>
            <p class="text-muted small mb-1"><i class="fas fa-envelope mr-2 text-primary"></i>{{ $order->email }}</p>
            <p class="text-muted small mb-3"><i class="fas fa-phone mr-2 text-primary"></i>{{ $order->phone }}</p>
            
            <h6 class="font-weight-bold text-gray-800 mb-2 mt-3 border-top pt-3">Delivery Address:</h6>
            <p class="text-muted small mb-1">{{ $order->address1 }}</p>
            @if($order->address2)
            <p class="text-muted small mb-1">{{ $order->address2 }}</p>
            @endif
            <p class="text-muted small mb-0">
                @if($order->city)
                    <strong>City:</strong> {{ $order->city->name }} <br>
                @endif
                @if($order->area)
                    <strong>Area:</strong> {{ $order->area->name }} <br>
                @endif
                @if(!$order->city && !$order->area)
                    {{ $order->country }} <br>
                @endif
                Post Code: {{ $order->post_code }}
            </p>
          </div>
        </div>

        <!-- Payment Card -->
        <div class="card shadow-sm border-0">
          <div class="card-header bg-white py-3">
            <h6 class="mb-0 font-weight-bold text-gray-800">Payment Information</h6>
          </div>
          <div class="card-body">
            <div class="mb-3">
                <span class="text-muted d-block small mb-1">Payment Method</span>
                <span class="font-weight-bold text-gray-800">
                    @if($order->payment_method=='cod') 
                        <i class="fas fa-money-bill-wave text-success mr-1"></i> Cash on Delivery 
                    @else 
                        <i class="fab fa-paypal text-primary mr-1"></i> Paypal 
                    @endif
                </span>
            </div>
            <div>
                <span class="text-muted d-block small mb-1">Payment Status</span>
                @if($order->payment_status=='paid')
                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Paid</span>
                @elseif($order->payment_status=='unpaid')
                    <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i>Unpaid</span>
                @else
                    <span class="badge badge-warning px-2 py-1">{{$order->payment_status}}</span>
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection