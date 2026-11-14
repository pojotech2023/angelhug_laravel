<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SubService;
use Illuminate\Http\Request;

class SubServiceController extends Controller
{
    /**
     * Store a newly created sub-service under a main service.
     */
    public function store(Request $request, Service $service)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'subtitle'   => 'nullable|string|max:255',
            'price'      => 'required|numeric|min:0',
            'duration'   => 'nullable|string|max:100',
            'features'   => 'nullable|string', // newline separated or comma separated
            'sort_order' => 'nullable|integer',
        ]);

        $features = [];
        if ($request->filled('features')) {
            $raw = $request->input('features');
            $lines = preg_split('/[\r\n]+/', $raw);
            $features = array_values(array_filter(array_map('trim', $lines)));
        }

        $service->subServices()->create([
            'title'      => $request->input('title'),
            'subtitle'   => $request->input('subtitle'),
            'price'      => (float) $request->input('price'),
            'duration'   => $request->input('duration'),
            'features'   => $features,
            'is_active'  => $request->has('is_active') ? true : false,
            'sort_order' => (int) $request->input('sort_order', 0),
        ]);

        return redirect()->back()->with('success', 'Care Plan / Sub-Service added successfully!');
    }

    /**
     * Update an existing sub-service.
     */
    public function update(Request $request, SubService $subService)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'subtitle'   => 'nullable|string|max:255',
            'price'      => 'required|numeric|min:0',
            'duration'   => 'nullable|string|max:100',
            'features'   => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $features = [];
        if ($request->filled('features')) {
            $raw = $request->input('features');
            $lines = preg_split('/[\r\n]+/', $raw);
            $features = array_values(array_filter(array_map('trim', $lines)));
        }

        $subService->update([
            'title'      => $request->input('title'),
            'subtitle'   => $request->input('subtitle'),
            'price'      => (float) $request->input('price'),
            'duration'   => $request->input('duration'),
            'features'   => $features,
            'is_active'  => $request->has('is_active') ? true : false,
            'sort_order' => (int) $request->input('sort_order', 0),
        ]);

        return redirect()->back()->with('success', 'Care Plan / Sub-Service updated successfully!');
    }

    /**
     * Remove the specified sub-service.
     */
    public function destroy(SubService $subService)
    {
        $subService->delete();
        return redirect()->back()->with('success', 'Care Plan / Sub-Service deleted successfully!');
    }
}
