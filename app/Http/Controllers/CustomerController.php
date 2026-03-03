<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function orderHistory(Request $request)
    {
        $query = Order::with('items.product')->where('user_id', Auth::id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);
        return view('customer.orders', compact('orders'));
    }

    public function editProfile()
    {
        return view('customer.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'img_path.max' => 'The image is too heavy. Maximum size allowed is 2MB.',
            'img_path.mimes' => 'Only JPG, PNG, and GIF files are accepted.',
        ]);

        $data = ['name' => $request->name];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('img_path')) {
            if ($user->img_path) {
                Storage::disk('public')->delete($user->img_path);
            }
            $data['img_path'] = $request->file('img_path')->store('profile_photos', 'public');
        }

        $user->update($data);
        return back()->with('success', 'Profile updated successfully!');
    }
}