<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile_no', 'like', "%{$search}%");
            });
        }

        $customers = $query->paginate(20);

        // Fetch bookings count and total spend for each customer
        $customers->getCollection()->transform(function ($customer) {
            $customerBookings = ServiceBooking::where('user_id', $customer->id)
                ->orWhere('customer_phone', $customer->mobile_no)
                ->get();

            $customer->total_bookings = $customerBookings->count();
            $customer->total_spent = $customerBookings->where('payment_status', 'paid')->sum('amount');
            $customer->latest_booking = $customerBookings->sortByDesc('created_at')->first();

            return $customer;
        });

        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = User::findOrFail($id);
        $bookings = ServiceBooking::with('service')
            ->where('user_id', $customer->id)
            ->orWhere('customer_phone', $customer->mobile_no)
            ->latest()
            ->get();

        return view('admin.customers.show', compact('customer', 'bookings'));
    }
}
