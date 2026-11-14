<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angelhug - Caretaker & Nurse Registration Portal</title>
    <link rel="icon" type="image/png" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">
    <link rel="shortcut icon" href="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}">

    <!-- Google Fonts & Bootstrap 5 -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --ah-primary: #048444;
            --ah-primary-dark: #024724;
            --ah-cyan: #00bbd7;
            --ah-slate-900: #0f172a;
            --ah-slate-800: #1e293b;
            --ah-slate-600: #475569;
            --ah-slate-100: #f1f5f9;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f8f5;
            color: #1e293b;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Top Portal Header Bar */
        .portal-header {
            background: #ffffff;
            border-bottom: 1.5px solid #e2e8f0;
            padding: 14px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        }

        .portal-brand-logo {
            height: 60px;
            width: auto;
            object-fit: contain;
        }

        /* Hero Banner - Clean & Generous, No Overlap */
        .portal-hero {
            background: linear-gradient(135deg, #024724 0%, #048444 100%);
            padding: 68px 0 60px;
            color: #ffffff;
            position: relative;
            text-align: center;
        }

        .portal-hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url("{{ asset('img/angelhug_docx/image5.png') }}") center/cover no-repeat;
            opacity: 0.12;
        }

        .portal-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 18px;
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 30px;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 14px;
            backdrop-filter: blur(4px);
        }

        .portal-hero h1 {
            font-size: 2.3rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 10px;
        }

        .portal-hero p {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.88);
            max-width: 680px;
            margin: 0 auto;
            line-height: 1.5;
        }

        /* Form Wrapper - Positioned Below Hero Without Negative Margin Overrides */
        .portal-form-container {
            max-width: 1040px;
            margin: 40px auto 80px;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        .portal-main-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 12px 36px rgba(4, 132, 68, 0.06);
            padding: 40px;
        }

        @media (max-width: 767.98px) {
            .portal-hero {
                padding: 45px 0 40px;
            }
            .portal-hero h1 {
                font-size: 1.75rem;
            }
            .portal-form-container {
                margin: 24px auto 50px;
                padding: 0 12px;
            }
            .portal-main-card {
                padding: 22px 16px;
                border-radius: 16px;
            }
        }

        /* Section Cards */
        .form-section-card {
            background: #ffffff;
            border: 1.5px solid #e9eef4;
            border-radius: 16px;
            padding: 26px 24px;
            margin-bottom: 26px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-section-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.025);
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            padding-bottom: 14px;
            margin-bottom: 20px;
            border-bottom: 1.5px solid #f1f5f9;
        }

        .form-section-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #e8f7ee;
            color: #048444;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        /* Form Controls */
        .form-control, .form-select {
            width: 100%;
            min-height: 46px;
            box-sizing: border-box;
            font-size: 14px;
            border-radius: 10px;
            border: 1.5px solid #dbe2ea;
            background-color: #ffffff;
            color: #1e293b;
            padding: 10px 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #048444;
            box-shadow: 0 0 0 3.5px rgba(4, 132, 68, 0.12);
            outline: none;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 7px !important;
            font-size: 13.5px;
            font-weight: 700;
            color: #1e293b;
        }

        .field-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            height: 22px;
            background: #e8f7ee;
            color: #048444;
            font-size: 11px;
            font-weight: 800;
            padding: 0 6px;
            border-radius: 6px;
            border: 1px solid rgba(4, 132, 68, 0.25);
            flex-shrink: 0;
            line-height: 1;
        }

        .input-group .input-group-text {
            min-height: 46px;
            border: 1.5px solid #dbe2ea;
            border-right: none;
            background: #f8fafc;
            color: #334155;
            font-weight: 700;
            font-size: 14px;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        /* Integrated Photo Upload Box */
        .photo-upload-box {
            background: #f8fafc;
            border: 1.5px dashed #cbd5e1;
            border-radius: 14px;
            padding: 18px 22px;
            transition: border-color 0.2s ease, background-color 0.2s ease;
        }

        .photo-upload-box:hover {
            border-color: #048444;
            background: #f4faf6;
        }

        .photo-preview-wrap {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #048444;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .photo-preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-submit-portal {
            background: linear-gradient(135deg, #048444 0%, #024724 100%);
            color: #ffffff !important;
            font-weight: 800;
            font-size: 16px;
            padding: 15px 44px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 6px 20px rgba(4, 132, 68, 0.35);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit-portal:hover {
            box-shadow: 0 10px 28px rgba(4, 132, 68, 0.5);
            transform: translateY(-2px);
            color: #ffffff !important;
        }

        /* Portal Footer */
        .portal-footer {
            background: #022b16;
            color: #ffffff;
            padding: 26px 0;
            font-size: 13px;
            text-align: center;
            border-top: 3px solid #048444;
        }
    </style>
</head>
<body>

    <!-- Portal Top Bar (Independent Portal, No Main Website Links) -->
    <header class="portal-header">
        @php
            $portalBrandName = \App\Models\Setting::get('brand_name', 'Angelhug');
            $portalLogo = \App\Models\Setting::get('website_logo');
            $portalLogoUrl = $portalLogo ? asset('storage/' . $portalLogo) : asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png');
            $caretakerHrPhone = \App\Models\Setting::get('caretaker_hr_phone', '+91 80725 15050');
            $caretakerHrPhoneClean = preg_replace('/[^0-9+]/', '', $caretakerHrPhone);
        @endphp
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $portalLogoUrl }}" alt="{{ $portalBrandName }} Logo" class="portal-brand-logo">
                <div>
                    <span class="d-block fw-bold text-dark" style="font-size: 17px; line-height: 1.2;">{{ $portalBrandName }} Healthcare</span>
                    <small class="text-success fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">CLINICAL STAFF ONBOARDING PORTAL</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="tel:{{ $caretakerHrPhoneClean }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-2">
                    <i class="fas fa-phone-alt"></i> HR Helpline: {{ $caretakerHrPhone }}
                </a>
            </div>
        </div>
    </header>

    <!-- Portal Hero (Generous Padding, Fully Visible, No Overlap) -->
    <section class="portal-hero">
        <div class="container position-relative" style="z-index: 2;">
            <span class="portal-pill">
                <i class="fas fa-user-nurse me-1"></i> Healthcare Professionals & Caretakers Network
            </span>
            <h1>Caretaker & Nurse Application Form</h1>
            <p>
                Complete your 24-field clinical registration below to join Angelhug's certified caregiving and nursing team.
            </p>
        </div>
    </section>

    <!-- Form Container (Clean Positive Spacing Below Hero) -->
    <div class="portal-form-container">
        <!-- Application Submitted Success Banner -->
        @if(session('application_submitted'))
            @php $appData = session('application_submitted'); @endphp
            <div class="alert alert-success rounded-4 p-4 mb-4 shadow-sm border-0" style="background: #e8f7ee; border-left: 5px solid #048444 !important;">
                <div class="d-flex align-items-start gap-3">
                    <i class="fas fa-check-circle text-success fs-2 mt-1"></i>
                    <div>
                        <h4 class="fw-bold text-dark mb-1">Application Submitted Successfully!</h4>
                        <p class="text-muted mb-2" style="font-size: 14px;">
                            Thank you, <strong>{{ $appData['name'] }}</strong>. Your registration application as a <strong>{{ $appData['type'] }}</strong> has been recorded in our recruitment system.
                        </p>
                        <div class="p-2 px-3 rounded-3 bg-white d-inline-block border">
                            <span class="text-muted small">Application Reference Number:</span>
                            <span class="fw-bold text-success fs-5 ms-2">{{ $appData['application_no'] }}</span>
                        </div>
                        <p class="text-muted small mt-2 mb-0">
                            Our clinical HR and verification team will review your qualifications and reach out to you directly on your mobile number.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger rounded-4 p-3 mb-4 shadow-sm border-0">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fas fa-exclamation-triangle fs-5 text-danger"></i>
                    <strong class="text-danger">Please fix the following validation errors:</strong>
                </div>
                <ul class="mb-0 small ps-3">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="portal-main-card">
            <form action="{{ route('caretaker.store') }}" method="POST" enctype="multipart/form-data" id="caretakerForm">
                @csrf
                <input type="hidden" name="submission_token" value="{{ old('submission_token', $submissionToken) }}">

                <!-- Section 1: Personal & Identity Details -->
                <div class="form-section-card">
                    <div class="form-section-title">
                        <span class="form-section-icon"><i class="fas fa-user-circle"></i></span>
                        <span>1. Personal Information & Identity</span>
                    </div>

                    <div class="row g-3">
                        <!-- Field 1: Integrated Horizontal Applicant Photo Upload -->
                        <div class="col-12 mb-2">
                            <div class="photo-upload-box d-flex flex-column flex-md-row align-items-center gap-4">
                                <div class="photo-preview-wrap shadow-sm d-flex align-items-center justify-content-center bg-light" style="width: 82px; height: 82px; min-width: 82px; border-radius: 50%; overflow: hidden; border: 2.5px solid #048444;">
                                    <img src="" alt="Applicant Photo" id="photoPreview" class="photo-preview-img" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                    <div id="photoPlaceholder" class="text-center text-muted">
                                        <i class="fas fa-user text-secondary" style="font-size: 36px;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 w-100">
                                    <label class="form-label mb-1">
                                        <span class="field-badge">1</span> Applicant Photo <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control" name="photo" id="photoInput" accept="image/*" required onchange="previewPhoto(event)">
                                    <small class="text-muted d-block mt-1" style="font-size: 12px;">
                                        <i class="fas fa-camera text-success me-1"></i> Upload a recent passport-size photograph (JPG or PNG, Max 2MB).
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Field 2: Full Legal Name -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <span class="field-badge">2</span> Full Legal Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="As per official government identification" required>
                        </div>

                        <!-- Field 3: Caretaker / Staff Type -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <span class="field-badge">3</span> Caretaker / Staff Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select fw-bold text-dark" name="type" required>
                                <option value="">Select Professional Type...</option>
                                <option value="Nurse" {{ old('type') == 'Nurse' ? 'selected' : '' }}>Nurse (RN / GNM / ANM)</option>
                                <option value="Therapist" {{ old('type') == 'Therapist' ? 'selected' : '' }}>Therapist (Physio / OT / Speech)</option>
                                <option value="Care giver" {{ old('type') == 'Care giver' ? 'selected' : '' }}>Care giver (Elderly / Bedside Care)</option>
                                <option value="Others" {{ old('type') == 'Others' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>

                        <!-- Field 4: Gender -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">4</span> Gender <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="gender" required>
                                <option value="">Select Gender...</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Field 5: Date of Birth -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">5</span> Date of Birth <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="dob" id="dobInput" value="{{ old('dob') }}" max="{{ date('Y-m-d', strtotime('-18 years')) }}" required onchange="calculateAge()">
                        </div>

                        <!-- Field 6: Age -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">6</span> Age <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control fw-bold bg-light" name="age" id="ageInput" value="{{ old('age') }}" min="18" max="85" placeholder="Auto-calculated" required>
                        </div>

                        <!-- Field 7: Govt ID Proof Doc -->
                        <div class="col-12 mt-1">
                            <label class="form-label">
                                <span class="field-badge">7</span> Upload Govt ID Proof Doc <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" name="govt_id_proof" accept=".pdf,image/*" required>
                            <small class="text-muted d-block mt-1" style="font-size: 12px;">
                                <i class="fas fa-id-card text-success me-1"></i> Aadhar Card, PAN Card, Passport, or Voter ID (PDF / JPG / PNG, Max 10MB)
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Education & Registration Details -->
                <div class="form-section-card">
                    <div class="form-section-title">
                        <span class="form-section-icon"><i class="fas fa-graduation-cap"></i></span>
                        <span>2. Educational Qualifications & Professional Registration</span>
                    </div>

                    <div class="row g-3">
                        <!-- Field 8: Highest Education -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <span class="field-badge">8</span> Highest Education Details <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="highest_education" value="{{ old('highest_education') }}" placeholder="e.g. B.Sc Nursing / GNM Diploma / BPT Physiotherapy" required>
                        </div>

                        <!-- Field 9: Specialization/Role -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <span class="field-badge">9</span> Specialization / Role <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="specialization_role" value="{{ old('specialization_role') }}" placeholder="e.g. Geriatric Care, ICU Nursing, Post-Surgical, Palliative" required>
                        </div>

                        <!-- Field 10: Place of Registration -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <span class="field-badge">10</span> Place of Registration <span class="text-muted fw-normal">(Council / Board)</span>
                            </label>
                            <input type="text" class="form-control" name="place_of_registration" value="{{ old('place_of_registration') }}" placeholder="e.g. Tamil Nadu Nurses and Midwives Council, Chennai">
                        </div>

                        <!-- Field 11: Registration No -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <span class="field-badge">11</span> Professional Registration Number
                            </label>
                            <input type="text" class="form-control" name="registration_no" value="{{ old('registration_no') }}" placeholder="e.g. RN-123456 / Reg Number">
                        </div>

                        <!-- Field 12: Upload Education Documents -->
                        <div class="col-md-6 mt-1">
                            <label class="form-label">
                                <span class="field-badge">12</span> Upload Education Certificate <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" name="education_document" accept=".pdf,image/*" required>
                            <small class="text-muted d-block mt-1" style="font-size: 12px;">
                                <i class="fas fa-file-medical text-success me-1"></i> Degree / Diploma certificate (PDF, JPG, PNG)
                            </small>
                        </div>

                        <!-- Field 13: Upload Resume / CV -->
                        <div class="col-md-6 mt-1">
                            <label class="form-label">
                                <span class="field-badge">13</span> Upload Resume / CV <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" name="resume_document" accept=".pdf,.doc,.docx,image/*" required>
                            <small class="text-muted d-block mt-1" style="font-size: 12px;">
                                <i class="fas fa-file-pdf text-success me-1"></i> Recent resume / clinical profile (PDF, DOC, Max 10MB)
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Clinical Practice & Experience Details -->
                <div class="form-section-card">
                    <div class="form-section-title">
                        <span class="form-section-icon"><i class="fas fa-briefcase"></i></span>
                        <span>3. Clinical Practice & Work Experience</span>
                    </div>

                    <div class="row g-3">
                        <!-- Field 13: Place of Practicing -->
                        <div class="col-md-8">
                            <label class="form-label">
                                <span class="field-badge">13</span> Place of Practicing <span class="text-muted fw-normal">(Current / Most Recent Hospital / Clinic)</span>
                            </label>
                            <input type="text" class="form-control" name="place_of_practicing" value="{{ old('place_of_practicing') }}" placeholder="e.g. Apollo Hospitals / Private Clinic / Independent Home Caregiver, Chennai">
                        </div>

                        <!-- Field 14: Practise Type -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">14</span> Practise Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="practise_type" required>
                                <option value="">Select Practise Type...</option>
                                <option value="Full Time" {{ old('practise_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                <option value="Part Time" {{ old('practise_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                <option value="Home Visit Only" {{ old('practise_type') == 'Home Visit Only' ? 'selected' : '' }}>Home Visit Only</option>
                                <option value="Hospital & Home Care" {{ old('practise_type') == 'Hospital & Home Care' ? 'selected' : '' }}>Hospital & Home Care</option>
                                <option value="12/24 Hr Shifts" {{ old('practise_type') == '12/24 Hr Shifts' ? 'selected' : '' }}>12 / 24 Hr Shifts</option>
                            </select>
                        </div>

                        <!-- Field 15: Years/Months of Experience -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <span class="field-badge">15</span> Years / Months of Experience <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="experience_breakdown" value="{{ old('experience_breakdown') }}" placeholder="e.g. 3 Years 6 Months" required>
                        </div>

                        <!-- Field 16: Overall Experience -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <span class="field-badge">16</span> Overall Experience Summary <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="overall_experience" value="{{ old('overall_experience') }}" placeholder="e.g. 4+ Years Hospital & Home Care" required>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Contact & Residential Details -->
                <div class="form-section-card">
                    <div class="form-section-title">
                        <span class="form-section-icon"><i class="fas fa-address-book"></i></span>
                        <span>4. Contact Numbers & Residential Address</span>
                    </div>

                    <div class="row g-3">
                        <!-- Field 17: Personal Phone 1 -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">17</span> Personal Phone Number 1 <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">+91</span>
                                <input type="tel" class="form-control" name="personal_phone_1" maxlength="10" value="{{ old('personal_phone_1') }}" placeholder="10-digit mobile" required>
                            </div>
                        </div>

                        <!-- Field 18: Emergency Phone 2 -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">18</span> Emergency Phone Number 2
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">+91</span>
                                <input type="tel" class="form-control" name="emergency_phone_2" maxlength="10" value="{{ old('emergency_phone_2') }}" placeholder="Spouse / Parent / Relative">
                            </div>
                        </div>

                        <!-- Field 19: Personal Email -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">19</span> Personal Mail ID <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" name="personal_email" value="{{ old('personal_email') }}" placeholder="name@example.com" required>
                        </div>

                        <!-- Field 20: House / Building Number -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">20</span> House / Building Number
                            </label>
                            <input type="text" class="form-control" name="house_building_no" value="{{ old('house_building_no') }}" placeholder="e.g. Door No. 14/B, Block 2">
                        </div>

                        <!-- Field 21: City / Town Name -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">21</span> City / Town Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="city_town" value="{{ old('city_town') }}" placeholder="e.g. Chennai / Coimbatore / Madurai" required>
                        </div>

                        <!-- Field 22: Pin Code -->
                        <div class="col-md-4">
                            <label class="form-label">
                                <span class="field-badge">22</span> Pin Code <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="pincode" maxlength="6" value="{{ old('pincode') }}" placeholder="6-digit pincode" required>
                        </div>

                        <!-- Field 23: Present Address -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-1" style="min-height: 28px;">
                                <label class="form-label mb-0">
                                    <span class="field-badge">23</span> Present Residential Address <span class="text-danger ms-1">*</span>
                                </label>
                            </div>
                            <textarea class="form-control" name="present_address" id="presentAddress" rows="3" placeholder="Current residential address with street and landmark" required>{{ old('present_address') }}</textarea>
                        </div>

                        <!-- Field 24: Permanent Address -->
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-1" style="min-height: 28px;">
                                <label class="form-label mb-0">
                                    <span class="field-badge">24</span> Permanent Address
                                </label>
                                <label class="form-check-label d-inline-flex align-items-center gap-1 small text-success fw-bold user-select-none" for="sameAddressCheck" style="font-size: 12px; cursor: pointer;">
                                    <input class="form-check-input mt-0 me-1" type="checkbox" id="sameAddressCheck" onchange="copyAddress(this)">
                                    Same as Present
                                </label>
                            </div>
                            <textarea class="form-control" name="permanent_address" id="permanentAddress" rows="3" placeholder="Permanent native address">{{ old('permanent_address') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Terms and Submission -->
                <div class="text-center pt-3">
                    <p class="text-muted small mb-3">
                        <i class="fas fa-shield-alt text-success me-1"></i> By submitting this application, you declare that all information provided is accurate and authentic to the best of your knowledge.
                    </p>
                    <button type="submit" class="btn btn-submit-portal">
                        <i class="fas fa-paper-plane me-2"></i> Submit Caretaker Application
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Portal Footer -->
    <footer class="portal-footer">
        <div class="container">
            <p class="mb-1 fw-bold">{{ \App\Models\Setting::get('brand_name', 'Angelhug') }} Healthcare & Nursing Services</p>
            <p class="mb-0 text-white-50 small">{{ \App\Models\Setting::get('contact_address', 'No.25/25, Ottaipillaiyar Koil Street, Virugambakkam, Chennai, Tamil Nadu - 600092') }} • HR Helpline: {{ $caretakerHrPhone }}</p>
            <p class="mb-0 text-white-50 small mt-1">&copy; {{ date('Y') }} {{ \App\Models\Setting::get('brand_name', 'Angelhug') }}. All Rights Reserved. Official Healthcare Recruitment Portal.</p>
        </div>
    </footer>

    <script>
    function previewPhoto(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 2 * 1024 * 1024) {
                alert('File size exceeds 2MB limit. Please select a photo under 2MB.');
                input.value = '';
                document.getElementById('photoPreview').style.display = 'none';
                document.getElementById('photoPlaceholder').style.display = 'block';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('photoPreview');
                const placeholder = document.getElementById('photoPlaceholder');
                img.src = e.target.result;
                img.style.display = 'block';
                if (placeholder) placeholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }

    function calculateAge() {
        const dobInput = document.getElementById('dobInput');
        const ageInput = document.getElementById('ageInput');
        if (!dobInput.value) return;

        const dob = new Date(dobInput.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        if (age >= 18 && age <= 100) {
            ageInput.value = age;
        }
    }

    function copyAddress(checkbox) {
        const present = document.getElementById('presentAddress').value;
        const permanent = document.getElementById('permanentAddress');
        if (checkbox.checked) {
            permanent.value = present;
        }
    }

    document.getElementById('caretakerForm').addEventListener('submit', function(event) {
        const submitButton = this.querySelector('button[type="submit"]');
        if (this.dataset.submitting === 'true') {
            event.preventDefault();
            return;
        }

        this.dataset.submitting = 'true';
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Submitting...';
    });
    </script>
</body>
</html>
