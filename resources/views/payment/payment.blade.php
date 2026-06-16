<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: #ffeef7;
            font-family: "Poppins", sans-serif;
        }
        .payment-wrapper {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 12px 35px rgba(255, 41, 120, 0.15);
            border: 3px solid #ff77c9;
        }
        h2 {
            color: #d4006e;
            text-align: center;
            margin-bottom: 30px;
        }
        .order-summary {
            background: #fff0fa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ffb3dc;
        }
        .amount-display {
            font-size: 36px;
            font-weight: 700;
            color: #ff007f;
            text-align: center;
            margin: 20px 0;
        }
        .pay-btn {
            width: 100%;
            padding: 16px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(90deg, #ff008c, #d400b8);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: .3s;
        }
        .pay-btn:hover {
            background: linear-gradient(90deg, #d400b8, #ff008c);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

<div class="payment-wrapper">
    <h2>💳 Complete Your Payment</h2>
    
    <div class="order-summary">
        <h3 style="color: #d4006e; margin-bottom: 15px;">Order Summary</h3>
        @foreach($cart as $item)
        <div class="order-item">
            <span>{{ $item['title'] }} (x{{ $item['qty'] }})</span>
            <span style="font-weight: 600;">₹{{ $item['price'] * $item['qty'] }}</span>
        </div>
        @endforeach
    </div>
    
    <div class="amount-display">Total: ₹{{ $total }}</div>
    <button class="pay-btn" id="payButton">Pay Now</button>
</div>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#payButton').click(function() {
    var amount = {{ $total }};
    
    $.ajax({
        url: '/create-order',
        method: 'POST',
        data: { amount: amount },
        success: function(response) {
            var paymentStatusInterval = null;
            function stopPaymentStatusPolling() {
                if (paymentStatusInterval) {
                    clearInterval(paymentStatusInterval);
                    paymentStatusInterval = null;
                }
            }

            function startPaymentStatusPolling(orderId) {
                paymentStatusInterval = setInterval(function() {
                    $.ajax({
                        url: '/payment-status/' + orderId,
                        method: 'GET',
                        success: function(statusResponse) {
                            if (statusResponse.success && statusResponse.status === 'completed') {
                                stopPaymentStatusPolling();
                                window.location.href = statusResponse.redirect;
                            }
                        }
                    });
                }, 4000);

                setTimeout(function() {
                    stopPaymentStatusPolling();
                }, 180000);
            }

            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": response.amount,
                "currency": response.currency,
                "name": "Your Company Name",
                "description": "Course Purchase",
                "order_id": response.order_id,
                "handler": function (response){
                    $.ajax({
                        url: '/verify-payment',
                        method: 'POST',
                        data: {
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_signature: response.razorpay_signature
                        },
                        success: function(result) {
                            if(result.success) {
                                stopPaymentStatusPolling();
                                alert('Payment Successful! 🎉');
                                window.location.href = result.redirect;
                            }
                        },
                        error: function() {
                            alert('Payment verification failed!');
                        }
                    });
                },
                "prefill": {
                    "contact": "{{ Auth::user()->mobile_no }}"
                },
                "theme": {
                    "color": "#ff008c"
                }
            };
            var rzp = new Razorpay(options);
            startPaymentStatusPolling(response.order_id);
            rzp.open();
        },
        error: function(xhr) {
            var message = 'Failed to create order. Please try again.';

            if (xhr.responseJSON && xhr.responseJSON.error) {
                message = xhr.responseJSON.error;
            }

            alert(message);
        }
    });
});
</script>

</body>
</html>
