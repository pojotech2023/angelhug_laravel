@include('header')

<style>
/* Hero section overlay */
.breadcrumb-area{
position: relative;
overflow: hidden;
}

/* White overlay */
.breadcrumb-area::before{
content:"";
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background: rgba(255,255,255,0.45); /* adjust whiteness here */
z-index:1;
}

/* Keep text above overlay */
.breadcrumb-area .text-block{
position: relative;
z-index:2;
}
@media (max-width:768px){

.breadcrumb-area{
background-size: cover !important;
background-position: center center !important;
background-repeat: no-repeat !important;

height: 10vh;
display: flex;
align-items: center;
justify-content: center;
text-align: center;
}
/* reduce hero section height */
.breadcrumb-area{
padding: 20px 0 !important;
height: auto;
}

/* move breadcrumb (Home • Course List) up */
.bread-menu{
margin-top: -25px;
margin-bottom: 8px;

}

/* adjust title spacing */
.bread-title h2{
margin-top: 5px;
font-size: 30px;
font-weight: bold;
}

}

</style>
<section class="breadcrumb-area breadcrumb-order" style="padding: 130px 0" >
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu">
                            {{-- <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul> --}}
                        </div>
                        <div class="bread-title">
                            <h2>My Orders</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pad-tb">
    <div class="container">

        <div class="common-heading text-center mb-5">
            <h2 class="mt0 mb10">Welcome, {{ Auth::user()->name ?? Auth::user()->mobile_no }}</h2>
            <p>Your purchased courses and books are listed below.</p>
        </div>

        @if($orders->count() > 0)
            @foreach($orders as $order)
            <div class="card mb-4" style="border:1px solid #e0e0e0; border-radius:12px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.06);">

                <!-- Order Header -->
                <div class="order-header-row" style="background:#f4f7fc; padding:14px 24px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; border-bottom:1px solid #e0e0e0;">
                    <div>
                        <span style="font-size:13px; color:#888;">Payment ID:</span>
                        <strong style="margin-left:6px; font-size:13px;">{{ $order->razorpay_payment_id ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span style="font-size:13px; color:#888;">Date:</span>
                        <strong style="margin-left:6px; font-size:13px;">{{ $order->created_at->format('d M Y, h:i A') }}</strong>
                    </div>
                    <div>
                        <span style="font-size:13px; color:#888;">Total:</span>
                        <strong style="margin-left:6px; font-size:15px; color:#4a90d9;">₹{{ number_format($order->amount, 2) }}</strong>
                    </div>
                    <div>
                        <span style="background:#28a745; color:#fff; padding:5px 14px; border-radius:20px; font-size:12px; font-weight:600;">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                <!-- Order Items -->
                <div>
                    @foreach($order->items as $item)
                    <div class="order-item-row" style="display:flex; align-items:center; gap:20px; padding:16px 24px; border-bottom:1px solid #f5f5f5;">
                        <!-- Thumbnail -->
                        <div class="order-item-thumb" style="flex-shrink:0;">
                            @if(!empty($item['image']))
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}"
                                     style="width:70px; height:70px; object-fit:cover; border-radius:8px; border:1px solid #eee;">
                            @else
                                <div style="width:70px; height:70px; background:#eef2f7; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas {{ ($item['type'] ?? '') == 'book' ? 'fa-book' : 'fa-graduation-cap' }}" style="font-size:26px; color:#4a90d9;"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="order-item-details" style="flex:1; min-width:0;">
                            <h6 style="margin:0 0 6px; font-weight:700; font-size:15px;">{{ $item['title'] }}</h6>
                            <span style="font-size:12px; padding:3px 12px; border-radius:20px; font-weight:600; display:inline-block;
                                background: {{ ($item['type'] ?? '') == 'book' ? '#fff3cd' : '#d1ecf1' }};
                                color: {{ ($item['type'] ?? '') == 'book' ? '#856404' : '#0c5460' }};">
                                <i class="fas {{ ($item['type'] ?? '') == 'book' ? 'fa-book' : 'fa-graduation-cap' }}" style="margin-right:4px;"></i>
                                {{ ($item['type'] ?? '') == 'book' ? 'Book' : 'Course' }}
                            </span>
                        </div>

                        <!-- Qty & Price -->
                        <div class="order-item-price" style="text-align:right; flex-shrink:0;">
                            <div style="font-size:13px; color:#888;">Qty: {{ $item['qty'] }}</div>
                            <div style="font-size:15px; font-weight:700; color:#333; margin-top:2px;">₹{{ number_format($item['price'] * $item['qty'], 2) }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            @endforeach

        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open" style="font-size:72px; color:#ccc; display:block; margin-bottom:20px;"></i>
                <h4 style="color:#888;">No orders yet</h4>
                <p style="color:#aaa; margin-bottom:30px;">You haven't purchased any courses or books yet.</p>
                <div class="order-empty-actions">
                    <a href="{{ url('list/course') }}" class="btn btn-main bg-btn order-empty-btn">
                        Browse Courses
                    </a>
                    <a href="{{ url('list/book') }}" class="btn btn-main bg-btn order-empty-btn">
                        Browse Books
                    </a>
                </div>
            </div>
        @endif

    </div>
</section>

<style>
    .order-empty-actions {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .order-empty-btn {
        min-width: 180px;
    }

    @media (max-width: 767.98px) {
        .order-header-row {
            padding: 12px !important;
            gap: 8px !important;
        }

        .order-header-row>div {
            width: 100%;
        }

        .order-item-row {
            flex-wrap: wrap;
            align-items: flex-start !important;
            padding: 12px !important;
            gap: 12px !important;
        }

        .order-item-thumb {
            width: 64px;
        }

        .order-item-details {
            width: calc(100% - 76px);
        }

        .order-item-price {
            width: 100%;
            text-align: left !important;
            padding-left: 76px;
        }

        .order-item-details h6 {
            font-size: 14px !important;
            line-height: 1.35 !important;
        }

        .order-empty-actions {
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .order-empty-btn {
            width: 100%;
            max-width: 240px;
            margin: 0 !important;
        }
    }

    @media (max-width: 575.98px) {
        .order-item-row {
            gap: 10px !important;
        }

        .order-item-thumb,
        .order-item-thumb img {
            width: 56px !important;
            height: 56px !important;
        }

        .order-item-details {
            width: 100% !important;
        }

        .order-item-price {
            padding-left: 0 !important;
        }
    }
</style>

@include('footer')
