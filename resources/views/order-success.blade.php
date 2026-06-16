<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <style>
        body {
            background: #ffeef7;
            font-family: "Poppins", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .success-box {
            background: #fff;
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 12px 35px rgba(255, 41, 120, 0.15);
            border: 3px solid #ff77c9;
        }
        .success-icon {
            font-size: 80px;
            color: #00c853;
            margin-bottom: 20px;
        }
        h1 {
            color: #d4006e;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 14px 35px;
            background: linear-gradient(90deg, #ff008c, #d400b8);
            color: #fff;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: .3s;
        }
        .btn:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

<div class="success-box">
    <div class="success-icon">✓</div>
    <h1>Payment Successful!</h1>
    <p>Your order has been placed successfully.</p>
    <a href="/" class="btn">Continue Shopping</a>
</div>

</body>
</html>
