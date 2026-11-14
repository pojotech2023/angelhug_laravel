<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\Setting::get('brand_name', 'Angelhug') }} - Admin Login</title>
    <link rel="icon" type="image/png" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">
    <link rel="shortcut icon" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background:
                radial-gradient(circle at top, rgba(4, 132, 68, 0.15), transparent 35%),
                linear-gradient(135deg, #f4faf6 0%, #eef8f3 100%);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            min-height: 100vh;
        }

        .login-shell {
            min-height: 100vh;
            padding: 24px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 36px;
            border: 1px solid rgba(4, 132, 68, 0.15);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 24px 60px rgba(4, 132, 68, 0.12);
        }

        .login-title {
            font-weight: 800;
            color: #048444;
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
            padding: 0 16px;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #048444;
            box-shadow: 0 0 0 4px rgba(4, 132, 68, 0.14);
        }

        .login-btn {
            min-height: 52px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #048444 0%, #00bbd7 100%);
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
            box-shadow: 0 14px 30px rgba(4, 132, 68, 0.28);
            transition: all 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #024724 0%, #048444 100%);
            box-shadow: 0 18px 34px rgba(4, 132, 68, 0.35);
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="login-shell d-flex justify-content-center align-items-center">
        <div class="login-card">
            <div class="text-center mb-3">
                <img src="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}" alt="{{ \App\Models\Setting::get('brand_name', 'Angelhug') }}" style="height: 85px; max-height: 95px; width: auto;" class="mb-3">
                <h3 class="login-title mb-1">{{ \App\Models\Setting::get('brand_name', 'Angelhug') }} Admin</h3>
                <p class="login-subtitle">Sign in with administrator credentials</p>
            </div>

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form action="{{ route('Sign_In') }}" method="POST">
                @csrf
              <!-- Email Input -->
<div class="mb-3">
    <label for="email" class="form-label">Admin Email Address</label>
    <input
        type="email"
        name="email"
        id="email"
        class="form-control"
        placeholder="Enter admin email"
        value=""
        autocomplete="off"
        required
    >
</div>

<!-- Password Input -->
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input
        type="password"
        name="password"
        id="password"
        class="form-control"
        placeholder="Enter password"
        value=""
        autocomplete="new-password"
        required
    >
</div>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn login-btn">
                        <i class="fas fa-sign-in-alt me-2"></i> Log In to Dashboard
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-muted small text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i> Return to Live Website
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
