<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angelhug - Customer Login</title>
    <link rel="icon" type="image/png" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">
    <link rel="shortcut icon" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            --ah-primary: #048444;
            --ah-primary-dark: #024724;
            --ah-cyan: #00bbd7;
            --ah-gradient: linear-gradient(135deg, #048444 0%, #00bbd7 100%);
            --ah-slate-900: #0f172a;
            --ah-slate-600: #475569;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 15% 20%, #e0f8fa 0%, transparent 45%),
                        radial-gradient(circle at 85% 80%, #e8f7ee 0%, transparent 45%),
                        #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            padding: 24px 16px;
        }

        .login-card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(4, 132, 68, 0.08), 0 4px 16px rgba(0, 187, 215, 0.05);
            border: 1px solid rgba(4, 132, 68, 0.12);
            padding: 36px 32px;
            position: relative;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 20px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--ah-primary);
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--ah-slate-900);
            margin-bottom: 4px;
        }

        .form-control {
            font-size: 14.5px;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--ah-primary);
            box-shadow: 0 0 0 3px rgba(4, 132, 68, 0.12);
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            background-color: #f8fafc;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        .btn-ah-login {
            background: var(--ah-gradient);
            color: #ffffff;
            font-weight: 700;
            font-size: 15.5px;
            padding: 12px 20px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 20px rgba(4, 132, 68, 0.25);
            transition: all 0.25s ease;
        }

        .btn-ah-login:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(4, 132, 68, 0.35);
        }

        .trust-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ah-primary);
            font-size: 12px;
            font-weight: 700;
            background: #e8f7ee;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>

        <!-- Header / Logo -->
        <div class="text-center mb-4">
            <span class="trust-badge">
                <i class="fas fa-shield-alt"></i> Certified Home Healthcare
            </span>
            <div class="mb-2">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}" alt="Angelhug Logo" style="height: 72px; width: auto; object-fit: contain;">
                </a>
            </div>
            <h3 class="fw-bold mb-1" style="color: var(--ah-primary); font-size: 22px;">Customer Login</h3>
            <p class="text-muted small mb-0" style="font-size: 13.5px; line-height: 1.4;">
                Enter your details to book nursing services & access your appointment history.
            </p>
        </div>

        @if (session('info'))
            <div class="alert alert-info py-2 px-3 small rounded-3 mb-3" style="background: #e0f2fe; color: #0369a1; border-color: #bae6fd;">
                <i class="fas fa-info-circle me-1"></i> {{ session('info') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success py-2 px-3 small rounded-3 mb-3">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf 
            <!-- Full Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text text-muted"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                </div>
            </div>

            <!-- Mobile Number -->
            <div class="mb-3">
                <label for="mobileNumber" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text fw-bold text-dark">+91</span>
                    <input type="tel" class="form-control" id="mobileNumber" name="mobile_no"
                           placeholder="10-digit mobile number" maxlength="10" minlength="10" 
                           pattern="[0-9]{10}" inputmode="numeric" value="{{ old('mobile_no') }}" required>
                </div>
                <div class="form-text text-muted" style="font-size: 11.5px; margin-top: 3px;">
                    We will send a 6-digit OTP to verify this number.
                </div>
            </div>

            <!-- Email Address (OPTIONAL) -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address <span class="text-muted fw-normal small">(Optional)</span></label>
                <div class="input-group">
                    <span class="input-group-text text-muted"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Optional - for digital receipts" value="{{ old('email') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-ah-login w-100 mt-2">
                <i class="fas fa-arrow-right me-2"></i> Continue with OTP
            </button>
        </form>

        <div class="text-center mt-4 pt-3 border-top">
            <p class="text-muted small mb-0" style="font-size: 12.5px;">
                Need assistance? Call Care Coordinator: 
                <a href="tel:+918072515050" class="fw-bold text-decoration-none" style="color: var(--ah-primary);">
                    +91 80725 15050
                </a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
