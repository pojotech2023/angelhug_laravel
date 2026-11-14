<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceBooking::with(['service', 'user'])->latest();

        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('razorpay_payment_id', 'like', "%{$search}%");
            });
        }

        $bookings = $query->paginate(15);

        $counts = [
            'all' => ServiceBooking::count(),
            'confirmed' => ServiceBooking::where('booking_status', 'confirmed')->count(),
            'completed' => ServiceBooking::where('booking_status', 'completed')->count(),
            'cancelled' => ServiceBooking::where('booking_status', 'cancelled')->count(),
            'paid' => ServiceBooking::where('payment_status', 'paid')->count(),
        ];

        return view('admin.bookings.index', compact('bookings', 'counts'));
    }

    public function show($id)
    {
        $booking = ServiceBooking::with(['service', 'user'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'booking_status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $booking = ServiceBooking::findOrFail($id);
        $booking->update([
            'booking_status' => $request->booking_status,
            'payment_status' => $request->payment_status,
            'notes' => $request->notes ?? $booking->notes,
        ]);

        return redirect()->back()->with('success', 'Booking updated successfully.');
    }

    public function updateBilling(Request $request, $id)
    {
        $request->validate([
            'gst_rate' => 'required|numeric|min:0|max:100',
            'extra_charges' => 'nullable|numeric|min:0',
            'platform_fee' => 'nullable|numeric|min:0',
            'base_fee' => 'nullable|numeric|min:0',
        ]);

        $booking = ServiceBooking::findOrFail($id);

        $baseFee = (float) ($request->filled('base_fee') ? $request->base_fee : $booking->effective_base_fee);
        $platformFee = (float) ($request->filled('platform_fee') ? $request->platform_fee : $booking->effective_platform_fee);
        $extraCharges = (float) ($request->filled('extra_charges') ? $request->extra_charges : 0);
        $gstRate = (float) $request->gst_rate;

        $taxable = $baseFee + $platformFee + $extraCharges;
        $gstAmount = round($taxable * ($gstRate / 100), 2);
        $totalAmount = round($taxable + $gstAmount, 2);

        $booking->update([
            'base_fee' => $baseFee,
            'platform_fee' => $platformFee,
            'extra_charges' => $extraCharges,
            'gst_rate' => $gstRate,
            'gst_amount' => $gstAmount,
            'amount' => $totalAmount,
        ]);

        return redirect()->back()->with('success', 'Billing breakdown, GST rate (' . $gstRate . '%), and extra charges updated successfully.');
    }

    public function destroy($id)
    {
        $booking = ServiceBooking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
