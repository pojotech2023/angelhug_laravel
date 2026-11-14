<?php

namespace App\Http\Controllers;

use App\Models\ServiceEnquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceEnquiry::with('service')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $enquiries = $query->paginate(15);
        $statusCounts = [
            'all' => ServiceEnquiry::count(),
            'new' => ServiceEnquiry::where('status', 'new')->count(),
            'contacted' => ServiceEnquiry::where('status', 'contacted')->count(),
            'resolved' => ServiceEnquiry::where('status', 'resolved')->count(),
        ];

        return view('admin.enquiries.index', compact('enquiries', 'statusCounts'));
    }

    public function show($id)
    {
        $enquiry = ServiceEnquiry::with('service')->findOrFail($id);
        return response()->json($enquiry);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,resolved',
            'admin_notes' => 'nullable|string',
        ]);

        $enquiry = ServiceEnquiry::findOrFail($id);
        $enquiry->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes ?? $enquiry->admin_notes,
        ]);

        return redirect()->back()->with('success', 'Enquiry status updated successfully.');
    }

    public function destroy($id)
    {
        $enquiry = ServiceEnquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry deleted successfully.');
    }
}
