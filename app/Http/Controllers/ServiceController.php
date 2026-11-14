<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Admin: List all services.
     */
    public function index()
    {
        $services = Service::latest()->paginate(15);
        return view('services.index', compact('services'));
    }

    /**
     * Admin: Show form to create service.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Admin: Store new service.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'price'       => 'required|numeric|min:0',
            'gst_rate'    => 'nullable|numeric|min:0|max:100',
            'platform_fee'=> 'nullable|numeric|min:0|max:100000',
            'extra_charges'=> 'nullable|numeric|min:0|max:100000',
            'extra_charges_label' => 'nullable|string|max:150',
            'duration'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'date'        => 'nullable|date',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only('title', 'subtitle', 'price', 'duration', 'description', 'date', 'extra_charges_label');
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['featured'] = $request->has('featured') ? true : false;
        $data['gst_exempt'] = $request->has('gst_exempt') ? true : false;
        $data['gst_rate'] = $request->filled('gst_rate') ? (float) $request->gst_rate : null;
        $data['platform_fee'] = $request->filled('platform_fee') ? (float) $request->platform_fee : null;
        $data['extra_charges'] = $request->filled('extra_charges') ? (float) $request->extra_charges : 0.00;

        // Single image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // Multiple images
        if ($request->hasFile('images')) {
            $multiImages = [];
            foreach ($request->file('images') as $file) {
                $multiImages[] = $file->store('services', 'public');
            }
            $data['images'] = $multiImages;
        }

        Service::create($data);

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    /**
     * Admin: Show edit service form.
     */
    public function edit(Service $service)
    {
        $service->load('allSubServices');
        return view('services.edit', compact('service'));
    }

    /**
     * Admin: Update service.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'price'       => 'required|numeric|min:0',
            'gst_rate'    => 'nullable|numeric|min:0|max:100',
            'platform_fee'=> 'nullable|numeric|min:0|max:100000',
            'extra_charges'=> 'nullable|numeric|min:0|max:100000',
            'extra_charges_label' => 'nullable|string|max:150',
            'duration'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'date'        => 'nullable|date',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only('title', 'subtitle', 'price', 'duration', 'description', 'date', 'extra_charges_label');
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['featured'] = $request->has('featured') ? true : false;
        $data['gst_exempt'] = $request->has('gst_exempt') ? true : false;
        $data['gst_rate'] = $request->filled('gst_rate') ? (float) $request->gst_rate : null;
        $data['platform_fee'] = $request->filled('platform_fee') ? (float) $request->platform_fee : null;
        $data['extra_charges'] = $request->filled('extra_charges') ? (float) $request->extra_charges : 0.00;

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        if ($request->hasFile('images')) {
            $multiImages = $service->images ?? [];
            foreach ($request->file('images') as $file) {
                $multiImages[] = $file->store('services', 'public');
            }
            $data['images'] = $multiImages;
        }

        $service->update($data);

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * Admin: Delete service.
     */
    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }

    /**
     * Frontend: List services.
     */
    public function serviceview()
    {
        $services = Service::with('subServices')->where('is_active', true)->latest()->get();
        return view('service', compact('services'));
    }

    /**
     * Frontend: Service details.
     */
    public function servicedetails($id)
    {
        $service = Service::with('subServices')->findOrFail($id);
        $details = Service::with('subServices')->where('id', '!=', $id)->where('is_active', true)->latest()->take(3)->get();
        return view('service_detail', compact('service', 'details'));
    }
}
