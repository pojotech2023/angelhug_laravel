@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-user-circle me-2"></i> Customer Profile & History</h3>
            <p class="text-muted small mb-0">Customer ID #{{ $customer->id }} &mdash; {{ $customer->name ?: 'Customer' }}</p>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary fw-bold">
            <i class="fas fa-arrow-left me-1"></i> Back to Customers
        </a>
    </div>

    <!-- Customer Overview Card -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-md-2 text-center">
                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center text-primary fw-bold fs-1" style="width: 90px; height: 90px;">
                    {{ strtoupper(substr($customer->name ?: 'C', 0, 1)) }}
                </div>
            </div>
            <div class="col-md-5">
                <h4 class="fw-bold mb-1" style="color: #048444;">{{ $customer->name ?: 'Customer' }}</h4>
                <div class="text-muted mb-1"><i class="fas fa-phone-alt text-primary me-2"></i> +91 {{ $customer->mobile_no }}</div>
                <div class="text-muted mb-1"><i class="fas fa-envelope text-primary me-2"></i> {{ $customer->email ?: 'N/A' }}</div>
                <div class="text-muted small"><i class="far fa-calendar-alt text-primary me-2"></i> Registered: {{ $customer->created_at ? $customer->created_at->format('M d, Y') : '-' }}</div>
            </div>
            <div class="col-md-5">
                <div class="row g-2 text-center">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Total Bookings</span>
                            <h3 class="fw-bold mb-0 text-primary">{{ $bookings->count() }}</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Total Paid</span>
                            <h3 class="fw-bold mb-0 text-success">₹{{ number_format($bookings->where('payment_status', 'paid')->sum('amount'), 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking History by this Customer -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="p-4 border-bottom">
            <h5 class="fw-bold mb-0" style="color: #048444;"><i class="fas fa-calendar-alt text-primary me-2"></i> Service Bookings History</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Booking Ref</th>
                        <th>Service</th>
                        <th>Date & Time</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>Booking Status</th>
                        <th>Razorpay ID</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $bk)
                        <tr>
                            <td><strong>{{ $bk->booking_number }}</strong></td>
                            <td>{{ $bk->service->title ?? 'Specialized Service' }}</td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($bk->booking_date)->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $bk->booking_time }}</small>
                            </td>
                            <td><strong>₹{{ number_format($bk->amount, 2) }}</strong></td>
                            <td>
                                @if($bk->payment_status === 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($bk->payment_status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($bk->booking_status === 'confirmed')
                                    <span class="badge bg-success">Confirmed</span>
                                @elseif($bk->booking_status === 'completed')
                                    <span class="badge bg-info">Completed</span>
                                @elseif($bk->booking_status === 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($bk->booking_status) }}</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted"><code>{{ $bk->razorpay_payment_id ?: 'N/A' }}</code></small>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.bookings.show', $bk->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                No service bookings recorded for this customer yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
