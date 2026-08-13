<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        $tax = round($subtotal * 0.05, 2);
        $total = round($subtotal + $tax, 2);

        return view('Elearning.checkout', compact('cart', 'subtotal', 'tax', 'total'));
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()
                ->route('cart')
                ->with('error', 'Please log in first to complete your purchase.');
        }

        session()->forget('cart');

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Successfully bought!');
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required',
            'title' => 'required|string',
            'category' => 'required|string',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        $cart = session('cart', []);

        if (isset($cart[$validated['course_id']])) {
            $cart[$validated['course_id']]['qty']++;
        } else {
            $cart[$validated['course_id']] = [
                'title' => $validated['title'],
                'category' => $validated['category'],
                'duration' => $validated['duration'],
                'price' => $validated['price'],
                'image' => $validated['image'] ?? null,
                'qty' => 1,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart')->with('success', 'Course added to cart!');
    }

    public function remove($course_id)
    {
        $cart = session('cart', []);
        unset($cart[$course_id]);
        session(['cart' => $cart]);

        return redirect()->route('cart');
    }

    public function updateQty(Request $request, $course_id)
    {
        $cart = session('cart', []);

        if (isset($cart[$course_id])) {
            $qty = max(1, (int) $request->input('qty', 1));
            $cart[$course_id]['qty'] = $qty;
            session(['cart' => $cart]);
        }

        return redirect()->route('cart');
    }
}