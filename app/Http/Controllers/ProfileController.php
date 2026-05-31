<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Profil düzenleme sayfasını gösterir.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Profil bilgilerini günceller (Ad-Soyad, E-posta, Adres).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Adres bilgisini de doldurabilmesi için User modelinde ve formda 'address' olmalı
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profil bilgileriniz başarıyla güncellendi. ✨');
    }

    /**
     * Üyeliği Pasif Hale Getirme
     */
    public function deactivate(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeactivation', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Hesabı silmiyoruz, sadece durumunu passive yapıyoruz
        $user->status = 'passive';
        $user->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->generateToken();

        return Redirect::to('/')->with('info', 'Hesabınız isteğiniz üzerine pasif hale getirilmiştir.');
    }

    /**
     * Hesabı Tamamen Silme (Opsiyonel - Hocanın silme isteği için)
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('warning', 'Hesabınız kalıcı olarak silindi.');
    }
}