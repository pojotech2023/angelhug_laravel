@php
    $footerBrandName = \App\Models\Setting::get('brand_name', 'Angelhug');
    $footerBrandTagline = \App\Models\Setting::get('brand_tagline', 'Healthcare');
    $footerCustomLogo = \App\Models\Setting::get('website_logo');
    $footerLogoUrl = $footerCustomLogo ? asset('storage/' . $footerCustomLogo) : asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png');
    $footerAddress = \App\Models\Setting::get('contact_address', 'No.25/25, Ottaipillaiyar Koil Street, Ranganathan Nagar, Virugambakkam, Chennai, Tamil Nadu-600092');
    $footerMapLink = \App\Models\Setting::get('google_map_directions_link', 'https://goo.gl/maps/U5MvBvajYsQmWqUR9');
    $footerPhone = \App\Models\Setting::get('contact_phone', '+91 80725 15050');
    $footerEmail = \App\Models\Setting::get('contact_email', 'angelhug.official@gmail.com');
    $socialFacebook = \App\Models\Setting::get('social_facebook', 'https://facebook.com/angelhug');
    $socialInstagram = \App\Models\Setting::get('social_instagram', 'https://instagram.com/angelhug');
    $socialYoutube = \App\Models\Setting::get('social_youtube', 'https://youtube.com/@angelhug');
    $socialTwitter = \App\Models\Setting::get('social_twitter');
    $socialLinkedin = \App\Models\Setting::get('social_linkedin');
@endphp
<footer>
    <div class="footer-container">
        <div class="container">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-logo-wrap" style="background: #ffffff; padding: 16px 26px; border-radius: 18px; display: inline-block; margin-bottom: 22px; box-shadow: 0 10px 30px rgba(0,0,0,0.25);">
                        <img src="{{ $footerLogoUrl }}" alt="{{ $footerBrandName }} Logo" style="height: 98px; max-height: 108px; width: auto; display: block;" />
                    </div>
                    <h3 style="color: #00bbd7; font-weight: 800; font-size: 22px; margin-bottom: 12px;">{{ $footerBrandName }} {{ $footerBrandTagline }}</h3>
                    <p style="color: rgba(255,255,255,0.9); line-height: 1.85; font-size: 15.5px;">
                        {{ $footerBrandName }} is committed to providing compassionate, professional, and accessible home healthcare and nursing services. Our certified staff ensures comfort, dignity, and recovery for seniors, infants, and patients in need.
                    </p>
                    <!-- Social Links -->
                    <div class="footer-social-links mt-3 d-flex gap-2 flex-wrap">
                        @if($socialFacebook)
                        <a href="{{ $socialFacebook }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; font-size: 17px;" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif
                        @if($socialInstagram)
                        <a href="{{ $socialInstagram }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; font-size: 17px;" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                        @if($socialYoutube)
                        <a href="{{ $socialYoutube }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; font-size: 17px;" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        @endif
                        @if($socialTwitter)
                        <a href="{{ $socialTwitter }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; font-size: 17px;" title="Twitter / X">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        @endif
                        @if($socialLinkedin)
                        <a href="{{ $socialLinkedin }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; font-size: 17px;" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Useful Links -->
                <div class="col-lg-3 col-md-6">
                    <h3 style="color: #00bbd7; font-weight: 800; font-size: 22px; margin-bottom: 18px;">Quick Navigation</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="{{route('home')}}" style="font-size: 16px; font-weight: 600;"><i class="fas fa-angle-right me-2" style="color: #95ca57; font-size: 17px;"></i> Home</a></li>
                        <li class="mb-3"><a href="{{route('about')}}" style="font-size: 16px; font-weight: 600;"><i class="fas fa-angle-right me-2" style="color: #95ca57; font-size: 17px;"></i> About Us</a></li>
                        <li class="mb-3"><a href="{{route('service')}}" style="font-size: 16px; font-weight: 600;"><i class="fas fa-angle-right me-2" style="color: #95ca57; font-size: 17px;"></i> Services</a></li>
                        <li class="mb-3"><a href="{{route('contact')}}" style="font-size: 16px; font-weight: 600;"><i class="fas fa-angle-right me-2" style="color: #95ca57; font-size: 17px;"></i> Contact Us</a></li>
                        @auth
                        <li class="mb-3"><a href="{{route('service.history')}}" style="font-size: 16px; font-weight: 600;"><i class="fas fa-angle-right me-2" style="color: #95ca57; font-size: 17px;"></i> Service History</a></li>
                        @endauth
                        <!--<li class="mb-3"><a href="{{route('admin.login')}}" style="font-size: 16px; font-weight: 600;"><i class="fas fa-lock me-2 text-warning"></i> Admin Portal</a></li>-->
                    </ul>
                </div>

                <!-- Contact Us -->
                <div class="col-lg-5 col-md-12">
                    <h3 style="color: #00bbd7; font-weight: 800; font-size: 22px; margin-bottom: 18px;">Contact Details</h3>
                    <p class="mb-3" style="font-size: 15.5px; line-height: 1.7;">
                        <i class="fas fa-map-marker-alt me-2 fs-5" style="color: #95ca57;"></i> 
                        <strong style="font-size: 16px;">Office Location:</strong><br>
                        {{ $footerAddress }}
                    </p>
                    @if($footerMapLink)
                    <p class="mb-3">
                        <a href="{{ $footerMapLink }}" target="_blank" class="btn btn-sm btn-outline-light px-3 py-2 fw-bold" style="border-color: #00bbd7; color: #00bbd7; font-size: 14.5px; border-radius: 8px;">
                            <i class="fas fa-location-arrow me-2"></i> Open Google Map Directions
                        </a>
                    </p>
                    @endif
                    <p class="mb-3" style="font-size: 16px;">
                        <i class="fas fa-phone-alt me-2 fs-5" style="color: #95ca57;"></i> 
                        <strong>Phone:</strong> <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}" class="fw-bold fs-5 text-white ms-1">{{ $footerPhone }}</a>
                    </p>
                    <p class="mb-3" style="font-size: 16px;">
                        <i class="fas fa-envelope me-2 fs-5" style="color: #95ca57;"></i> 
                        <strong>Email:</strong> <a href="mailto:{{ $footerEmail }}" class="fw-bold text-white ms-1">{{ $footerEmail }}</a>
                    </p>
                </div>
            </div>

            <div class="footer-bottom-border mt-5 pt-3 border-top border-secondary text-center small text-white-50">
                <p class="mb-0" style="font-size: 14.5px;">© {{ date('Y') }} {{ $footerBrandName }}. All Rights Reserved. Compassionate Healthcare & Home Nursing Care. | <a href="{{ route('terms.public') }}" class="text-white-50 text-decoration-underline ms-1">Terms & Conditions</a></p>
            </div>
        </div>
    </div>
</footer>

<style>
body { margin-bottom: 0 !important; padding-bottom: 0 !important; }
.footer-container {
    background: linear-gradient(180deg, #024724 0%, #012412 100%);
    color: #ffffff;
    padding: 60px 20px 30px;
    font-size: 15.5px;
    line-height: 1.8;
}

.footer-container a {
    color: #e2e8f0 !important;
    text-decoration: none;
    transition: color 0.2s ease;
}

.footer-container a:hover {
    color: #00bbd7 !important;
}

.footer-social-links a:hover {
    background: #00bbd7 !important;
    border-color: #00bbd7 !important;
    color: #012412 !important;
    transform: translateY(-2px);
}
</style>

	<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="{{ asset('js/vendor/modernizr-3.5.0.min.js')}}"></script>
	<script src="{{ asset('js/vendor/jquery-3.5.1.min.js')}}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('js/plugin.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
	<script src="{{ asset('js/preloader.js')}}"></script>
	<!--common script file-->
	<script src="{{ asset('js/main.js')}}"></script>
</body>
</html>
