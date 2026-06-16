@extends('layouts.app')

@section('content')
<style>
    .purchase-shell {
        width: calc(100vw - 320px);
        max-width: none;
    }

    .purchase-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 18px;
    }

    .purchase-table th,
    .purchase-table td {
        vertical-align: middle;
        white-space: nowrap;
    }

    .purchase-type-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .purchase-type-course {
        background: #d1ecf1;
        color: #0c5460;
    }

    .purchase-type-book {
        background: #fff3cd;
        color: #856404;
    }

    .purchase-pagination {
        display: flex;
        justify-content: center;
        margin-top: 18px;
    }
</style>

<div class="purchase-shell">
    <div class="purchase-page-header">
        <h2 class="mb-0">Purchased List</h2>
    </div>

    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-bordered purchase-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Item Type</th>
                    <th>Item Title</th>
                    <th>Qty</th>
                    <th>Item Amount</th>
                    <th>Order Amount</th>
                    <th>Payment ID</th>
                    <th>Status</th>
                    <th>Purchased At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $index => $purchase)
                    <tr>
                        <td>{{ $purchases->firstItem() + $index }}</td>
                        <td>{{ $purchase['customer_name'] }}</td>
                        <td>{{ $purchase['customer_email'] }}</td>
                        <td>{{ $purchase['mobile_no'] }}</td>
                        <td>
                            <span class="purchase-type-badge {{ strtolower($purchase['item_type']) === 'book' ? 'purchase-type-book' : 'purchase-type-course' }}">
                                {{ $purchase['item_type'] }}
                            </span>
                        </td>
                        <td>{{ $purchase['item_title'] }}</td>
                        <td>{{ $purchase['qty'] }}</td>
                        <td>&#8377;{{ number_format($purchase['item_amount'], 2) }}</td>
                        <td>&#8377;{{ number_format($purchase['order_amount'], 2) }}</td>
                        <td>{{ $purchase['payment_id'] }}</td>
                        <td>{{ $purchase['status'] }}</td>
                        <td>{{ optional($purchase['purchased_at'])->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">No purchases found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="purchase-pagination">
        {{ $purchases->links() }}
    </div>
</div>
@endsection
