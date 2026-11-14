<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Service;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class AdminBillingSettingController extends Controller
{
    /**
     * Show billing & GST settings management panel.
     */
    public function index()
    {
        $settings = Setting::getBillingSettings();
        $services = Service::orderBy('id', 'asc')->get();

        return view('admin.billing.index', compact('settings', 'services'));
    }

    /**
     * Update global and per-service GST, Platform Fee & Extra Charges.
     */
    public function update(Request $request)
    {
        $request->validate([
            'gst_percentage' => 'nullable|numeric|min:0|max:100',
            'platform_fee' => 'nullable|numeric|min:0|max:100000',
            'gstin_number' => 'nullable|string|max:30',
        ]);

        $gstEnabled = $request->has('gst_enabled') && $request->input('gst_enabled') == '1';
        Setting::set('gst_enabled', $gstEnabled, 'boolean');

        if ($request->filled('gst_percentage')) {
            Setting::set('gst_percentage', (float) $request->input('gst_percentage'), 'decimal');
        }

        if ($request->filled('platform_fee')) {
            Setting::set('platform_fee', (float) $request->input('platform_fee'), 'decimal');
        }

        if ($request->filled('gstin_number')) {
            Setting::set('gstin_number', trim($request->input('gstin_number')), 'string');
        }

        // Update per-service GST and Extra Charges
        $servicesData = $request->input('services', []);
        foreach ($servicesData as $serviceId => $data) {
            $service = Service::find($serviceId);
            if ($service) {
                $isExempt = !empty($data['gst_exempt']) || (isset($data['gst_rate']) && $data['gst_rate'] === 'exempt');
                $service->gst_exempt = $isExempt;

                if ($isExempt) {
                    $service->gst_rate = 0.00;
                } elseif (isset($data['gst_rate']) && $data['gst_rate'] !== '' && $data['gst_rate'] !== 'default') {
                    $service->gst_rate = (float) $data['gst_rate'];
                } else {
                    $service->gst_rate = null; // Inherits global default
                }

                $service->platform_fee = (isset($data['platform_fee']) && $data['platform_fee'] !== '') ? (float) $data['platform_fee'] : null;
                $service->extra_charges = !empty($data['extra_charges']) ? (float) $data['extra_charges'] : 0.00;
                $service->extra_charges_label = !empty($data['extra_charges_label']) ? trim($data['extra_charges_label']) : null;
                $service->save();
            }
        }

        Setting::clearCache();

        return redirect()->route('admin.billing.index')->with('success', 'Service GST rates, platform fees, and extra charges saved successfully!');
    }

    /**
     * Legacy bulk update route fallback.
     */
    public function updateServicesBilling(Request $request)
    {
        return $this->update($request);
    }
}
