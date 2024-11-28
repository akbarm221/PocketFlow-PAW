<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the user profile form.
     */
    public function index()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('profile.index', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi file foto
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Upload dan update foto profil jika ada file baru
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }

            // Simpan file baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        // Simpan perubahan
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
    
/**
 * Show the change password form.
 */
public function showChangePasswordForm()
{
    $user = Auth::user(); // Mendapatkan data user yang sedang login
    return view('profile.changePassword', compact('user'));
}

/**
 * Update the user's password.
 */
public function changePassword(Request $request)
{
    $user = Auth::user();

    // Validasi input
    $request->validate([
        'current_password' => 'required', // Password lama wajib diisi
        'password' => 'required|string|min:8|confirmed', // Password baru wajib, dan harus dikonfirmasi
    ]);

    // Validasi apakah password lama sesuai
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    // Jika password lama benar, update password
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('profile.index')->with('success', 'Password updated successfully.');
}


}
