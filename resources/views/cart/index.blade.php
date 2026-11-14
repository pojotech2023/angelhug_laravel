<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="icon" type="image/png" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">
    <link rel="shortcut icon" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">
    <style>
    body {
        background: #ffeef7;
        font-family: "Poppins", sans-serif;
    }

    .cart-wrapper {
        max-width: 1200px;
        width: 95%;
        margin: 40px auto;
        background: #ffffff;
        padding: 45px;
        border-radius: 24px;
        box-shadow: 0 18px 45px rgba(255, 41, 120, 0.15);
        border: 3px solid #ff77c9;
    }

    .page-title {
        font-size: 36px;
        font-weight: 800;
        text-align: center;
        margin-bottom: 30px;
        color: #d4006e;
    }

    .page-actions {
        margin-bottom: 18px;
    }

    .back-home-link {
        display: inline-flex;
        align-items: center;
        color: #b20059;
        font-weight: 600;
        text-decoration: none;
    }

    .back-home-link:hover {
        color: #d4006e;
    }

    .cart-item {
        display: flex;
        gap: 28px;
        padding: 28px;
        background: linear-gradient(120deg, #ffd1ec, #fff0fa);
        border-radius: 22px;
        margin-bottom: 24px;
        transition: .3s;
        border: 2px solid #ffb3dc;
    }

    .cart-item:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 18px rgba(212, 0, 110, 0.25);
    }

    .cart-item img {
        width: 180px;
        height: 130px;
        object-fit: cover;
        border-radius: 14px;
        border: 2px solid #ff60b8;
    }

    .cart-details h3 {
        font-size: 26px;
        font-weight: 800;
        margin: 0;
        color: #b20059;
    }

    .cart-details p {
        margin: 5px 0;
        color: #444;
        font-size: 15px;
    }

    .remove-link {
        color: #ff004f;
        font-weight: 600;
        text-decoration: none;
        margin-top: 10px;
        display: inline-block;
    }

    .price-tag {
        margin-left: auto;
        font-size: 32px;
        font-weight: 800;
        color: #ff007f;
    }

    .total-box {
        margin-top: 40px;
        text-align: right;
        padding-top: 20px;
        border-top: 2px dashed #ff4fa9;
    }

    .total-box h2 {
        font-size: 28px;
        font-weight: 700;
        color: #c8006c;
    }

    .checkout-btn {
        display: inline-block;
        padding: 14px 35px;
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        border-radius: 12px;
        background: linear-gradient(90deg, #ff008c, #d400b8);
        text-decoration: none;
        margin-top: 15px;
        transition: .3s;
        box-shadow: 0 6px 15px rgba(255, 0, 128, 0.4);
        border: none;
        cursor: pointer;
    }

    .checkout-btn:hover {
        background: linear-gradient(90deg, #d400b8, #ff008c);
        transform: translateY(-3px);
    }

    @media (max-width: 768px) {
        body {
            padding: 0;
            margin: 0;
        }

        .cart-wrapper {
            max-width: 100%;
            width: calc(100% - 16px);
            margin: 10px auto;
            padding: 20px 14px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(255, 41, 120, 0.12);
        }

        .page-title {
            font-size: 32px;
            margin-bottom: 18px;
        }

        .page-actions {
            margin-bottom: 18px;
        }

        .cart-item {
            flex-direction: column;
            gap: 18px;
            padding: 22px;
        }

        .cart-item img {
            width: 100%;
            height: auto;
            max-height: 220px;
        }

        .cart-details h3 {
            font-size: 24px;
        }

        .cart-details p {
            font-size: 16px;
        }

        .price-tag {
            margin-left: 0;
            text-align: right;
            font-size: 30px;
        }

        .total-box {
            padding-top: 18px;
        }

        .total-box h2 {
            font-size: 30px;
        }

        .checkout-btn {
            width: 100%;
            text-align: center;
            padding: 18px 20px;
            font-size: 19px;
        }
    }
    </style>
</head>
<body>

<div class="cart-wrapper">
    <div class="page-actions">
        <a href="{{ route('home') }}" class="back-home-link">&lt; Back to Home</a>
    </div>
    <h1 class="page-title">🛍️ Your Cart</h1>

    @if(session('cart') && count(session('cart')) > 0)
        @php $total = 0; @endphp

        @foreach(session('cart') as $id => $item)
        <div class="cart-item">
            <img src="{{ asset($item['image']) }}" alt="Image">

            <div class="cart-details">
                <h3>{{ $item['title'] }}</h3>
                <p>Price: ₹{{ $item['price'] }}</p>
                <p>Quantity: {{ $item['qty'] }}</p>
                <a href="{{ route('cart.remove', $id) }}" class="remove-link">Remove</a>
            </div>

            <div class="price-tag">
                ₹{{ $item['price'] * $item['qty'] }}
            </div>
        </div>
        @php $total += $item['price'] * $item['qty']; @endphp
        @endforeach

        <div class="total-box">
            <h2>Total Amount: ₹{{ $total }}</h2>
            
            {{-- CHECK IF USER IS LOGGED IN --}}
            @auth
                {{-- Already logged in, go directly to payment --}}
                <a href="{{ route('payment.page') }}" class="checkout-btn">Proceed to Checkout</a>
            @else
                {{-- Not logged in, redirect to login page --}}
                <a href="{{ route('customer.login') }}" class="checkout-btn">Login to Proceed</a>
            @endauth
        </div>

    @else
        <h3 style="text-align:center; padding:30px; color:#ff008c;">Your cart is empty.</h3>
    @endif
</div>

</body>
</html>
