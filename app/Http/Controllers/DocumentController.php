<?php
namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'type' => 'required',
        'description' => 'required',
        'button_name' => 'required',
        'file' => 'nullable|mimes:pdf,jpg,png,docx',
    ]);

    $fileName = null;

    if ($request->hasFile('file')) {
        $fileName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads/documents'), $fileName);
    }

    Document::create([
        'type' => $request->type,
        'description' => $request->description,
        'button_name' => $request->button_name,
        'file' => $fileName,
    ]);

    return redirect()->route('documents.index')->with('success', 'Added Successfully');
}

    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

   public function update(Request $request, Document $document)
{
    $request->validate([
        'type' => 'required',
        'description' => 'required',
        'button_name' => 'required',
    ]);

    if ($request->hasFile('file')) {
        $fileName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads/documents'), $fileName);
    } else {
        $fileName = $document->file;
    }

    $document->update([
        'type' => $request->type,
        'description' => $request->description,
        'button_name' => $request->button_name,
        'file' => $fileName,
    ]);

    return redirect()->route('documents.index')->with('success', 'Updated Successfully');
}

    public function destroy(Document $document)
    {
        $document->delete();
        return back()->with('success', 'Deleted Successfully');
    }
}
