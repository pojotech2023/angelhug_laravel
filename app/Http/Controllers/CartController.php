<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function supportsPersistentCart(): bool
    {
        return Schema::hasColumn('users', 'cart');
    }

    private function persistCart(array $cart): void
    {
        if (Auth::check() && $this->supportsPersistentCart()) {
            $user = Auth::user();
            $user->cart = $cart;
            $user->save();
        }
    }

    public function add($id)
    {
        $course = Course::findOrFail($id);

        $cart = session()->get('cart', []);

        $cart[$id] = [
            "course_id" => $course->id,
            "title" => $course->title,
            "price" => $course->price,
            "image" => $course->image,
            "pdf_file" => $course->pdf_file,
            "type"  => $course->type ?? 'course',
            "qty"   => 1
        ];

        session()->put('cart', $cart);
        $this->persistCart($cart);

        return redirect()->route('cart')->with('success','Course added to cart');
    }

    public function addAjax(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $qty = max(1, (int) $request->input('qty', 1));

        $cart = session()->get('cart', []);

        $cart[$id] = [
            "course_id" => $course->id,
            "title"    => $course->title,
            "price"    => $course->price,
            "image"    => $course->image,
            "pdf_file" => $course->pdf_file,
            "type"     => $course->type ?? 'course',
            "qty"      => $qty,
        ];

        session()->put('cart', $cart);
        $this->persistCart($cart);

        return response()->json([
            'success'    => true,
            'cart_count' => count($cart),
            'cart_total' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
        ]);
    }

    public function updateQty(Request $request, $id)
    {
        $qty  = max(1, (int) $request->input('qty', 1));
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
            session()->put('cart', $cart);
            $this->persistCart($cart);
        }

        return response()->json([
            'success'    => true,
            'cart_count' => count($cart),
            'cart_total' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
        ]);
    }

    public function cart()
    {
        if (Auth::check() && $this->supportsPersistentCart() && empty(session('cart', []))) {
            session()->put('cart', Auth::user()->cart ?? []);
        }

        return view('cart.index');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            $this->persistCart($cart);
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart');
    }
}
