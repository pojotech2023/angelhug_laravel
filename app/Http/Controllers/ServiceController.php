<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
     public function index()
    {
        $services = Service::latest()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'nullable|date',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = $request->only('title','subtitle','description','date');

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

        return redirect()->route('services.index')->with('success','Service created successfully!');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'nullable|date',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = $request->only('title','subtitle','description','date');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        if ($request->hasFile('images')) {
            $multiImages = [];
            foreach ($request->file('images') as $file) {
                $multiImages[] = $file->store('services', 'public');
            }
            $data['images'] = $multiImages;
        }

        $service->update($data);

        return redirect()->route('services.index')->with('success','Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success','Service deleted successfully!');
    }

     public function serviceview()
{
    $services = Service::latest()->get();
    return view('service', compact('services'));
}
public function servicedetails($id)
{
    $service = Service::findOrFail($id); // Will throw 404 if not found
    $details = Service::latest()->take(3)->get();
    return view('service_detail', compact('service', 'details'));
}
}
