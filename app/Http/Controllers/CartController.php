<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;

class CartController extends Controller
{
    
    private function cartKey()
    {
        return Auth::check() ? 'cart_' . Auth::id() : 'cart_guest';
    }

    public function index()
    {
        $cart = session($this->cartKey(), []);

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

        $cart = session($this->cartKey(), []);

        foreach ($cart as $courseId => $item) {
            Enrollment::firstOrCreate(
                [
                    'student_id' => Auth::id(),
                    'course_id' => $courseId,
                ],
                [
                    'enrolled_at' => now(),
                    'payment_status' => 'paid',
                ]
            );
        }

        session()->forget($this->cartKey());

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

    $alreadyPurchased = Enrollment::where('student_id', Auth::id())
        ->where('course_id', $validated['course_id'])
        ->where('payment_status', 'paid')
        ->exists();

    if ($alreadyPurchased) {
        return redirect()->back()
            ->with('error', "Can't add course to cart, course was already purchased");
    }

    $cart = session($this->cartKey(), []);

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

    session([$this->cartKey() => $cart]);

    return redirect()->route('cart')->with('success', 'Course added to cart!');
}

    public function remove($course_id)
    {
        $cart = session($this->cartKey(), []);
        unset($cart[$course_id]);
        session([$this->cartKey() => $cart]);

        return redirect()->route('cart');
    }

    public function updateQty(Request $request, $course_id)
    {
        $cart = session($this->cartKey(), []);

        if (isset($cart[$course_id])) {
            $qty = max(1, (int) $request->input('qty', 1));
            $cart[$course_id]['qty'] = $qty;
            session([$this->cartKey() => $cart]);
        }

        return redirect()->route('cart');
    }
}