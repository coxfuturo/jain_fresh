@extends('admin.layout.app')

@section('title', 'Order Details #' . $order->id)

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('orders.index') }}" class="btn btn-light rounded-circle shadow-sm">
        <i class="fas fa-arrow-left text-muted"></i>
    </a>
    <h3 class="fw-bold mb-0">Order Details #{{ $order->id }}</h3>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row g-4">
    <!-- Order Items & Summary -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="fw-bold mb-0">Order Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th class="pe-4 text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://ui-avatars.com/api/?name='.$item->product->name }}" class="rounded-3 shadow-sm" width="50" height="50" style="object-fit: cover;">
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $item->product->name }}</span>
                                            <span class="text-muted small">{{ $item->product->weight ?? '' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>₹{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td class="pe-4 text-end fw-bold">₹{{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="3" class="ps-4 text-end fw-bold">Subtotal</td>
                                <td class="pe-4 text-end fw-bold text-dark">₹{{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            @if($order->discount_amount > 0)
                            <tr>
                                <td colspan="3" class="ps-4 text-end fw-bold text-danger">Discount</td>
                                <td class="pe-4 text-end fw-bold text-danger">-₹{{ number_format($order->discount_amount, 2) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="ps-4 text-end fs-5 fw-bold text-dark">Grand Total</td>
                                <td class="pe-4 text-end fs-5 fw-bold text-primary">₹{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="fw-bold mb-0">Customer & Shipping Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="text-muted small text-uppercase fw-bold mb-3">Customer Details</h6>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $order->user->name ?? 'N/A' }}</div>
                                <div class="text-muted small">{{ $order->user->email ?? '' }}</div>
                                <div class="text-muted small">{{ $order->user->phone ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted small text-uppercase fw-bold mb-3">Shipping Address</h6>
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                @if($order->address)
                                    <div class="fw-bold text-dark">{{ $order->address->address_line_1 }}</div>
                                    <div class="text-muted small">{{ $order->address->address_line_2 }}</div>
                                    <div class="text-muted small">{{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}</div>
                                    <div class="text-muted small">Type: {{ $order->address->address_type }}</div>
                                @else
                                    <div class="text-muted">No address provided</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Actions -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="fw-bold mb-0">Order Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Order Status</label>
                        <select name="order_status" class="form-select border-0 bg-light rounded-3 py-2">
                            <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Shipped" {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="Delivered" {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase text-muted">Payment Status</label>
                        <select name="payment_status" class="form-select border-0 bg-light rounded-3 py-2">
                            <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Failed" {{ $order->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-2 shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Order
                    </button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="fw-bold mb-0">Payment Summary</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Method</span>
                    <span class="fw-bold text-dark">{{ $order->payment_method }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Order Date</span>
                    <span class="fw-bold text-dark">{{ $order->created_at->format('d M, Y h:i A') }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Total Amount</span>
                    <span class="fs-4 fw-bold text-primary">₹{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
