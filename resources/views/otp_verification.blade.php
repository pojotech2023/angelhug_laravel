<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angelhug - OTP Verification</title>
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

        .otp-card {
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

        .otp-input {
            width: 48px;
            height: 52px;
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            transition: all 0.2s ease;
            color: var(--ah-primary);
        }

        .otp-input:focus {
            border-color: var(--ah-primary);
            box-shadow: 0 0 0 3px rgba(4, 132, 68, 0.15);
            outline: none;
        }

        .btn-ah-verify {
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

        .btn-ah-verify:hover {
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
    <div class="otp-card">
        <a href="{{ route('customer.login') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Change Number
        </a>

        <!-- Header / Logo -->
        <div class="text-center mb-4">
            <span class="trust-badge">
                <i class="fas fa-shield-alt"></i> Mobile Verification
            </span>
            <div class="mb-2">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}" alt="Angelhug Logo" style="height: 70px; width: auto; object-fit: contain;">
                </a>
            </div>
            <h3 class="fw-bold mb-1" style="color: var(--ah-primary); font-size: 22px;">Enter OTP Code</h3>
            <p class="text-muted small mb-2" style="font-size: 13.5px;">
                Enter the 6-digit authentication code sent to:
            </p>
            <div class="badge bg-light text-dark border px-3 py-2 fs-6 fw-bold">
                <i class="fas fa-mobile-alt text-success me-1"></i> +91-{{ session('otp_mobile') ?? session('auth_mobile') }}
            </div>
        </div>

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

        <form method="POST" action="{{ route('otp.verify') }}" onsubmit="return combineOtp();">
            @csrf
            <div class="d-flex justify-content-center gap-2 my-3">
                @for ($i = 1; $i <= 6; $i++)
                    <input type="text" id="otp{{ $i }}"
                        class="form-control text-center otp-input" maxlength="1"
                        name="otp{{ $i }}" inputmode="numeric" pattern="[0-9]" required autocomplete="one-time-code">
                @endfor
            </div>

            <!-- Hidden input to hold full OTP -->
            <input type="hidden" name="otp" id="otp-full">

            <button type="submit" class="btn btn-ah-verify w-100 mt-2">
                <i class="fas fa-check-circle me-2"></i> Verify & Book Services
            </button>
        </form>

        <div class="text-center mt-3 pt-2">
            <span class="text-muted small">Didn't receive the code?</span>
            <form method="POST" action="{{ route('otp.resend') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link fw-bold p-0 border-0 align-baseline small text-decoration-none" style="color: var(--ah-primary);">
                    Resend OTP
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auto-focus & OTP combination script -->
    <script>
        function combineOtp() {
            const inputs = document.querySelectorAll('.otp-input');
            let fullOtp = '';

            inputs.forEach((input) => {
                fullOtp += input.value.trim();
            });

            document.getElementById('otp-full').value = fullOtp;
            return true;
        }

        // Auto move to next input and handle backspace
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach((input, index) => {
            input.addEventListener('keyup', (e) => {
                if (e.key >= '0' && e.key <= '9') {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                } else if (e.key === 'Backspace') {
                    if (index > 0 && input.value === '') {
                        inputs[index - 1].focus();
                    }
                }
            });

            // Handle paste of 6 digits
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData).getData('text').trim();
                if (/^\d{6}$/.test(pasteData)) {
                    pasteData.split('').forEach((char, i) => {
                        if (inputs[i]) inputs[i].value = char;
                    });
                    inputs[inputs.length - 1].focus();
                }
            });
        });

        // Auto focus first input
        if (inputs.length > 0) {
            inputs[0].focus();
        }
    </script>
</body>

</html>
