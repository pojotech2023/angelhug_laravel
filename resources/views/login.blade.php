<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PojoCoursePilot</title>
    <link href="{{ asset('img/logo (2).png') }}" rel="icon">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background:
                radial-gradient(circle at top, rgba(13, 110, 253, 0.08), transparent 32%),
                linear-gradient(135deg, #f4f7fb 0%, #eef3f9 100%);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-shell {
            min-height: 100vh;
            padding: 24px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
        }

        .login-title {
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
            border: 1px solid #dbe3ee;
            padding: 0 14px;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.12);
        }

        .login-btn {
            min-height: 52px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.01em;
            box-shadow: 0 14px 30px rgba(13, 110, 253, 0.24);
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .login-btn:hover,
        .login-btn:focus {
            transform: translateY(-1px);
            box-shadow: 0 18px 34px rgba(13, 110, 253, 0.3);
            filter: brightness(1.02);
        }

        .login-btn:active {
            transform: translateY(0);
            box-shadow: 0 10px 22px rgba(13, 110, 253, 0.22);
        }
    </style>
</head>

<body>
    <div class="login-shell d-flex justify-content-center align-items-center">
        <div class="login-card">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <h3 class="login-title text-center mb-2">Login</h3>
            <p class="login-subtitle text-center mb-4">Sign in to continue to your dashboard.</p>
            <form action="{{ route('Sign_In') }}" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary login-btn">Login</button>
                </div>

                <!-- Optional Links -->
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
