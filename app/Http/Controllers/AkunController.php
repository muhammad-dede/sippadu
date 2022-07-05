<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        return view('akun.index');
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->id());

        $request->validate([
            'username' => 'required|string|alpha_dash|unique:user,username,' . $user->id . ',id',
            'name' => 'required|string|max:255',
        ]);

        if ($request->password) {
            $request->validate([
                'password_old' => 'required|string|min:8',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if (!Hash::check($request->password_old, $user->password)) {
                return back()->withErrors([
                    'password_old' => __('Password lama salah'),
                ])->withInput();
            }
        }

        $user->update([
            'username' => strtolower($request->username),
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : auth()->user()->password,
        ]);

        return redirect()->back()->with('success', 'Berhasil disimpan!');
    }
}
