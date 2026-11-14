<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminWebsiteSettingController extends Controller
{
    /**
     * Default terms & conditions text if not customized yet.
     */
    public const DEFAULT_TERMS = "1. Certified Clinical Quality & Vetting\nAll healthcare caregivers, nurses, and certified therapists dispatched are professionally credentialed, background-verified with government identification, and clinically trained according to standard hospital protocols.\n\n2. Medical Care Protocols & Safety\nOur staff adheres strictly to the prescribed doctor's treatment regimens, vital monitoring, and infection control standards. Patients and families agree to maintain a safe, hygienic, and respectful working environment for on-duty clinical caregivers.\n\n3. Emergency & Medication Administration\nEmergency medications and life-support interventions are administered strictly in accordance with written registered medical practitioner (RMP) orders and consent provided during appointment scheduling.\n\n4. Confidentiality & Medical Records\nAll patient health information, uploaded medical diagnostic reports, discharge summaries, and visit notes are encrypted and processed in strict compliance with medical confidentiality standards.";

    /**
     * Default cancellation policy text.
     */
    public const DEFAULT_CANCELLATION = "1. Rescheduling & Advance Notice\nAppointments may be rescheduled or adjusted without penalty up to 4 hours prior to the scheduled daily shift start time via the patient portal or 24/7 care helpline.\n\n2. Cancellation & Refunds\nCancellations made at least 4 hours before caregiver dispatch are eligible for full refund or service credit. In the event of emergency hospitalization or critical physician reassessment, special consideration is provided with immediate concierge assistance.";

    /**
     * Default About Section Content
     */
    public const DEFAULT_ABOUT_TITLE = 'Hospital-Quality Care in the Comfort of Your Home';
    public const DEFAULT_ABOUT_DESC_1 = "Angelhug is a premier healthcare and patient care provider committed to delivering dedicated in-home nursing, post-surgical assistance, infant care, and physical therapy. We know healing happens best in the warmth, dignity, and familiarity of family surroundings.";
    public const DEFAULT_ABOUT_DESC_2 = "Our trained and background-verified nurses strictly observe hospital hygiene protocols, monitor vitals continuously, coordinate with family physicians, and treat every patient with heartfelt empathy.";
    public const DEFAULT_ABOUT_POINT_1 = 'Geriatric & Elderly Care';
    public const DEFAULT_ABOUT_POINT_2 = 'Post-Operative Recovery';
    public const DEFAULT_ABOUT_POINT_3 = 'Mother & Infant Care';
    public const DEFAULT_ABOUT_POINT_4 = 'Certified Therapist Care';

    /**
     * Show website branding, logo text, about image, contact info, and terms & conditions management panel.
     */
    public function index()
    {
        $brandName = Setting::get('brand_name', 'Angelhug');
        $brandTagline = Setting::get('brand_tagline', 'Healthcare Services');
        $adminPanelTitle = Setting::get('admin_panel_title', 'Angelhug Web Administration');
        $adminPanelSubtitle = Setting::get('admin_panel_subtitle', 'HEALTHCARE MANAGEMENT');
        $websiteLogo = Setting::get('website_logo');
        $aboutImage = Setting::get('about_image');
        $contactAddress = Setting::get('contact_address', 'No.25/25, Ottaipillaiyar Koil Street, Ranganathan Nagar, Virugambakkam, Chennai, Tamil Nadu-600092');
        $contactPhone = Setting::get('contact_phone', '+91 80725 15050');
        $caretakerHrPhone = Setting::get('caretaker_hr_phone', '+91 80725 15050');
        $contactEmail = Setting::get('contact_email', 'angelhug.official@gmail.com');
        $googleMapDirectionsLink = Setting::get('google_map_directions_link', 'https://goo.gl/maps/U5MvBvajYsQmWqUR9');
        $googleMapsApiKey = Setting::get('google_maps_api_key');
        $socialFacebook = Setting::get('social_facebook', 'https://facebook.com/angelhug');
        $socialInstagram = Setting::get('social_instagram', 'https://instagram.com/angelhug');
        $socialYoutube = Setting::get('social_youtube', 'https://youtube.com/@angelhug');
        $socialTwitter = Setting::get('social_twitter', 'https://twitter.com/angelhug');
        $socialLinkedin = Setting::get('social_linkedin', 'https://linkedin.com/company/angelhug');
        $termsAndConditions = Setting::get('terms_and_conditions', self::DEFAULT_TERMS);
        $cancellationPolicy = Setting::get('cancellation_policy', self::DEFAULT_CANCELLATION);
        $termsCheckboxLabel = Setting::get('terms_checkbox_label', 'I confirm details are accurate and agree to :brand\'s Terms of Service, Clinical Protocols & Cancellation Policy.');

        // About Us section content
        $aboutBadge = Setting::get('about_badge', 'About ' . $brandName);
        $aboutTitle = Setting::get('about_title', self::DEFAULT_ABOUT_TITLE);
        $aboutDescription1 = Setting::get('about_description_1', self::DEFAULT_ABOUT_DESC_1);
        $aboutDescription2 = Setting::get('about_description_2', self::DEFAULT_ABOUT_DESC_2);
        $aboutPoint1 = Setting::get('about_point_1', self::DEFAULT_ABOUT_POINT_1);
        $aboutPoint2 = Setting::get('about_point_2', self::DEFAULT_ABOUT_POINT_2);
        $aboutPoint3 = Setting::get('about_point_3', self::DEFAULT_ABOUT_POINT_3);
        $aboutPoint4 = Setting::get('about_point_4', self::DEFAULT_ABOUT_POINT_4);

        return view('admin.settings.website', compact(
            'brandName',
            'brandTagline',
            'adminPanelTitle',
            'adminPanelSubtitle',
            'websiteLogo',
            'aboutImage',
            'contactAddress',
            'contactPhone',
            'caretakerHrPhone',
            'contactEmail',
            'googleMapDirectionsLink',
            'googleMapsApiKey',
            'socialFacebook',
            'socialInstagram',
            'socialYoutube',
            'socialTwitter',
            'socialLinkedin',
            'termsAndConditions',
            'cancellationPolicy',
            'termsCheckboxLabel',
            'aboutBadge',
            'aboutTitle',
            'aboutDescription1',
            'aboutDescription2',
            'aboutPoint1',
            'aboutPoint2',
            'aboutPoint3',
            'aboutPoint4'
        ));
    }

    /**
     * Save branding identity, logo, about image, contact info, social links, and terms & conditions.
     */
    public function update(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:100',
            'brand_tagline' => 'nullable|string|max:150',
            'admin_panel_title' => 'nullable|string|max:150',
            'admin_panel_subtitle' => 'nullable|string|max:100',
            'website_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:3072',
            'about_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'contact_address' => 'nullable|string|max:500',
            'contact_phone' => 'nullable|string|max:100',
            'caretaker_hr_phone' => 'nullable|string|max:100',
            'contact_email' => 'nullable|email|max:100',
            'google_map_directions_link' => 'nullable|string|max:500',
            'google_maps_api_key' => 'nullable|string|max:255',
            'about_badge' => 'nullable|string|max:100',
            'about_title' => 'nullable|string|max:255',
            'about_description_1' => 'nullable|string|max:2500',
            'about_description_2' => 'nullable|string|max:2500',
            'about_point_1' => 'nullable|string|max:150',
            'about_point_2' => 'nullable|string|max:150',
            'about_point_3' => 'nullable|string|max:150',
            'about_point_4' => 'nullable|string|max:150',
            'social_facebook' => 'nullable|string|max:255',
            'social_instagram' => 'nullable|string|max:255',
            'social_youtube' => 'nullable|string|max:255',
            'social_twitter' => 'nullable|string|max:255',
            'social_linkedin' => 'nullable|string|max:255',
            'terms_and_conditions' => 'required|string',
            'cancellation_policy' => 'nullable|string',
            'terms_checkbox_label' => 'nullable|string|max:255',
        ]);

        Setting::set('brand_name', trim($request->input('brand_name')), 'string');
        Setting::set('brand_tagline', trim($request->input('brand_tagline', 'Healthcare Services')), 'string');
        Setting::set('admin_panel_title', trim($request->input('admin_panel_title', $request->input('brand_name') . ' Web Administration')), 'string');
        Setting::set('admin_panel_subtitle', trim($request->input('admin_panel_subtitle', 'HEALTHCARE MANAGEMENT')), 'string');

        // Handle logo upload
        if ($request->hasFile('website_logo')) {
            $file = $request->file('website_logo');
            $logoPath = $file->store('logos', 'public');
            Setting::set('website_logo', $logoPath, 'string');
        } elseif ($request->has('remove_custom_logo') && $request->input('remove_custom_logo') == '1') {
            Setting::set('website_logo', null, 'string');
        }

        // Handle About Section image upload
        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $aboutPath = $file->store('about', 'public');
            Setting::set('about_image', $aboutPath, 'string');
        } elseif ($request->has('remove_custom_about_image') && $request->input('remove_custom_about_image') == '1') {
            Setting::set('about_image', null, 'string');
        }

        // About Us section content
        Setting::set('about_badge', trim($request->input('about_badge', 'About ' . $request->input('brand_name'))), 'string');
        Setting::set('about_title', trim($request->input('about_title', self::DEFAULT_ABOUT_TITLE)), 'string');
        Setting::set('about_description_1', trim($request->input('about_description_1', self::DEFAULT_ABOUT_DESC_1)), 'string');
        Setting::set('about_description_2', trim($request->input('about_description_2', self::DEFAULT_ABOUT_DESC_2)), 'string');
        Setting::set('about_point_1', trim($request->input('about_point_1', self::DEFAULT_ABOUT_POINT_1)), 'string');
        Setting::set('about_point_2', trim($request->input('about_point_2', self::DEFAULT_ABOUT_POINT_2)), 'string');
        Setting::set('about_point_3', trim($request->input('about_point_3', self::DEFAULT_ABOUT_POINT_3)), 'string');
        Setting::set('about_point_4', trim($request->input('about_point_4', self::DEFAULT_ABOUT_POINT_4)), 'string');

        // Contact info & Caretaker HR helpline
        if ($request->has('contact_address')) {
            Setting::set('contact_address', trim($request->input('contact_address')), 'string');
        }
        if ($request->has('contact_phone')) {
            Setting::set('contact_phone', trim($request->input('contact_phone')), 'string');
        }
        if ($request->has('caretaker_hr_phone')) {
            Setting::set('caretaker_hr_phone', trim($request->input('caretaker_hr_phone')), 'string');
        }
        if ($request->has('contact_email')) {
            Setting::set('contact_email', trim($request->input('contact_email')), 'string');
        }
        if ($request->has('google_map_directions_link')) {
            Setting::set('google_map_directions_link', trim($request->input('google_map_directions_link')), 'string');
        }
        if ($request->has('google_maps_api_key')) {
            Setting::set('google_maps_api_key', trim($request->input('google_maps_api_key')), 'string');
        }

        // Social Media Links
        Setting::set('social_facebook', trim($request->input('social_facebook', '')), 'string');
        Setting::set('social_instagram', trim($request->input('social_instagram', '')), 'string');
        Setting::set('social_youtube', trim($request->input('social_youtube', '')), 'string');
        Setting::set('social_twitter', trim($request->input('social_twitter', '')), 'string');
        Setting::set('social_linkedin', trim($request->input('social_linkedin', '')), 'string');

        // Terms and cancellation policy
        Setting::set('terms_and_conditions', trim($request->input('terms_and_conditions')), 'string');
        Setting::set('cancellation_policy', trim($request->input('cancellation_policy', '')), 'string');
        Setting::set('terms_checkbox_label', trim($request->input('terms_checkbox_label', '')), 'string');

        Setting::clearCache();

        return redirect()->route('admin.website_settings.index')->with('success', 'Website settings, about image, contact info, social links, and policies saved successfully!');
    }
}
