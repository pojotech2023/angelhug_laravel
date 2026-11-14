@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-calendar-check me-2"></i> Service Bookings Management</h3>
            <p class="text-muted small mb-0">Track, update, and manage all customer appointments and payments.</p>
        </div>
        <div>
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="d-flex gap-2">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search ref, customer, phone..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold" style="background-color: #048444; border-color: #048444;">Search</button>
                @if(request('search'))
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="d-flex gap-2 mb-3 flex-wrap">
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm {{ !request('status') && !request('payment_status') ? 'btn-primary' : 'btn-outline-secondary' }} fw-bold">
            All ({{ $counts['all'] }})
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}" class="btn btn-sm {{ request('status') === 'confirmed' ? 'btn-success' : 'btn-outline-success' }} fw-bold">
            Confirmed ({{ $counts['confirmed'] }})
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'completed']) }}" class="btn btn-sm {{ request('status') === 'completed' ? 'btn-info' : 'btn-outline-info' }} fw-bold">
            Completed ({{ $counts['completed'] }})
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'cancelled']) }}" class="btn btn-sm {{ request('status') === 'cancelled' ? 'btn-danger' : 'btn-outline-danger' }} fw-bold">
            Cancelled ({{ $counts['cancelled'] }})
        </a>
        <a href="{{ route('admin.bookings.index', ['payment_status' => 'paid']) }}" class="btn btn-sm {{ request('payment_status') === 'paid' ? 'btn-dark' : 'btn-outline-dark' }} fw-bold">
            Paid via Razorpay ({{ $counts['paid'] }})
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Booking Ref</th>
                        <th>Service</th>
                        <th>Customer Details</th>
                        <th>Appointment Date & Time</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>Booking Status</th>
                        <th style="width: 140px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $index => $booking)
                        <tr>
                            <td>{{ $bookings->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $booking->booking_number }}</strong>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div>
                                        <div class="fw-bold" style="color: #048444;">{{ $booking->service->title ?? 'Specialized Service' }}</div>
                                        @if(!empty($booking->sub_service_name))
                                            <span class="badge" style="background: #e0f2fe; color: #0284c7; font-size: 10px;">{{ $booking->sub_service_name }}</span>
                                        @endif
                                        <small class="text-muted d-block">{{ $booking->service->duration ?? '60 Mins' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><strong>{{ $booking->customer_name }}</strong></div>
                                <small class="text-muted d-block"><i class="fas fa-phone-alt me-1"></i> +91 {{ $booking->customer_phone }}</small>
                                @if($booking->customer_address)
                                    <div class="text-muted small mt-1" style="font-size: 11.5px; max-width: 220px; line-height: 1.3;" title="{{ $booking->customer_address }}">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ \Illuminate\Support\Str::limit($booking->customer_address, 42) }}
                                    </div>
                                    @php
                                        $mapUrl = $booking->google_maps_link ?: 'https://www.google.com/maps/search/?api=1&query=' . urlencode($booking->customer_address);
                                    @endphp
                                    <a href="{{ $mapUrl }}" target="_blank" class="badge bg-light text-primary border text-decoration-none mt-1" style="font-size: 10px;" title="View on Google Maps">
                                        <i class="fab fa-google text-primary me-1"></i> View Location
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div><i class="far fa-calendar-alt text-primary me-1"></i> {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                <small class="text-muted"><i class="far fa-clock me-1"></i> {{ $booking->booking_time }}</small>
                                @if($booking->duration_type)
                                    <div><span class="badge bg-light text-dark border" style="font-size: 10px;">{{ $booking->duration_type }}</span></div>
                                @endif
                            </td>
                            <td>
                                <strong class="text-success">₹{{ number_format($booking->amount, 2) }}</strong>
                            </td>
                            <td>
                                @if($booking->payment_status === 'paid')
                                    <span class="badge bg-success-subtle text-success border border-success"><i class="fas fa-check-circle me-1"></i> Paid (Online)</span>
                                @elseif($booking->payment_method === 'cash')
                                    <span class="badge bg-warning-subtle text-dark border border-warning"><i class="fas fa-money-bill-wave me-1"></i> Cash on Service</span>
                                @elseif($booking->payment_status === 'refunded')
                                    <span class="badge bg-secondary">Refunded</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ ucfirst($booking->payment_status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($booking->booking_status === 'confirmed')
                                    <span class="badge bg-success">Confirmed</span>
                                @elseif($booking->booking_status === 'completed')
                                    <span class="badge bg-info">Completed</span>
                                @elseif($booking->booking_status === 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($booking->booking_status) }}</span>
                                @endif
                            </td>
                            <td class="text-end text-nowrap">
                                <button type="button" class="btn btn-sm btn-outline-success me-1" title="Adjust Extra Charges & GST (Popup)"
                                        onclick='openBillingModal({
                                            id: {{ $booking->id }},
                                            booking_number: "{{ $booking->booking_number }}",
                                            service_title: "{{ addslashes($booking->service->title ?? 'Healthcare Service') }}",
                                            customer_name: "{{ addslashes($booking->customer_name ?: ($booking->caller_name ?: 'Patient')) }}",
                                            base_fee: {{ (float) $booking->effective_base_fee }},
                                            platform_fee: {{ (float) $booking->effective_platform_fee }},
                                            extra_charges: {{ (float) $booking->effective_extra_charges }},
                                            gst_rate: {{ (float) $booking->effective_gst_rate }}
                                        })'>
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </button>
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary me-1" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this booking record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fas fa-calendar-times fs-2 mb-2 d-block"></i>
                                No service bookings found in this view.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@include('admin.bookings.modal_adjust_billing')
@endsection
