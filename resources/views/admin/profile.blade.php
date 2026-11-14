@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-user-shield me-2"></i> Administrator Profile</h3>
            <p class="text-muted small mb-0">Manage your administrative account information, credentials, and security settings.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 fw-semibold" style="border-radius: 8px;">
            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 p-3 mb-4 shadow-sm border-0 d-flex align-items-center gap-3" style="background: #e8f7ee; border-left: 5px solid #048444 !important;" role="alert">
            <i class="fas fa-check-circle text-success fs-5"></i>
            <div class="flex-grow-1 small fw-bold text-dark">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 p-3 mb-4 shadow-sm border-0 d-flex align-items-center gap-3" style="background: #fef2f2; border-left: 5px solid #dc2626 !important;" role="alert">
            <i class="fas fa-exclamation-circle text-danger fs-5"></i>
            <div class="flex-grow-1 small fw-bold text-dark">{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-4 p-3 mb-4 shadow-sm border-0" style="background: #fef2f2; border-left: 5px solid #dc2626 !important;" role="alert">
            <ul class="mb-0 small fw-bold text-dark ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Left Column: Admin Overview Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
                <div class="mx-auto d-flex align-items-center justify-content-center mb-3" 
                     style="width: 88px; height: 88px; border-radius: 50%; background: linear-gradient(135deg, #024724 0%, #048444 100%); color: #ffffff; box-shadow: 0 8px 25px rgba(4, 132, 68, 0.25);">
                    <i class="fas fa-user-shield" style="font-size: 38px;"></i>
                </div>
                <h4 class="fw-bold mb-1 text-dark" style="font-size: 20px;">{{ \App\Models\Setting::get('brand_name', 'Angelhug') }} Administrator</h4>
                <p class="text-muted small mb-2">{{ $admin->email ?? 'admin@gmail.com' }}</p>
                <div>
                    <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4, 132, 68, 0.25); font-weight: 700; padding: 6px 14px; border-radius: 20px;">
                        <i class="fas fa-shield-alt me-1"></i> Super Administrator
                    </span>
                </div>

                <hr class="my-4" style="border-color: #f1f5f9;">

                <div class="text-start">
                    <h6 class="fw-bold small text-muted text-uppercase mb-3" style="letter-spacing: 0.5px; font-size: 11.5px;">Account Metadata</h6>
                    
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="font-size: 13px;">
                        <span class="text-muted"><i class="fas fa-key text-success me-2"></i> Access Level:</span>
                        <strong class="text-dark">Full System Access</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="font-size: 13px;">
                        <span class="text-muted"><i class="fas fa-check-circle text-success me-2"></i> Account Status:</span>
                        <span class="badge bg-success">Active & Verified</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="font-size: 13px;">
                        <span class="text-muted"><i class="fas fa-phone-alt text-success me-2"></i> Contact Mobile:</span>
                        <strong class="text-dark">{{ $admin->mobile_no ?: '+91 8072515050' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-2" style="font-size: 13px;">
                        <span class="text-muted"><i class="fas fa-calendar-alt text-success me-2"></i> Member Since:</span>
                        <span class="text-muted">{{ $admin->created_at ? $admin->created_at->format('M Y') : '2026' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Edit Profile & Password Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-1" style="color: #048444; font-size: 17px;">
                    <i class="fas fa-user-edit me-2"></i> Account Details & Credentials
                </h5>
                <p class="text-muted small mb-4">Update administrator email address and optional contact mobile number.</p>

                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Administrator Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email ?? 'admin@gmail.com') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Administrator Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">+91</span>
                                <input type="tel" name="mobile_no" class="form-control" value="{{ old('mobile_no', $admin->mobile_no ?? '') }}" placeholder="10-digit mobile number">
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: #f1f5f9;">

                    <h5 class="fw-bold mb-1" style="color: #048444; font-size: 17px;">
                        <i class="fas fa-lock me-2"></i> Change Password
                    </h5>
                    <p class="text-muted small mb-3">Leave blank if you do not want to change your current administrator password.</p>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold text-dark small">Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fas fa-key"></i></span>
                                <input type="password" name="current_password" class="form-control" placeholder="Enter current password to authorize changes">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fas fa-lock"></i></span>
                                <input type="password" name="new_password" class="form-control" placeholder="Min. 6 characters">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fas fa-shield-alt"></i></span>
                                <input type="password" name="new_password_confirmation" class="form-control" placeholder="Re-type new password">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-light px-4 py-2 fw-semibold text-secondary" style="border-radius: 8px;">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold text-white shadow-sm" style="background-color: #048444; border-color: #048444; border-radius: 8px;">
                            <i class="fas fa-save me-1"></i> Save Profile Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
