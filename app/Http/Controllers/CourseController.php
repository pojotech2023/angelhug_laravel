<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('type', 'course')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('courses.index', compact('courses'));
    }
    
    public function create()
    {
        return view('courses.create');
    }
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'class_name' => 'required',
        'short_desc' => 'required',
        'long_desc' => 'required',
        'price' => 'required',
        'image' => 'required|image',
        'duration' => 'required|integer',
        'language' => 'required|string',
        'certifications' => 'required|string',
        'mode' => 'required|string'
    ]);

    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('uploads/courses'), $imageName);

    Course::create([
        'title' => $request->title,
        'class_name' => $request->class_name,
        'short_desc' => $request->short_desc,
        'long_desc' => $request->long_desc,
        'price' => $request->price,
        'image' => 'uploads/courses/'.$imageName,
        'duration' => $request->duration,
        'language' => $request->language,
        'certifications' => $request->certifications,
        'mode' => $request->mode,
        'sort_order' => $request->input('sort_order', 0),
    ]);

    return redirect()->route('courses.index')->with('success', 'Course Added Successfully');

}
  public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }
     public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return back()->with('success','Course Deleted Successfully');
    }
public function frontentview($type)
    {
            $courses = Course::where('type', $type)
                ->orderByRaw('(CASE WHEN sort_order = 0 OR sort_order IS NULL THEN 1 ELSE 0 END), sort_order ASC, id DESC')
                ->get();


        return view('course', compact('courses','type'));
    }

    private function sortCoursesByPurchaseFrequency($courses)
    {
        $purchaseCounts = [];

        Order::where('status', 'completed')
            ->get(['items'])
            ->each(function ($order) use (&$purchaseCounts) {
                foreach (($order->items ?? []) as $item) {
                    $courseId = $item['course_id'] ?? null;
                    $title = trim((string) ($item['title'] ?? ''));
                    $key = $courseId ? 'id:' . $courseId : 'title:' . strtolower($title);

                    if ($key === 'title:') {
                        continue;
                    }

                    $purchaseCounts[$key] = ($purchaseCounts[$key] ?? 0) + (int) ($item['qty'] ?? 1);
                }
            });

        return $courses
            ->map(function ($course) use ($purchaseCounts) {
                $purchaseKey = 'id:' . $course->id;
                $fallbackKey = 'title:' . strtolower(trim((string) $course->title));

                $course->purchase_count = $purchaseCounts[$purchaseKey]
                    ?? $purchaseCounts[$fallbackKey]
                    ?? 0;

                return $course;
            })
            ->sort(function ($first, $second) {
                if ($first->purchase_count !== $second->purchase_count) {
                    return $second->purchase_count <=> $first->purchase_count;
                }

                return $second->created_at <=> $first->created_at;
            })
            ->values();
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        
        return view('detail', compact('course'));
    }

    public function update(Request $request, $id)
{
    $course = Course::findOrFail($id);

    $request->validate([
        'title' => 'required',
        'class_name' => 'required',
        'short_desc' => 'required',
        'long_desc' => 'required',
        'price' => 'required',
        'image' => 'image',
        'duration' => 'required|integer',
        'language' => 'required|string',
        'certifications' => 'required|string',
        'mode' => 'required|string'
    ]);

    $image = $course->image;

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/courses'), $imageName);
        $image = 'uploads/courses/'.$imageName;
    }

    $course->update([
        'title' => $request->title,
        'class_name' => $request->class_name,
        'short_desc' => $request->short_desc,
        'long_desc' => $request->long_desc,
        'price' => $request->price,
        'image' => $image,
        'duration' => $request->duration,
        'language' => $request->language,
        'certifications' => $request->certifications,
        'mode' => $request->mode,
        'sort_order' => $request->input('sort_order', 0),
    ]);

    return redirect()->route('courses.index')->with('success', 'Course Updated Successfully');
}
public function bookindex()
{
    $courses = Course::where('type', 'book')
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'desc')
        ->paginate(20);
    return view('book.index', compact('courses'));
}
  public function createbook()
    {
        return view('book.create');
    }

public function storeBook(Request $request)
{
    
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'short_desc' => 'required',
        'image' => 'required|image',
        'pdf_file' => 'nullable|mimes:pdf',
        'price' => 'required',
    ]);

    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('uploads/courses'), $imageName);

    $pdfPath = null;

    if ($request->hasFile('pdf_file')) {
        $pdfName = time() . '.' . $request->pdf_file->extension();
        $request->pdf_file->move(public_path('uploads/pdf'), $pdfName);
        $pdfPath = 'uploads/pdf/'.$pdfName;
    }

    Course::create([
        'type' => 'book',
        'title' => $request->title,
        'author' => $request->author,
        'short_desc' => $request->short_desc,
        'long_desc' => $request->long_desc,
        'image' =>'uploads/courses/'. $imageName,
        'pdf_file' => $pdfPath,
        'price' => $request->price,
        'sort_order' => $request->input('sort_order', 0),
    ]);

   return redirect()->route('book.view')->with('success', 'Book Added Successfully');

}
public function editBook($id)
{
    $book = Course::where('id', $id)
                  ->where('type', 'book')
                  ->firstOrFail();

    return view('book.edit', compact('book'));
}

public function updateBook(Request $request)
{
    $book = Course::where('id', $request->id)
                  ->where('type', 'book')
                  ->firstOrFail();

    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'short_desc' => 'required',
        'long_desc' => 'nullable',
        'price' => 'required',
        'image' => 'nullable|image',
    ]);

    // Image Update
    if ($request->hasFile('image')) {

        if (file_exists(public_path($book->image))) {
            @unlink(public_path($book->image));
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/courses'), $imageName);
        $book->image = 'uploads/courses/'.$imageName;
    }

    // Normal fields update
    $book->title = $request->title;
    $book->author = $request->author;
    $book->short_desc = $request->short_desc;
    $book->long_desc = $request->long_desc;
    $book->price = $request->price;
    $book->sort_order = $request->input('sort_order', 0);
    $book->save();

    return redirect()->route('book.view')->with('success', 'Book Updated Successfully');
}


}
