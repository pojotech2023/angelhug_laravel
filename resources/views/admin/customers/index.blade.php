@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-users me-2"></i> Customer Details</h3>
            <p class="text-muted small mb-0">Overview of all registered users, verified phone numbers, and booking records.</p>
        </div>
        <div>
            <form action="{{ route('admin.customers.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name, phone, email..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold" style="background-color: #048444; border-color: #048444;">Search</button>
                @if(request('search'))
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Customer Name</th>
                        <th>Mobile Number</th>
                        <th>Email Address</th>
                        <th>Total Bookings</th>
                        <th>Total Spent</th>
                        <th>Registered Date</th>
                        <th style="width: 140px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $index => $customer)
                        <tr>
                            <td>{{ $customers->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 38px; height: 38px;">
                                        {{ strtoupper(substr($customer->name ?: 'C', 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $customer->name ?: 'Customer' }}</h6>
                                        <small class="text-muted">ID #{{ $customer->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($customer->mobile_no)
                                    <span class="badge bg-light text-dark border"><i class="fas fa-phone-alt me-1 text-primary"></i> +91 {{ $customer->mobile_no }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $customer->email ?: '-' }}</td>
                            <td>
                                <span class="badge bg-primary rounded-pill px-3">{{ $customer->total_bookings }}</span>
                            </td>
                            <td>
                                <strong class="text-success">₹{{ number_format($customer->total_spent, 2) }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ $customer->created_at ? $customer->created_at->format('d M, Y') : '-' }}</small>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-sm btn-outline-primary fw-bold">
                                    <i class="fas fa-eye me-1"></i> View History
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-users fs-2 mb-2 d-block"></i>
                                No customer records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($customers->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
