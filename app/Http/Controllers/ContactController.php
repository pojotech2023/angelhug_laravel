<?php

namespace App\Http\Controllers;

use App\Models\ServiceEnquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a contact or service enquiry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:20',
            'service_id' => 'nullable|exists:services,id',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        ServiceEnquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'service_id' => $validated['service_id'] ?? null,
            'subject' => $validated['subject'] ?? 'Website Contact Enquiry',
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your enquiry has been received. Our team will contact you shortly.',
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! Your enquiry has been received. Our team will contact you shortly.');
    }
}
