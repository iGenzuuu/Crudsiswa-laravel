<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile(){
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request){
        $user = Auth::user();
        $validated = $request->validate([
            'name' => ['required','string','min:5'],
            'email' => ['required','email', 'unique:users,email,'.$user->id]
        ]);
        try {
            $user->update($validated);
            return back()->with('success', 'Berhasil update profil');
        } catch (\Throwable $th) {
            return back()->with('failed', 'gagal update profil, silakan coba lagi');
        }
    }

    public function changePassword(Request $request){
        $user = Auth::user();
        $validated = $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','string', 'min:8']
        ]);
        try {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back()->with('success', 'Berhasil mengubah password');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah password, silakan coba lagi');
        }
    }
}
