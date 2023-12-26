<?php

namespace App\Http\Controllers\Google;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login/google')->withErrors('Google login failed. Please try again.');
        }

        // Lakukan logika otentikasi atau registrasi di sini
        // Contoh:
        $authUser = $this->findOrCreateUser($user);
        auth()->login($authUser, true);

        // Setelah otentikasi berhasil, arahkan ke halaman yang diinginkan
        return redirect()->to('http://localhost:5173/list');
    }

    private function findOrCreateUser($googleUser)
    {
        // Cari pengguna berdasarkan ID Google
        $user = User::where('google_id', $googleUser->getId())->first();

        // Jika pengguna ditemukan, kembalikan pengguna tersebut
        if ($user) {
            return $user;
        }

        // Jika tidak, buat pengguna baru dengan informasi dari Google
        return User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            // Tambahkan kolom lain sesuai kebutuhan
        ]);
    }
}
