<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification - Signify</title>
    <link href="{{ asset('img/logo.jpeg') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .otp-input {
            width: 50px;
            height: 50px;
            font-size: 24px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row shadow-lg rounded p-4 bg-white w-100" style="max-width: 800px;">
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <a href="{{ route('home') }}" class="text-decoration-none text-primary fw-semibold mb-2">&lt; Back to Home</a>
                {{-- <a href="{{ route('login') }}" class="text-decoration-none text-dark mb-3">&lt; Back to Login</a> --}}
                <h1 class="text-uppercase">OTP Verification</h1>
                <p class="text-muted">An authentication code has been sent to your mobile number</p>
                <p class="text-center mt-3">Enter the OTP sent to -
                    <span class="fw-bold">+91-{{ session('otp_mobile') ?? session('auth_mobile') }}</span>
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger text-center py-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success text-center py-2">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('otp.verify') }}" onsubmit="return combineOtp();">
                    @csrf
                    <div class="d-flex justify-content-center my-3">
                        @for ($i = 1; $i <= 6; $i++)
                            <input type="text" id="otp{{ $i }}"
                                class="form-control text-center mx-1 otp-input" maxlength="1"
                                name="otp{{ $i }}" required>
                        @endfor
                    </div>

                    <!-- Hidden input to hold full OTP -->
                    <input type="hidden" name="otp" id="otp-full">

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100 mt-3">Verify</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <span class="text-muted">Didn't receive a code?</span>
                    <form method="POST" action="{{ route('otp.resend') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger fw-bold p-0 border-0 align-baseline">
                            Resend OTP
                        </button>
                    </form>
                </div>

            </div>

            <div class="col-md-6 d-none d-md-block text-center">
                <img src="{{ asset('images/otp.jpg') }}" alt="OTP Verification" class="img-fluid rounded">
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auto-focus script -->
    <script>
        function combineOtp() {
            const inputs = document.querySelectorAll('.otp-input');
            let fullOtp = '';

            inputs.forEach((input) => {
                fullOtp += input.value;
            });

            document.getElementById('otp-full').value = fullOtp;

            return true; // Submit the form
        }

        // Auto move to next input
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
        });
    </script>
</body>

</html>
