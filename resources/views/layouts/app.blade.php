@php
    $appBrandName = \App\Models\Setting::get('brand_name', 'Angelhug');
    $appBrandTagline = \App\Models\Setting::get('brand_tagline', 'Healthcare Services');
    $appAdminTitle = \App\Models\Setting::get('admin_panel_title', $appBrandName . ' Web Administration');
    $appAdminSubtitle = \App\Models\Setting::get('admin_panel_subtitle', 'HEALTHCARE MANAGEMENT');
    $appCustomLogo = \App\Models\Setting::get('website_logo');
    $appLogoUrl = $appCustomLogo ? asset('storage/' . $appCustomLogo) : asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $appBrandName }} - Admin Panel</title>
    <link rel="icon" type="image/png" href="{{ $appLogoUrl }}">
    <link rel="shortcut icon" href="{{ $appLogoUrl }}">
    <link rel="apple-touch-icon" href="{{ $appLogoUrl }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        :root {
            --ah-admin-sidebar-width: 265px;
            --ah-primary: #048444;
            --ah-primary-dark: #024724;
            --ah-cyan: #00bbd7;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
            background: #f4f7fb;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: calc(-1 * var(--ah-admin-sidebar-width));
            width: var(--ah-admin-sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #024724 0%, #012412 100%);
            padding-top: 25px;
            padding-bottom: 30px;
            overflow-y: auto;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1050;
            box-shadow: 12px 0 28px rgba(2, 71, 36, 0.25);
        }

        .sidebar.active { left: 0; }

        .sidebar-brand {
            padding: 10px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.88) !important;
            padding: 11px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none !important;
            font-weight: 600;
            font-size: 14px;
            margin: 5px 14px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.04);
            transition: all 0.2s ease;
        }

        .sidebar a:hover, .sidebar a.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, rgba(0, 187, 215, 0.3) 0%, rgba(4, 132, 68, 0.25) 100%) !important;
            border-color: #00bbd7;
            transform: translateX(4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .sidebar .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: #fff !important;
            cursor: pointer;
        }

        .navbar-admin {
            background: #ffffff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.06);
            height: 64px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1040;
            transition: all 0.3s ease;
        }

        #main-content {
            width: 100%;
            min-height: calc(100vh - 64px);
            margin-top: 64px;
            padding: 24px 20px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        @media (min-width: 992px) {
            .sidebar {
                left: 0;
                width: var(--ah-admin-sidebar-width);
            }

            .sidebar .close-btn { display: none; }
            .navbar-toggler { display: none; }

            .navbar-admin {
                left: var(--ah-admin-sidebar-width) !important;
                right: 0 !important;
                width: calc(100% - var(--ah-admin-sidebar-width)) !important;
                margin-left: 0 !important;
            }

            #main-content {
                margin-left: var(--ah-admin-sidebar-width) !important;
                width: calc(100% - var(--ah-admin-sidebar-width)) !important;
                max-width: calc(100% - var(--ah-admin-sidebar-width)) !important;
                padding: 28px 32px !important;
            }
        }

        #main-content .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
            max-width: 100% !important;
        }

        a {
            text-decoration: none !important;
        }

        /* Admin Pagination Styling */
        .pagination {
            margin-bottom: 0;
            gap: 5px;
        }
        .page-item .page-link {
            color: #048444;
            border-radius: 8px !important;
            border: 1.5px solid #e2e8f0;
            font-weight: 700;
            font-size: 13.5px;
            padding: 6px 14px;
            background: #ffffff;
            transition: all 0.2s ease;
        }
        .page-item.active .page-link {
            background-color: #048444 !important;
            border-color: #048444 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(4, 132, 68, 0.25);
        }
        .page-item .page-link:hover {
            background-color: #e8f7ee;
            border-color: #048444;
            color: #024724;
        }
        .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f8fafc;
            border-color: #e2e8f0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-admin px-3 px-lg-4">
    <div class="container-fluid px-0">
        <button class="navbar-toggler btn btn-light me-2 border-0" type="button" onclick="openSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <span class="fw-bold d-none d-sm-inline" style="color: var(--ah-primary); font-size: 16.5px;">
            <i class="fas fa-shield-alt text-success me-2"></i> {{ $appAdminTitle }}
        </span>
        <div class="ms-auto d-flex align-items-center gap-3">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-bold" style="border-color: var(--ah-primary); color: var(--ah-primary);">
                <i class="fas fa-external-link-alt me-1"></i> Live Website
            </a>
            <div class="dropdown">
                <button class="btn btn-sm btn-light border dropdown-toggle fw-semibold" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1" style="color: var(--ah-primary);"></i> {{ is_object(session('user')) ? session('user')->email : (session('user.email') ?? 'Administrator') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user-circle me-2 text-success"></i> Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <span class="close-btn" onclick="closeSidebar()">&times;</span>

    <div class="sidebar-brand text-center">
        <div style="background: #ffffff; padding: 8px 14px; border-radius: 14px; display: inline-block; margin-bottom: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <img src="{{ $appLogoUrl }}" alt="{{ $appBrandName }}" style="height: 58px; width: auto; display: block;">
        </div>
        <div class="text-white fw-bold fs-5 tracking-wide">{{ $appBrandName }}</div>
        <small class="text-white-50" style="font-size: 11px; letter-spacing: 0.5px;">{{ $appAdminSubtitle }}</small>
    </div>

    <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <i class="fas fa-chart-pie"></i> Dashboard
    </a>
    <a href="{{ route('services.index') }}" class="{{ request()->is('*services*') ? 'active' : '' }}">
        <i class="fas fa-stethoscope"></i> Service Management
    </a>
    <a href="{{ route('admin.banners.index') }}" class="{{ request()->is('*banners*') ? 'active' : '' }}">
        <i class="fas fa-images"></i> Banner Management
    </a>
    <a href="{{ route('admin.bookings.index') }}" class="{{ request()->is('*bookings*') ? 'active' : '' }}">
        <i class="fas fa-calendar-check"></i> Service Bookings
    </a>
    <a href="{{ route('admin.customers.index') }}" class="{{ request()->is('*customers*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Customer Details
    </a>
    <a href="{{ route('admin.enquiries.index') }}" class="{{ request()->is('*enquiries*') ? 'active' : '' }}">
        <i class="fas fa-envelope-open-text"></i> Service Enquiry
    </a>
    <a href="{{ route('admin.caretakers.index') }}" class="{{ request()->is('*caretakers*') ? 'active' : '' }}">
        <i class="fas fa-user-nurse"></i> Caretaker Applications
    </a>
    <a href="{{ route('admin.billing.index') }}" class="{{ request()->is('*billing*') ? 'active' : '' }}">
        <i class="fas fa-file-invoice-dollar"></i> GST & Extra Charges
    </a>
    <a href="{{ route('admin.website_settings.index') }}" class="{{ request()->is('*website-settings*') ? 'active' : '' }}">
        <i class="fas fa-sliders-h"></i> Brand & Terms Settings
    </a>

    <div class="px-3 my-2">
        <hr style="border-color: rgba(255,255,255,0.12);">
    </div>

    <a href="{{ url('/logout') }}" class="text-danger" style="background: rgba(220, 53, 69, 0.12); border-color: rgba(220, 53, 69, 0.3);">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>

<!-- Main Content Area -->
<div id="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openSidebar() {
        document.getElementById("sidebar").classList.add("active");
    }
    function closeSidebar() {
        document.getElementById("sidebar").classList.remove("active");
    }
</script>
</body>
</html>
