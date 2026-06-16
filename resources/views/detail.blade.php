@php
    $cart = session('cart', []);
    $inCart = isset($cart[$course->id]);
    $currentQty = $inCart ? $cart[$course->id]['qty'] : 1;
    $totalAmount = $course->price * $currentQty;
@endphp

@include('header')

<style>
.detail-section {
    padding: 50px 0 70px;
    background: #f8f9fa;
    min-height: 80vh;
}

.product-img-wrap {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 6px 24px rgba(0,0,0,0.10);
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 380px;
}

.product-img-wrap img {
    width: 100%;
    height: 380px;
    object-fit: cover;
    display: block;
}

.product-info-box {
    background: #fff;
    border-radius: 14px;
    padding: 32px 30px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.07);
    height: 100%;
}

.product-title {
    font-size: 26px;
    font-weight: 700;
    color: #1a3c5e;
    margin-bottom: 14px;
    line-height: 1.3;
}

.product-meta-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}

.rating-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #fffbe6;
    border: 1px solid #f5c518;
    border-radius: 20px;
    padding: 3px 12px;
    font-size: 14px;
    font-weight: 600;
    color: #c7a800;
}

.stock-badge {
    display: inline-block;
    border: 1.5px solid #1c8b4c;
    border-radius: 20px;
    padding: 3px 14px;
    font-size: 13px;
    font-weight: 600;
    color: #1c8b4c;
}

.product-type-label {
    font-size: 14px;
    color: #888;
    margin-bottom: 10px;
}

.price-row {
    margin-bottom: 10px;
}

.price-current {
    font-size: 26px;
    font-weight: 700;
    color: #1c8b4c;
}

.total-amount-section {
    margin: 16px 0 20px;
    padding: 14px 16px;
    background: #f0faf5;
    border-radius: 10px;
}

.total-amount-label {
    font-size: 14px;
    color: #666;
    margin-bottom: 4px;
}

.total-amount-value {
    font-size: 28px;
    font-weight: 700;
    color: #1c8b4c;
    margin: 0;
}

.qty-cart-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.qty-selector {
    display: flex;
    align-items: center;
    border: 1.5px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
}

.qty-btn {
    width: 42px;
    height: 46px;
    background: #f0f0f0;
    border: none;
    font-size: 22px;
    font-weight: 500;
    color: #444;
    cursor: pointer;
    transition: 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:hover {
    background: #e0e0e0;
}

.qty-display {
    width: 52px;
    text-align: center;
    font-size: 18px;
    font-weight: 700;
    color: #222;
    border: none;
    background: transparent;
    pointer-events: none;
    display: inline-block;
    line-height: 46px;
}

.add-cart-btn {
    flex: 1;
    min-width: 150px;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: 700;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s;
    background: #1a3c5e;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.add-cart-btn:hover:not(.already-added) {
    background: #0f2a45;
}

.add-cart-btn.already-added {
    background: #9e9e9e;
    cursor: not-allowed;
}

.course-detail-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.course-detail-list li {
    font-size: 15px;
    color: #555;
    padding: 7px 0;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    gap: 8px;
}

.course-detail-list li:last-child {
    border-bottom: none;
}

.desc-section {
    background: #fff;
    border-radius: 14px;
    padding: 30px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.06);
    margin-top: 30px;
}

.desc-tabs {
    display: flex;
    gap: 0;
    border-bottom: 2px solid #e0e0e0;
    margin-bottom: 20px;
}

.desc-tab {
    background: none;
    border: none;
    padding: 10px 24px;
    font-size: 15px;
    font-weight: 600;
    color: #888;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
    transition: 0.2s;
}

.desc-tab.active {
    color: #1c8b4c;
    border-bottom-color: #1c8b4c;
}

.desc-content p {
    font-size: 15px;
    color: #555;
    line-height: 1.85;
    margin: 0;
}

.breadcrumb-bar {
    background: #fff;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    margin-bottom: 30px;
}

.breadcrumb-bar a {
    color: #1d72b7;
    text-decoration: none;
    font-size: 14px;
}

.breadcrumb-bar span {
    color: #888;
    font-size: 14px;
    margin: 0 6px;
}

@media (max-width: 768px) {
    .product-img-wrap img { height: 260px; }
    .product-info-box { padding: 20px 16px; margin-top: 20px; }
    .add-cart-btn { min-width: 120px; font-size: 14px; }
}
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <span>›</span>
        <a href="{{ url('list/' . $course->type) }}">{{ ucfirst($course->type) }} List</a>
        <span>›</span>
        <span style="color:#333;">{{ $course->title }}</span>
    </div>
</div>

<section class="detail-section">
    <div class="container">
        <div class="row g-4">
            <!-- Left: Image -->
            <div class="col-lg-5">
                <div class="product-img-wrap">
                    <img src="{{ asset($course->image) }}" alt="{{ $course->title }}">
                </div>
            </div>

            <!-- Right: Info -->
            <div class="col-lg-7">
                <div class="product-info-box">
                    <h1 class="product-title">{{ $course->title }}</h1>

                    <div class="product-meta-row">
                        <span class="rating-badge">⭐ 4.5</span>
                        <span class="stock-badge">In Stock</span>
                    </div>

                    @if($course->type == 'course' && $course->class_name ?? false)
                        <p class="product-type-label">Class: <strong>{{ $course->class_name }}</strong></p>
                    @endif
                    @if($course->type == 'book' && $course->author ?? false)
                        <p class="product-type-label">Author: <strong>{{ $course->author }}</strong></p>
                    @endif

                    <div class="price-row">
                        <span class="price-current">₹{{ number_format($course->price, 2) }}</span>
                    </div>

                    <div class="total-amount-section">
                        <p class="total-amount-label">Total Amount:</p>
                        <h2 class="total-amount-value">₹<span id="totalAmountDisplay">{{ number_format($totalAmount, 2) }}</span></h2>
                    </div>

                    <div class="qty-cart-row">
                        <div class="qty-selector">
                            <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                            <span class="qty-display" id="qtyDisplay">{{ $currentQty }}</span>
                            <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                        </div>

                        <button
                            class="add-cart-btn {{ $inCart ? 'already-added' : '' }}"
                            id="cartBtn"
                            onclick="addToCart()"
                        >
                            🛒 <span id="cartBtnText">{{ $inCart ? 'Already Added' : 'Add to Cart' }}</span>
                        </button>
                    </div>

                    @if($course->duration || $course->language || $course->certifications || $course->mode)
                    <ul class="course-detail-list">
                        @if($course->duration)
                        <li><strong>Duration:</strong> {{ $course->duration }} days</li>
                        @endif
                        @if($course->language)
                        <li><strong>Language:</strong> {{ $course->language }}</li>
                        @endif
                        @if($course->certifications)
                        <li><strong>Certifications:</strong> {{ $course->certifications }}</li>
                        @endif
                        @if($course->mode)
                        <li><strong>Mode:</strong> {{ $course->mode }}</li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
        </div>

        @if($course->long_desc)
        <div class="row">
            <div class="col-12">
                <div class="desc-section">
                    <div class="desc-tabs">
                        <button class="desc-tab active">Description</button>
                    </div>
                    <div class="desc-content">
                        <p>{{ $course->long_desc }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<script>
(function() {
    var qty = {{ $currentQty }};
    var price = {{ $course->price }};
    var inCart = {{ $inCart ? 'true' : 'false' }};
    var courseId = {{ $course->id }};

    function fmtPrice(val) {
        return parseFloat(val).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    window.changeQty = function(delta) {
        var newQty = qty + delta;
        if (newQty < 1) return;
        qty = newQty;
        document.getElementById('qtyDisplay').textContent = qty;
        document.getElementById('totalAmountDisplay').textContent = fmtPrice(price * qty);

        if (inCart) {
            updateCartQty();
        }
    };

    window.addToCart = function() {
        if (inCart) return;
        var btn = document.getElementById('cartBtn');
        btn.style.opacity = '0.6';

        fetch('/add-to-cart-ajax/' + courseId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ qty: qty })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                inCart = true;
                btn.classList.add('already-added');
                document.getElementById('cartBtnText').textContent = 'Already Added';
                document.querySelectorAll('.cart-count').forEach(function(el) {
                    el.textContent = data.cart_count;
                });
            }
            btn.style.opacity = '1';
        })
        .catch(function() { btn.style.opacity = '1'; });
    };

    function updateCartQty() {
        fetch('/cart/update/' + courseId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ qty: qty })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                document.querySelectorAll('.cart-count').forEach(function(el) {
                    el.textContent = data.cart_count;
                });
            }
        });
    }
})();
</script>

@include('footer')
