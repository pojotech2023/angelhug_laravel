<?php

namespace App\Http\Controllers;
use App\Models\Leader;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    public function index()
    {
        $leaders = Leader::orderBy('id', 'DESC')->get();
        return view('leaders.index', compact('leaders'));
    }

    public function create()
    {
        return view('leaders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('leaders', 'public');
        }

        Leader::create($data);

        return redirect()->route('leaders.index')->with('success', 'Leader added successfully!');
    }

    public function edit(Leader $leader)
    {
        return view('leaders.edit', compact('leader'));
    }

    public function update(Request $request, Leader $leader)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($leader->image) {
                unlink(public_path('storage/' . $leader->image));
            }
            $data['image'] = $request->file('image')->store('leaders', 'public');
        }

        $leader->update($data);

        return redirect()->route('leaders.index')->with('success', 'Updated successfully!');
    }

    public function destroy(Leader $leader)
    {
        if ($leader->image) {
            unlink(public_path('storage/' . $leader->image));
        }

        $leader->delete();

        return back()->with('success', 'Deleted successfully!');
    }
}
