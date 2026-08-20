<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function edit(): View
    {
        return view('admin.account.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password'      => ['required', 'current_password'],
            'password'              => ['nullable', 'confirmed', Password::min(8)],
        ], [
            'current_password.current_password' => 'Password saat ini tidak cocok.',
            'password.confirmed'                => 'Konfirmasi password baru tidak cocok.',
            'email.unique'                      => 'Email sudah digunakan.',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.account.edit')
            ->with('success', 'Akun berhasil diperbarui.' . ($request->filled('password') ? ' Silakan login kembali jika diperlukan.' : ''));
    }
}
